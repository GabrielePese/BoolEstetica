window.$ = require('jquery');




    console.log('prima')


  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'timeGridWeek',
      events: '/APIcalendar'
    });
    calendar.render();
  });


  document.addEventListener('DOMContentLoaded', function() {
    var calendaruserEl = document.getElementById('calendaruser');
    var calendaruser = new FullCalendar.Calendar(calendaruserEl, {
      initialView: 'timeGridWeek',
      selectable: true,
      events: '/APIcalendar',
      // eventClick: function(info) {
      //   alert('Event: ' + info.event.title);
        
        
      //   // change the border color just for fun
      //   info.el.style.borderColor = 'red';
       
      // }
    });
    calendaruser.render();
  });

  function init() {
    
    prendiGiorno();
    
}

function prendiGiorno(){
  $('#ciao').on("change",function(){
    var valoreinput = $(this).val();

 
    document.cookie = `data = ${valoreinput}; path = /`
    
  
    console.log(valoreinput);
  });
}
  
//     $.ajax({
//       url: '/APIcalendarioData',
//       method:'get',
//       data: valoreinput,
//       success: function(data, success){
//           console.log('ok', success, data);
//       },
//         error: function(err){
//           console.log('error');
//         }
//     });
    
//   })
// }


$(document).ready(init);
