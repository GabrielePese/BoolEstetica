const { min, sortedLastIndexOf } = require('lodash');

window.$ = require('jquery');


  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {

      
      initialView: 'timeGridWeek',
       events: '/apiCalendar'
    });
    calendar.render();
  });


  document.addEventListener('DOMContentLoaded', function() {
    var calendaruserEl = document.getElementById('calendaruser');
    var calendaruser = new FullCalendar.Calendar(calendaruserEl, {
      themeSystem: 'bootstrap',
      
      initialView: 'timeGridWeek',
      selectable: true,
      events: '/apiCalendar',
      

    });
    console.log(calendaruser);
    calendaruser.render();
  });
  
  
  //-------------------------------------------------------------------------------------------------------------------------------------
  function prendiGiorno(){
    $('#selectDay').on("change",function(){
      var valoreinput = $(this).val();
    console.log(valoreinput);
    
          $.ajax({
            url: '/apiCalendarioData/' + valoreinput,
            method:'GET',
            // data: {"titolo" : 'ciao'},
            success: function(data, result){
              console.log('result', result);
              console.log('DATA', data);

              manipolaDatiCalendario(data);
            },
            error: function(err){
              console.log('error');
            }
          });
    
  })  
}

 //--------------------------------------------------------------------------------------------------------------------------------

  function printArray(optionArray, serviceType){
    console.log(optionArray);
    

 
   $('#selectReservation').find('option').remove();  // ogni volta che cambio lui mi cancella tutte le vecchie option (compreso "select yourt option") => senza ogni volta che cambio giorno lui mi mostra gli orari vecchie e quelli nuovi..


  

    for (let index = 0; index < optionArray.length; index++) {   
      
      console.log("OPZIONE ARRAY",optionArray);

      
      if (serviceType == 1 || serviceType == 2 || serviceType == 3 ) // se servizio dura 1 ora
      {          
          if (optionArray[index] !== "12:30" && optionArray[index] !== "13:00" && optionArray[index] !== "13:30" )  // se e'diverso da 12.30 13 13.30.. escludo orari della PAUSA.La Pausa e' dalle 13 alle 14 per servizi 60min
          {
            $('#selectReservation').append(`'<option value="${optionArray[index]}">${optionArray[index]}</option>'`);    // qui gli dico di stampare gli orari disponibili.    
          }       
        }   
        else if (serviceType == 4) 
        {          
          if (optionArray[index] !== "13:00" && optionArray[index] !== "13:30" )  // escludo orari della PAUSA per servizi 30 min, quindi posso prenotare dalle 12.30 alle 13 poi dalle 14 in poi. 
          {       
            $('#selectReservation').append(`'<option value="${optionArray[index]}">${optionArray[index]}</option>'`);    
          }   
        }                
    }

    $('#reservation-btn').removeClass('invisible'); // rendo visibile il bottono di prenotazione.

  }


 //--------------------------------------------------------------------------------------------------------------------------------

 function  get60MinOption(unbookedHours, service){           

  console.log("entro nella funzione con", unbookedHours );

  let arrayOptionToPrint = []; // questo all'inizio e'vuoto e saranno le ore che mi appariranno disponibili nella gioranta selezionata

      for (let index = 0; index < unbookedHours.length; index++) {

        var deltaMinutes = moment(unbookedHours[index][1], "kk:mm").diff(moment(unbookedHours[index][0], "kk:mm"), 'minutes');  //faccio differenza tra il secondo e il primo appuntamento e mi calcoli i minuti. es ho buco dalle 11 alle 9. Ho 2 ore cioe' 120 minuti.
        console.log("Minuti ancora non prenotati: ", deltaMinutes);

            if(deltaMinutes>=60) 
            {

                    for (let count = 0; count < (deltaMinutes/ 30)-1; count++) {  // ciclo per minuti /30 e tolgo uno. es 9-11 ho buco. quindi 120 minuti. lui qui mi dice 9 puoi prenotare, 9.30 puoi prenotare, 10 puoi prenotare, 10.30 grazie al -1 me lo toglie.

                      let step =  moment(unbookedHours[index][0],'kk:mm').add(30*count,'minutes').format('kk:mm'); //aggiungo 30 minuti alla unbookedHours[index][0] che nel mio caso '9. al primo giro agigungo 0 poi 30 min poi 60 e poi 90.
                      arrayOptionToPrint.push(step);           
                    }
            }        
      }
                 console.log("Orari Possibili per Prenotare Serivizi da 60 minuti: ", arrayOptionToPrint);
                 printArray(arrayOptionToPrint,service);

 }

 //--------------------------------------------------------------------------------------------------------------------------------

 function  get30MinOption(unbookedHours, service){           

  console.log("entro nella funzione con", unbookedHours );

  let arrayOptionToPrint = [];  // qui funziona come nel 60 

      for (let index = 0; index < unbookedHours.length; index++) {

        var deltaMinutes = moment(unbookedHours[index][1], "kk:mm").diff(moment(unbookedHours[index][0], "kk:mm"), 'minutes');
        console.log("Minuti ancora non prenotati: ", deltaMinutes);

            if(deltaMinutes>=30) //differenza qui che controlla 30 minuti
            {

                    for (let count = 0; count < (deltaMinutes/ 30); count++) {  //nel ciclo ho tolto il -1 perche'qui i 30 min mi servono

                      let step =  moment(unbookedHours[index][0],'kk:mm').add(30*count,'minutes').format('kk:mm');
                      arrayOptionToPrint.push(step);           
                    }
            }        
      }
                 console.log("Orari Possibili per Prenotare Serivizi da 30 minuti: ", arrayOptionToPrint);
                 printArray(arrayOptionToPrint, service);

 }


 //--------------------------------------------------------------------------------------------------------------------------------
 function notBookedHours(data, orarioAperturaMoment, orarioChiusuraMoment, ultimoAppuntamento30Moment, ultimoAppuntamento60Moment){

  console.log("CREA ARRAY FINE INZIO CON DATI:", data);            
            
            var start = [];
            var end = [];    
            
            var arrayEndStart = [];  // unico array con data inizio e data fine

            
            for (let index = 0; index < data.length; index++) {
              var momentStart = moment(data[index].date_start).format("kk:mm"); // prendi dalla chiamata ajax prendo orario inizio(data-start) dell'orario trovato
              var momentEnd = moment(data[index].date_end).format("kk:mm");      // prendi dalla chiamata ajax prendo orario fine(data-end) dell'orario trovato        
              start.push(momentStart);     
              end.push (momentEnd); 
            }

           // creo due array , uno rappresenta le date inizio servizio, l'altro la data di termine servizio e li metto in ordine
            var findedStartDate = start.sort();           
            var findedEndDate = end.sort();     
            
            console.log("ARRAY ORDINATI", findedStartDate, findedEndDate);           
            

            for (let k = 0; k <= data.length-1; k++) { // faccio -1 sennó eco dall'array

              if (k==0 ) //se al primo giro valore trovato e'diverso dall'orario apertura (8.00)
              { 
                  //creo array per una sola prenotazione aggiungendo 8:00 e 19:00
                  var i = findedStartDate[1] ? findedStartDate[1] : orarioChiusuraMoment; // se esiste nell'array delle date iniziali esiste almeno un elemento, dammi l'elemento sennó dammi orario chiusura.un'altra oltre la 0 me la segni come seconda prenotazione, sennó me la sostituisci con orario chiusura.
                  console.log("vari", i);
                  if (findedStartDate[0] !== orarioAperturaMoment) {
                    
                    let newelem = [ orarioAperturaMoment, findedStartDate[0] ]; //nell'array metti orario apertura e l'orario di inizio del primo appuntamento della giornata.
                    console.log('DIVERSO ORARIO APERTURA', newelem);
                    arrayEndStart.push(newelem); 
                  }
                  else{
                    let newelem = [ findedEndDate[0], i ];
                    console.log('UGUALE ORARIO APERTURA QUINDI ALLE 8', newelem);
                    arrayEndStart.push(newelem); 
                  }
                               
              } 
              else if(k!==0 && k < data.length-1 ) // dopo un ciclo 
              {

                                       

                    if(findedEndDate[k] !== findedStartDate[k+1] ) {     //se la data finale dell'esimo servizio è differente dalla data iniziale del servizio successivo
                    let newelem = [findedEndDate[k],findedStartDate[k+1] ]; 
                    arrayEndStart.push(newelem); 
                    
                    } 

                
              } 
              else if (k == data.length-1) // k é all'ultimo ciclo.
              {

                    if(findedStartDate[k] !== ultimoAppuntamento60Moment) { //18:00  data inizio é diversa dallúltimo appuntamento da 60 min
                    let newelem = [findedEndDate[k], orarioChiusuraMoment ]; //15:00 - 19:00  
                    arrayEndStart.push(newelem);     

                    }
                    else if ( (findedEndDate[k] == ultimoAppuntamento60Moment) || (findedEndDate[k] == ultimoAppuntamento30Moment)  ) 
                    {

                        let newelem = [findedEndDate[k], orarioChiusuraMoment ]; 
                        arrayEndStart.push(newelem);    
                        
                    }

              }

            }  //fine ciclo for

            return arrayEndStart;
      }

