const { min, sortedLastIndexOf } = require('lodash');

window.$ = require('jquery');


  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: '/apiCalendar'
    });
    calendar.render();
  });


  document.addEventListener('DOMContentLoaded', function() {
    var calendaruserEl = document.getElementById('calendaruser');
    var calendaruser = new FullCalendar.Calendar(calendaruserEl, {
      themeSystem: 'bootstrap',
      initialView: 'dayGridMonth',
      selectable: true,
      events: '/apiCalendar',


      




      // eventClick: function(info) {
      //   alert('Event: ' + info.event.title);
        
        
      //   // change the border color just for fun
      //   info.el.style.borderColor = 'red';
       
      // }
    });
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

    
    
    $('#selectReservation').append(`'<option value="" disabled selected>Select your option</option>'`);   

    $('#selectReservation').find('option').remove();   

    

    for (let index = 0; index < optionArray.length; index++) {   
      
      console.log("OPZIONE ARRAY",optionArray);

      
      if (serviceType == 1 || serviceType == 2 || serviceType == 3 ) 
      {          
          if (optionArray[index] !== "12:30" && optionArray[index] !== "13:00" && optionArray[index] !== "13:30" )  // escludo orari della PAUSA per servizi 60min
          {
            $('#selectReservation').append(`'<option value="${optionArray[index]}">${optionArray[index]}</option>'`);       
          }       
        }   
        else if (serviceType == 4) 
        {          
          if (optionArray[index] !== "13:00" && optionArray[index] !== "13:30" )  // escludo orari della PAUSA per servizi 30 min
          {       
            $('#selectReservation').append(`'<option value="${optionArray[index]}">${optionArray[index]}</option>'`);    
          }   
        }                
    }

    $('#reservation-btn').removeClass('invisible');

  }


 //--------------------------------------------------------------------------------------------------------------------------------

 function  get60MinOption(unbookedHours, service){           

  console.log("entro nella funzione con", unbookedHours );

  let arrayOptionToPrint = [];

      for (let index = 0; index < unbookedHours.length; index++) {

        var deltaMinutes = moment(unbookedHours[index][1], "kk:mm").diff(moment(unbookedHours[index][0], "kk:mm"), 'minutes');
        console.log("Minuti ancora non prenotati: ", deltaMinutes);

            if(deltaMinutes>=60)
            {

                    for (let count = 0; count < (deltaMinutes/ 30)-1; count++) {

                      let step =  moment(unbookedHours[index][0],'kk:mm').add(30*count,'minutes').format('kk:mm');
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

  let arrayOptionToPrint = [];

      for (let index = 0; index < unbookedHours.length; index++) {

        var deltaMinutes = moment(unbookedHours[index][1], "kk:mm").diff(moment(unbookedHours[index][0], "kk:mm"), 'minutes');
        console.log("Minuti ancora non prenotati: ", deltaMinutes);

            if(deltaMinutes>=30)
            {

                    for (let count = 0; count < (deltaMinutes/ 30); count++) {

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

  console.log("CREAARRAYFINEINZIO CON DATI:", data);            
            
            var start = [];
            var end = [];    
            // unico array con data inizio e data fine 
            var arrayEndStart = [];

            
            for (let index = 0; index < data.length; index++) {
              var momentStart = moment(data[index].date_start).format("kk:mm");
              var momentEnd = moment(data[index].date_end).format("kk:mm");              
              start.push(momentStart);     
              end.push (momentEnd); 
            }

           // creo due array , uno rappresenta le date inizio servizio, l'altro la data di termine servizio
            var findedStartDate = start.sort();           
            var findedEndDate = end.sort();     
            
            console.log("ARRAY ORDINATI", findedStartDate, findedEndDate);           
            

            for (let k = 0; k <= data.length-1; k++) {

              if (k==0 && findedStartDate[0] !== orarioAperturaMoment)
              { 
                  //creo array per una sola prenotazione aggiungendo 8:00 e 19:00
                  var i = findedStartDate[1] ? findedStartDate[1] : orarioChiusuraMoment;
                  console.log("vari", i);
                  let newelem = [ orarioAperturaMoment, findedStartDate[0] ]; 
                  let newend = [ findedEndDate[0], i ];
                  arrayEndStart.push(newelem); 

                        if(newend[0] !== newend[1])
                        {
                            arrayEndStart.push(newend); 
                        }                                
              } 
              else if(k!==0 && k < data.length-1 )
              {

                    //se la data finale dell'esimo servizio è differente dalla data iniziale del servizio successivo                    

                    if(findedEndDate[k] !== findedStartDate[k+1] ) {
                    let newelem = [findedEndDate[k],findedStartDate[k+1] ]; 
                    arrayEndStart.push(newelem);    
                    } 

                
              } 
              else if (k == data.length-1) 
              {

                    if(findedStartDate[k] !== ultimoAppuntamento60Moment) { //18:00
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
    var pathArray = window.location.pathname.split('/');
    var servizio = pathArray[2];

      
    // se non c'è nessuna prenotazione---------STAMPERA' (da fare) TUTTE LE OPTION NELLA SELECT
        if(data.length==0)
        {

            let arrayTotalBooking=[orarioAperturaMoment];

            for (let index = 0; index < (orarioChiusura-orarioApertura)*2; index++) {

                let step =  moment(orarioAperturaMoment,'kk:mm').add(30*index,'minutes').format('kk:mm');
                arrayTotalBooking.push(step);              
                }

                  if ( servizio == 1 || servizio == 2 || servizio == 3 )
                  {
                    let arrayTotalBookingSliced = arrayTotalBooking.slice(1,-1);                    
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
                var unbookedHours = notBookedHours(data, orarioAperturaMoment, orarioChiusuraMoment,ultimoAppuntamento30Moment, ultimoAppuntamento60Moment);
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
