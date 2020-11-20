window.$ = require('jquery');




    console.log('prima')


  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: '/APIcalendar'
    });
    calendar.render();
  });


  document.addEventListener('DOMContentLoaded', function() {
    var calendaruserEl = document.getElementById('calendaruser');
    var calendaruser = new FullCalendar.Calendar(calendaruserEl, {
      initialView: 'dayGridMonth',
      events: '/APIcalendar',
      eventClick: function(info) {
        alert('Event: ' + info.event.title);
        
        
        // change the border color just for fun
        info.el.style.borderColor = 'red';
       
      }
    });
    calendaruser.render();
  });

  console.log('dopo')




  // document.addEventListener('DOMContentLoaded', function() {
    
    
  //   var calendarEl = document.getElementById('calendar');
  //   var calendar = new FullCalendar.Calendar(calendarEl, {
      
  //     initialView: 'timeGridWeek',
  //     headerToolbar: { center: 'dayGridMonth,timeGridWeek' }, // buttons for switching between views
  //     events: '/APIcalendar',
  //     eventClick: function(info) {
  //       alert('Event: ' + info.event.title);
        
        
  //       // change the border color just for fun
  //       info.el.style.borderColor = 'red';
       
  //     }
      
  //   });
  //   calendar.render();
  // });




$(document).ready(init);
