
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

//  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>





    $('[data-mirror]').on('change keyup paste',function(){
        $('[data-mirror]').val(this.value);
      });
    
   
}
