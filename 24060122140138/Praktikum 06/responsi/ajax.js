// Nama         : Adzkiya Qarina Salsabila
// NIM          : 24060122140138
// Tanggal      : 1-10-2024
// File         : ajax.js
// Deskripsi    : Fungsi-fungsi javascript yang dipanggil oleh file request

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
function getCharacter(email) {
    var xmlhttp = getXMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
            var response = xmlhttp.responseText;
            if (response == "exists") {
                alert("Email tidak tersedia/sudah terdaftar!");
            } else {
                alert("Email tersedia/belum terdaftar");
            }
        }
    };
    xmlhttp.open("GET", "get_character.php?email=" + encodeURIComponent(email), true);
    xmlhttp.send();
}

// TODO 5 : LENGKAPI FUNCTION UNTUK MENDAPATKAN DAFTAR CLASS BERDASARKAN PILIHAN RACE MENGGUNAKAN AJAX
function getClasses(race_id) {
    var xmlhttp = getXMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var response = JSON.parse(xmlhttp.responseText);
            var classSelect = document.getElementById('class-select');

            classSelect.innerHTML = '<option value="">Select Class</option>';

            response.forEach(function(cls) {
                var option = documen.createElement('option');
                option.value = cls.id;
                option.text = cls.class_name;
                classSelect.appendChild(option);
            });
        }
    };
    xmlhttp.open("GET", "get_classes.php?race_id=" + encodeURIComponent(race_id), true);
    xmlhttp.send();
}