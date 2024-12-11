// Nama         : Surya Fajar
// NIM          : 24060122140107
function getXMLHttpRequest() {
  if (window.XMLHttpRequest) {
    //code for modern browser
    return new XMLHttpRequest();
  } else {
    //code for old IE browser
    return new ActiveXObject("Microsoft.XMLHTTP");
  }
}

// TODO 4 : LENGKAPI FUNCTION UNTUK CEK EMAIL MENGGUNAKAN AJAX
function getCharacter() {
  var xhr = getXMLHttpRequest();
  var email = document.getElementById("email").value;
  var url = "get_character.php?email=" + email;
  xhr.open("GET", url, true);
  
  xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
          var response = xhr.responseText;
          document.getElementById("emailStatus").innerHTML = response; // Update email status here
      }
  };
  xhr.send();
}

// TODO 5 : LENGKAPI FUNCTION UNTUK MENDAPATKAN DAFTAR CLASS BERDASARKAN PILIHAN RACE MENGGUNAKAN AJAX
function getClasses(race_id) {
  var xhr = getXMLHttpRequest(); 
  var url = "get_classes.php?race_id=" + race_id; 
  xhr.open("GET", url, true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("class").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}
