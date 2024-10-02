// Nama         : Azzam Saefudin Rosyidi
// NIM          : 24060122130076
// Tanggal      :  1 Oktober 2024
// File       : ajax.js

function getXMLHttpRequest() {
  if (window.XMLHttpRequest) {
    return new XMLHttpRequest();
  } else {
    return new ActiveXObject("Microsoft.XMLHTTP");
  }
}

// TODO 4 : LENGKAPI FUNCTION UNTUK CEK EMAIL MENGGUNAKAN AJAX

function getCharacter() {
  var email = document.getElementById("email").value;
  var xhr = new XMLHttpRequest();

  // Cek apakah email kosong
  if (email === "") {
    document.getElementById("error_email").innerHTML = ""; // Menampilkan pesan kesalahan jika email kosong
    document.getElementById("success_email").innerHTML = "";
    return; // Hentikan eksekusi jika email kosong
  }

  xhr.open("POST", "get_character.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = xhr.responseText;

      // Cek apakah email sudah digunakan atau tersedia
      if (response.includes("email has been used")) {
        document.getElementById("error_email").innerHTML =
          "Email has been used";
        document.getElementById("success_email").innerHTML = "";
      } else if (response.includes("email is available")) {
        document.getElementById("error_email").innerHTML = "";
        document.getElementById("success_email").innerHTML =
          "Email is available";
      } else if (response.includes("Email format is incorrect")) {
        document.getElementById("error_email").innerHTML =
          "Email format is incorrect";
        document.getElementById("success_email").innerHTML = "";
      }
    }
  };

  xhr.send("email=" + encodeURIComponent(email));
}

// TODO 5 : LENGKAPI FUNCTION UNTUK MENDAPATKAN DAFTAR CLASS BERDASARKAN PILIHAN RACE MENGGUNAKAN AJAX
function getClasses(race_id) {
  var xmlhttp = new XMLHttpRequest();
  var raceSelect = document.getElementById("race");
  var url = race_id ? "get_classes.php?race_id=" + race_id : "get_races.php";

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (race_id) {
        document.getElementById("class").innerHTML = this.responseText;
      } else {
        raceSelect.innerHTML = this.responseText;
        if (raceSelect.options.length > 0) {
          getClasses(raceSelect.options[0].value);
        }
      }
    } else if (this.readyState == 4 && this.status != 200) {
      console.log("Error loading data: " + this.status);
    }
  };

  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

// Muat daftar Race saat halaman dimuat
document.addEventListener("DOMContentLoaded", function () {
  // Panggil fungsi tanpa parameter untuk memuat daftar Race
  getClasses();
});
