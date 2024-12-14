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
    var xhr = new XMLHttpRequest();
    var email = document.getElementById("email").value;
    var url = "get_character.php?email=" + encodeURIComponent(email); // Encode email untuk keamanan

    // Bersihkan pesan error sebelumnya
    document.getElementById("email_error").innerHTML = '';

    // Set up callback function
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;

            if (response === 'exists') {
                // Tampilkan pesan jika email sudah terdaftar
                document.getElementById("email_error").innerHTML = '<span class="text-danger">Email sudah terdaftar. Silakan gunakan email lain.</span>';
                document.getElementById("submit_button").disabled = true; // Disable tombol submit jika email terdaftar
            } else if (response === 'available') {
                // Tampilkan pesan jika email belum terdaftar
                document.getElementById("email_error").innerHTML = '<span class="text-success">Email dapat digunakan.</span>';
                document.getElementById("submit_button").disabled = false; // Enable tombol submit jika email tersedia
            }
        }
    };

    // Kirim permintaan AJAX ke server
    xhr.open("GET", url, true);
    xhr.send();
}


// TODO 5 : LENGKAPI FUNCTION UNTUK MENDAPATKAN DAFTAR CLASS BERDASARKAN PILIHAN RACE MENGGUNAKAN AJAX
function getClasses(race_id) {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('class').innerHTML = xhr.responseText;
        }
    };

    xhr.open("GET", "get_classes.php?race_id=" + encodeURIComponent(race_id), true);
    xhr.send();
}