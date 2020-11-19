
require('./bootstrap');

window.Vue = require('vue');
window.$ = require('jquery');



$(document).ready(init);

function init(){

  // import { Calendar } from '@fullcalendar/core';
  // import dayGridPlugin from '@fullcalendar/daygrid';
  
  // document.addEventListener('DOMContentLoaded', function() {
  //   var calendarEl = document.getElementById('calendar');
  
  //   var calendar = new Calendar(calendarEl, {
  //     plugins: [ dayGridPlugin ]
  //   });
  
  //   calendar.render();
  // });


console.log('provaaaa')



    $('[data-mirror]').on('change keyup paste',function(){
        $('[data-mirror]').val(this.value);
      });
    
   
}