//---------------------------------------------------------------------------------------------------------------------------------
function manipolaDatiCalendario(data){
  var orarioApertura= 8;
  var orarioAperturaMoment = moment(orarioApertura, 'h').format('kk:mm');
  
  var orarioChiusura = 19;
  var orarioChiusuraMoment = moment(orarioChiusura, 'h').format('kk:mm');

  var ultimoAppuntamento30 = "18:30";
  var ultimoAppuntamento30Moment = moment(ultimoAppuntamento30, 'hh:mm').format('kk:mm');

  var ultimoAppuntamento60 = 18;
  var ultimoAppuntamento60Moment = moment(ultimoAppuntamento60, 'hh').format('kk:mm');

  // prendo il tipo di servizio e quindi la sua durata: 
    var pathArray = window.location.pathname.split('/'); // prendi url pagina e la dividi ad ogni /
    var servizio = pathArray[2]; // prendi la posizione 2 dellárray creato, quindi prendi il numero in fondo all'URL.

      
    // se non c'è nessuna prenotazione---------STAMPERA' (da fare) TUTTE LE OPTION NELLA SELECT
        if(data.length==0)
        {

            // let arrayTotalBooking=[orariAperturaMoment]; //crei array con giá dentro orario di apertura (8.00) sennó  lui parte da 8.30
            let arrayTotalBooking=[];
            

            for (let index = 0; index < (orarioChiusura-orarioApertura)*2; index++) {  // ciclo per le ore di aperte ( da orariochiusura - orario apertura) per ogni 30 minuti con il * 2

                let step =  moment(orarioAperturaMoment,'kk:mm').add(30*index,'minutes').format('kk:mm'); // aggiungo 30 minuti per ogni volta.. quindi avro step = 8.00 poi step = 8.30 step = 9.00 ecc..
                arrayTotalBooking.push(step);      // pusho nell'array
                
              }
              

              
                 

                  if ( servizio == 1 || servizio == 2 || servizio == 3 )  // se servizio dura 60 minuti => qui aggiungo tutti i servizi con duration 60 min
                  {
                    let arrayTotalBookingSliced = arrayTotalBooking.slice(0, -1); // slice toglie i valori che gli indichi dall'array. all'inzio non tolgo nulla e alla fine faccio -1, quindi lui mi toglie 18.30.              
                    printArray(arrayTotalBookingSliced, servizio);
                  }    
        
                  if( servizio == 4 )
                  {              
                    printArray(arrayTotalBooking, servizio);                
                  }     

                               
    // se c' ALMENO UNA prenotazione------------------A SECONDA DEL TIPO E DELLA DURATA DEL SERVIZIO STAMPERA LE OPTION NECESSARIE

        } 
        else if (data.length >= 1 ) 
        {
                var unbookedHours = notBookedHours(data, orarioAperturaMoment, orarioChiusuraMoment,ultimoAppuntamento30Moment, ultimoAppuntamento60Moment);  // qui recupero le ore e mezzore libere
                console.log("UNBOOKED HOURS: ", unbookedHours);             
              
              if ( servizio == 1 || servizio == 2 || servizio == 3 )
               {
                console.log('-----------------------SERVIZIO con durata 60 min-----------------------------------');                    
                get60MinOption(unbookedHours, servizio);
              }    
    
              if( servizio == 4 )
              {               
                console.log('-----------------------SERVIZIO con durata 30 min-----------------------------------');  
                get30MinOption(unbookedHours, servizio);                
              }   

        }// FINE CICLO ELSE IF DATA LENGTH >= 1
         
}



function init() {

  prendiGiorno();
  
}


$(document).ready(init);
