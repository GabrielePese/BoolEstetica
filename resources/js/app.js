
require('./bootstrap');

window.Vue = require('vue');
window.$ = require('jquery');



$(document).ready(init);

function init(){
 

    $('[data-mirror]').on('change keyup paste',function(){
        $('[data-mirror]').val(this.value);
      });
    
   
}
