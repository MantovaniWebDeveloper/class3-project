var $ = require("jquery");

$(document).ready(function(){
  $('#check').click(function(){
    $('#insert_new').toggleClass('hidden');
  });
  $('#add').click(function(){
    console.log('vai');
    $('#services').prepend('<div class="inpuServizi"><input type="checkbox" name="new_service[]" value="'+ $('#user_serv').val() +' " checked> <label for="'+ $('#user_serv').val() +'">'+ $('#user_serv').val() +'</label></div>');
  });
})
