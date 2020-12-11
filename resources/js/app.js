
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
   removeAllCharts() 
  
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
  var quantitaServizi = [];

  for (let index = 0; index < datifatturamese.length; index++) {
    var x = mesi[index];
    x.push(datifatturamese[index]['month'])
    quantitaServizi.push(datifatturamese[index]['totale_servizi_del_mese'])
    
  }
  
  statistics(mesi, quantitaServizi )
  console.log(mesi)
  console.log(quantitaServizi);
  

}

function statistics(mesi, quantitaServizi){
  removeAllCharts() 
 
 var ctx = document.getElementById('myCharts').getContext('2d');
 var myChart = new Chart(ctx, {
     type: 'pie',
     data: {
         labels: mesi,
         datasets: [{
             label: '# of Votes',
             data: quantitaServizi,
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


function init(){
  
  
  
  $('[data-mirror]').on('change keyup paste',function(){
    $('[data-mirror]').val(this.value);
  });
  
  $('#statisticheUtenti').on('change',function(){
    var idUtenteSelezionato = ($(this).val());
   
    apiStatistiche(idUtenteSelezionato);
    apiStatisticheAnno();
  });

 ;
 
  
}

$(document).ready(init);

