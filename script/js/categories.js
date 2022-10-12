function get_category(category) {
  document.getElementById('edit_category_ajax').innerHTML = "<div class='alert alert-success'><div id='loading'></div>&nbsp;Fetching data please wait.</div>";

  var txt;
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
  document.getElementById("edit_category_ajax").innerHTML = xmlhttp.responseText;
  }
  }

  xmlhttp.open("GET","const/ajax/fetch-category.php?category="+category, true);
  xmlhttp.send();
}
