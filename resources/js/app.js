
require('./bootstrap');

window.Vue = require('vue');
window.$ = require('jquery');



function apiStatistiche(idUtenteSelezionato){
  $.ajax({
    url: '/apiStatistiche/' + idUtenteSelezionato,
    method:'GET',
    
    success: function(data, result){
      console.log('result', result);
      console.log('DATA', data);

      createArray(data);
      printStatistiche(data);
    },
    error: function(err){
      console.log('error');
    }
  });


}


 function printStatistiche(data){

  $('#targetStat').html('');
  for (let index = 0; index < data.length; index++) {
    
    $('#targetStat').append('<h2>'+ 'Il cliente ' +  data[index]['cliente'] + ' ha fatto il trattamento ' + data[index]['nome_Servizio'] + ' '+ data[index]['prenotatazioni'] + ' volte.' )
    
  }
}

//PARTE PER GRAFICO STATISTICHE
function createArray(data){
  var servizi = [];
  var quantita = [];

  for (let index = 0; index < data.length; index++) {
    servizi.push(data[index]['nome_Servizio'])
    quantita.push(data[index]['prenotatazioni'])
    
  }

  statistic(servizi, quantita )
  console.log('servizi ==', servizi)
  console.log('quantita ==', quantita)

}

function statistic(label, datas){
   removeAllChart() 
  
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: label,
          datasets: [{
              label: '# of Votes',
              data: datas,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }]
      }
  });
}

function createArrayDati(datifatturamese){
  

  var mesi = [0,0,0,0,0,0,0,0,0,0,0,0];

 
console.log("ARRAY DI MESI NON MODIFICATI",mesi);



  var objectLength= Object.keys(datifatturamese).length;
  console.log(objectLength);

  for (var i = 0; i < objectLength; i++) {
    var oggetto = Object.values(datifatturamese)[i];

    var mesiInNumero = oggetto['month'];
    var datiPrenotazione= oggetto['totale_servizi_del_mese'];
    var index = mesiInNumero-1;
    mesi[index] = datiPrenotazione ;
  }

  console.log("ARRAY DI MESI MODIFICATI--------------------------",mesi);

 
  
  statistics(mesi)
  console.log(mesi)
  
  

}

function statistics(mesi){
  removeAllCharts() 
 
 var ctx = document.getElementById('myCharts').getContext('2d');
 var myChart = new Chart(ctx, {
     type: 'bar',
     data: {
         labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
         datasets: [{
             label: 'Numero Servizi',
             data: mesi,
             backgroundColor: [
                 'rgba(255, 99, 132, 0.2)',
                 'rgba(54, 162, 235, 0.2)',
                 'rgba(255, 206, 86, 0.2)',
                 'rgba(75, 192, 192, 0.2)',
                 'rgba(153, 102, 255, 0.2)',
                 'rgba(255, 159, 64, 0.2)',
                 'rgba(255, 99, 132, 0.2)',
                 'rgba(54, 162, 235, 0.2)',
                 'rgba(255, 206, 86, 0.2)',
                 'rgba(75, 192, 192, 0.2)',
                 'rgba(153, 102, 255, 0.2)',
                 'rgba(255, 159, 64, 0.2)'
             ],
             borderColor: [
                 'rgba(255, 99, 132, 1)',
                 'rgba(54, 162, 235, 1)',
                 'rgba(255, 206, 86, 1)',
                 'rgba(75, 192, 192, 1)',
                 'rgba(153, 102, 255, 1)',
                 'rgba(255, 159, 64, 1)',
                 'rgba(255, 99, 132, 1)',
                 'rgba(54, 162, 235, 1)',
                 'rgba(255, 206, 86, 1)',
                 'rgba(75, 192, 192, 1)',
                 'rgba(153, 102, 255, 1)',
                 'rgba(255, 159, 64, 1)'
             ],
             borderWidth: 1
         }]
     },
     
     options: {
      scales: {
          yAxes: [{
              ticks: {
                stepSize: 1,
                beginAtZero: true
              }
          }]
      }
  }
      
     
 });
}

function removeAllChart(){

  $('#myChart').remove();
  $('#views-chart').append('<canvas id="myChart" width="400" height="400"><canvas>');

}

function removeAllCharts(){

  $('#myCharts').remove();
  $('#views-charts').append('<canvas id="myCharts" width="400" height="400"><canvas>');

}

function apiStatisticheAnno(){
  $.ajax({
    url: '/apiFatturatoMeseChart',
    method:'GET',
    
    success: function(datifatturamese, result){
      console.log('result', result);
      console.log('DATA', datifatturamese);
      createArrayDati(datifatturamese)
    },
    error: function(err){
      console.log('error');
    }
  });


}

function checkStelle(){
  var stelle = $('.numerostelle').val();
  var stelleGiuste = Math.round(stelle);
  console.log(stelleGiuste);


  $('.stelle').html(`<i class="fas fa-star"></i>`);

  if (stelleGiuste == 1){
    $('.stelle').html(`<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>`) ;
} else if(stelleGiuste == 2){
  $('.stelle').html(`<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i> `);
}else if(stelleGiuste == 3){
  $('.stelle').html(`<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>`);
}else if(stelleGiuste == 4){
  $('.stelle').html(`<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>`);
}else if(stelleGiuste == 5){
  $('.stelle').html(`<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>`);
}

}


function init(){
  checkStelle();
  
  apiStatisticheAnno();
  
  $('[data-mirror]').on('change keyup paste',function(){
    $('[data-mirror]').val(this.value);
  });
  
  $('#statisticheUtenti').on('change',function(){
    var idUtenteSelezionato = ($(this).val());
   
    apiStatistiche(idUtenteSelezionato);
  });
  
 
 
  
}

$(document).ready(init);

