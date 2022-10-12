$( document ).ready(function() {
    var lodtxt = "<div id='loading'></div> Loading";
    $( "#send-msg" ).click(function() {
      var name = document.getElementById('name').value;
      var email = document.getElementById('email').value;
      var subject = document.getElementById('subject').value;
      var message = document.getElementById('message').value;

      if (name == "") {
        alert("Error: Enter your name");
        return false;
      }

      if (email == "") {
        alert("Error: Enter your email");
        return false;
      }

      var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      if(email.match(mailformat))
      {

      }
      else
      {
      alert('Error: Invalid email address');
      return false;
      }

      if (subject == "") {
        alert("Error: Enter subject");
        return false;
      }

      if (message == "") {
        alert("Error: Enter your message");
        return false;
      }

      document.getElementById("send-msg").blur();

      document.getElementById("send-msg").innerHTML = "Sending...";

      var current_effect = 'bounce';
      run_waitMe(current_effect);
      function run_waitMe(effect){
      $('#SELECTOR').waitMe({

      effect: 'ios',
      text: 'Sending Message.....',

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

      var xmlhttp;

      if (window.XMLHttpRequest)
      {
      xmlhttp=new XMLHttpRequest();
      }
      else
      {
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }

      xmlhttp.onreadystatechange = function() {
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
      var reply = xmlhttp.responseText;
      document.getElementById('error-container').innerHTML = reply;
      document.getElementById("send-msg").innerHTML = "Send Message";
      document.getElementById("name").value = "";
      document.getElementById("email").value = "";
      document.getElementById("subject").value = "";
      document.getElementById("message").value = "";
      $('#SELECTOR').waitMe('hide');


      }
      }
      xmlhttp.open("GET","const/ajax/send_message.php?name="+name+"&subject="+subject+"&email="+email+"&message="+message+"", true);
      xmlhttp.send();

    });



});
