(function() {
  TableFormatting();
  initSetVorauswahl();
})();

var gruppen2Lehrer=[];
var apiPath="http://fia63kaden.bplaced.net/pgotest/api.php";

function TableFormatting() {
  var table = document.getElementById("linkTable");
  if (table) {
    var rows = table.getElementsByTagName("tr");
    for (let r = 0; r < rows.length; r++) {
      if (rows[r].getElementsByTagName("td").length > 0) {
        rows[r].addEventListener('click', function() {
          var id = this.getElementsByTagName("td")[0].innerHTML;
          window.location.href = window.location.origin + "/inhaltsseite.php?protokollId=" + id;
        });
      }
    }
  }
}

function SubscribeCheckboxLabels(){
  var sel = document.getElementsByClassName("lehrer-checkbox");
  sel.forEach(element => {
    element.parentElement.addEventListener('click',function(){
      this.getElementsByClassName('lehrer-checkbox').checked=!this.getElementsByClassName('lehrer-checkbox').checked;
    });
  });
}

function initSetVorauswahl(){
  var sel = document.getElementsByName('Gruppe');
  postAjax("http://fia63kaden.bplaced.net/pgotest/api.php",'action=getLehrerGruppe',function(data){
    gruppen2Lehrer = JSON.parse(data); 
  });
  if(sel.length > 0){
    sel[0].onchange = function() {
      setVorauswahl(this.value);
      }
  }
}

function setVorauswahl(gruppeId){
  console.log(gruppeId);
  var LehrerCheckboxes = document.getElementsByName("Lehrer");
  LehrerCheckboxes.forEach(element => {
    element.checked=false;
  });
  LehrerCheckboxes.forEach(element => {
    gruppen2Lehrer.forEach(val => {
      if(element.value == val.LehrerID && val.GruppenID == gruppeId){
        element.checked=true;
      }
    });
  });
}

function DeleteLehrer(id){
  postAjax(apiPath,'action=deleteLehrer&lehrerId='+id,function(data){
    var restult = JSON.parse(data);
    if(restult.ok){
      location.reload(true);
    }
    else {
      alert(restult.message);
      console.error(restult);
    }
  });
}

function DeleteGruppe(id){
  postAjax(apiPath,'action=deleteGruppe&gruppeId='+id,function(data){
    var restult = JSON.parse(data);
    if(restult.ok){
      location.reload(true);
    }
    else {
      alert(restult.message);
      console.error(restult);
    }
  });
}

function DeleteLehrerGruppe(lehrerId,gruppeId){
  postAjax(apiPath,'action=deleteLehrerGruppe&lehrerId='+lehrerId+'&gruppeId='+gruppeId,function(data){
    var restult = JSON.parse(data);
    if(restult.ok){
      location.reload(true);
    }
    else {
      alert(restult.message);
      console.error(restult);
    }
  });
}



function postAjax(url, data, success) {
  var params = typeof data == 'string' ? data : Object.keys(data).map(
    function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
  ).join('&');

  var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
  xhr.open('POST', url);
  xhr.onreadystatechange = function() {
    if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
  };
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send(params);
  return xhr;
}