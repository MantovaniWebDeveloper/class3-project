var $ = require("jquery");

$(document).ready(function(){
  $('#show').click(function(){
    $('#insert_new').toggleClass('hidden');
    $('#show').toggleClass('hidden');
  });
  $('#add').click(function(){
    console.log('vai');
    $('#services').prepend('<div class="inpuServizi"><input type="checkbox" name="new_services[]" value="'+ $('#user_serv').val() +' " checked> <label for="'+ $('#user_serv').val() +'">'+ $('#user_serv').val() +'</label></div>');
  });
})
