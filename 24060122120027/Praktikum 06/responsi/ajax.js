// Fungsi untuk mendapatkan objek XMLHttpRequest
function getXMLHttpRequest() {
  if (window.XMLHttpRequest) {
    // Kode untuk browser modern
    return new XMLHttpRequest();
  } else {
    // Kode untuk browser lama IE
    return new ActiveXObject("Microsoft.XMLHTTP");
  }
}
// TODO 4 : LENGKAPI FUNCTION UNTUK CEK EMAIL MENGGUNAKAN AJAX
function getCharacter() {
  const emailInput = document.getElementById("email");
  const errorEmail = document.getElementById("error_email");
  const email = encodeURIComponent(emailInput.value); // Gunakan encodeURIComponent untuk menangani karakter khusus
  const url = "./get_character.php?email=" + email; // Ganti nama file sesuai kebutuhan

  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      errorEmail.innerHTML = xhr.responseText;

      // Cek apakah respons mengandung "Email sudah digunakan"
      if (xhr.responseText.includes("Email sudah digunakan")) {
        emailInput.classList.add("error-input"); // Tambah kelas error jika email sudah digunakan
        errorEmail.style.color = "red";
      } else {
        emailInput.classList.remove("error-input"); // Hapus kelas error jika email tersedia
        errorEmail.style.color = "green";
      }
    }
  };
  xhr.open("GET", url, true);
  xhr.send();
}

// TODO 5 : LENGKAPI FUNCTION UNTUK MENDAPATKAN DAFTAR CLASS BERDASARKAN PILIHAN RACE MENGGUNAKAN AJAX
function getClasses(race_name) {
  const classSelect = document.getElementById("class");
  classSelect.innerHTML = "<option value=''>Select Class</option>"; // Kosongkan daftar class

  if (race_name === "") {
    return; // Jika tidak ada race yang dipilih, tidak perlu melakukan apa-apa
  }

  const xhr = getXMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      classSelect.innerHTML = xhr.responseText; // Update dropdown class dengan hasil dari server
    }
  };

  // Kirim permintaan ke file PHP `get_classes.php` dengan parameter race_name
  xhr.open(
    "GET",
    "get_classes.php?race=" + encodeURIComponent(race_name),
    true
  );
  xhr.send();
}
