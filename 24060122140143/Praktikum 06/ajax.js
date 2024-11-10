// Nama : Arsyad Grant Saputro
// NIM  : 240060122140143
// RESPONSI


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
    var email = document.getElementById('email').value;
    var xhr = getXMLHttpRequest();
    xhr.open('GET', 'get_character.php?email=' + email, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('error_email').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

// TODO 5 : LENGKAPI FUNCTION UNTUK MENDAPATKAN DAFTAR CLASS BERDASARKAN PILIHAN RACE MENGGUNAKAN AJAX
function getClasses(race_id) {

    var xhr = getXMLHttpRequest();
    xhr.open('GET', 'get_classes.php?race_id=' + race_id, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText); 
            document.getElementById('class').innerHTML = xhr.responseText;
        }
    };
    xhr.send();

}