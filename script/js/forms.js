$( document ).ready(function() {

  $("#app_frm").on("submit", function(){
    var current_effect = 'bounce';
    run_waitMe(current_effect);
    function run_waitMe(effect){
    $('#SELECTOR').waitMe({

    effect: 'bounce',
    text: '',

    bg: 'rgba(255,255,255,0.6)',

    color: 'red',

    maxSize: '',

    waitTime: -1,
    source: '',

    textPos: 'vertical',

    fontSize: '',
    onClose: function() {}

    });
    }
  })

  $("#app_frm2").on("submit", function(){
    var current_effect = 'bounce';
    run_waitMe(current_effect);
    function run_waitMe(effect){
    $('#SELECTOR').waitMe({

    effect: 'bounce',
    text: '',

    bg: 'rgba(255,255,255,0.6)',

    color: 'red',

    maxSize: '',

    waitTime: -1,
    source: '',

    textPos: 'vertical',

    fontSize: '',
    onClose: function() {}

    });
    }
  })

  $("#app_frm3").on("submit", function(){
    var current_effect = 'bounce';
    run_waitMe(current_effect);
    function run_waitMe(effect){
    $('#SELECTOR').waitMe({

    effect: 'bounce',
    text: '',

    bg: 'rgba(255,255,255,0.6)',

    color: 'red',

    maxSize: '',

    waitTime: -1,
    source: '',

    textPos: 'vertical',

    fontSize: '',
    onClose: function() {}

    });
    }
  })

  $("#app_frm4").on("submit", function(){
    var current_effect = 'bounce';
    run_waitMe(current_effect);
    function run_waitMe(effect){
    $('#SELECTOR').waitMe({

    effect: 'bounce',
    text: '',

    bg: 'rgba(255,255,255,0.6)',

    color: 'red',

    maxSize: '',

    waitTime: -1,
    source: '',

    textPos: 'vertical',

    fontSize: '',
    onClose: function() {}

    });
    }
  })

  $("#app_frm5").on("submit", function(){
    var current_effect = 'bounce';
    run_waitMe(current_effect);
    function run_waitMe(effect){
    $('#SELECTOR').waitMe({

    effect: 'bounce',
    text: '',

    bg: 'rgba(255,255,255,0.6)',

    color: 'red',

    maxSize: '',

    waitTime: -1,
    source: '',

    textPos: 'vertical',

    fontSize: '',
    onClose: function() {}

    });
    }
  })


  $("#app_frm6").on("submit", function(){
    var current_effect = 'bounce';
    run_waitMe(current_effect);
    function run_waitMe(effect){
    $('#SELECTOR').waitMe({

    effect: 'bounce',
    text: '',

    bg: 'rgba(255,255,255,0.6)',

    color: 'red',

    maxSize: '',

    waitTime: -1,
    source: '',

    textPos: 'vertical',

    fontSize: '',
    onClose: function() {}

    });
    }
  })


  $("#send_mail").on("submit", function(){
    var current_effect = 'bounce';
    run_waitMe(current_effect);
    function run_waitMe(effect){
    $('#SELECTOR').waitMe({

  effect: 'progressBar',
  text: '',

    bg: 'rgba(255,255,255,0.6)',

    color: 'red',

    maxSize: '',

    waitTime: -1,
    source: '',

    textPos: 'vertical',

    fontSize: '',
    onClose: function() {}

    });
    }
  })


  $("#change_pw").on("click", function(){
    var current_pw = document.getElementById('current_pswd').value;
    var new_pw = document.getElementById('new_pswd').value;
    var confirm_pw = document.getElementById('confirm_pswd').value;

    if (current_pw == "") {
      alert("Error: Please enter your current password.");
      return false;
    }

    if((current_pw).length < 8)
    {
      alert("Error: Current password should be minimum 8 characters.");
      return false;
    }

    if (new_pw == "") {
      alert("Error: Please enter your new password.");
      return false;
    }

    if((new_pw).length < 8)
    {
      alert("Error: New password should be minimum 8 characters.");
      return false;
    }

    if (confirm_pw == "") {
      alert("Error: Please enter confirmation password.");
      return false;
    }

    if((confirm_pw).length < 8)
    {
      alert("Error: Confirmation password should be minimum 8 characters.");
      return false;
    }


    if(confirm_pw != new_pw)
    {
    	alert("Error: Password confirmation does not match.");
    	return false;
    }

    return true;



  })


  $("#article_btn").on("click", function(){
    var current_pw = document.getElementById('short_description').value;

    if((current_pw).length < 150)
    {
      alert("Error: Short description should be minimum 150 characters.");
      return false;
    }


    return true;



  })


  $("#reset_pw").on("click", function(){
    var new_pw = document.getElementById('new_pswd').value;
    var confirm_pw = document.getElementById('confirm_pswd').value;


    if (new_pw == "") {
      alert("Error: Please enter your new password.");
      return false;
    }

    if((new_pw).length < 8)
    {
      alert("Error: New password should be minimum 8 characters.");
      return false;
    }

    if (confirm_pw == "") {
      alert("Error: Please enter confirmation password.");
      return false;
    }

    if((confirm_pw).length < 8)
    {
      alert("Error: Confirmation password should be minimum 8 characters.");
      return false;
    }


    if(confirm_pw != new_pw)
    {
      alert("Error: Password confirmation does not match.");
      return false;
    }

    return true;



  })



});
