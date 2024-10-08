//Nama : ADIB WILLY KUSUMA ADRIGANTARA
//NIM : 24060122140158
//Kelas : A1

// Fungsi untuk membuat objek XMLHttpRequest
function getXMLHttpRequest() {
    if (window.XMLHttpRequest) {
        // Kode untuk browser modern
        return new XMLHttpRequest();
    } else {
        // Kode untuk browser lama seperti IE
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

// TODO 4: Function untuk mengecek apakah karakter (misalnya email) sudah ada
function getCharacter(email) {
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response == "exists") {
                alert("Email sudah terdaftar!");
            } else {
                alert("Email belum terdaftar, lanjutkan.");
            }
        }
    };
    xhr.open("GET", "get_character.php?email=" + encodeURIComponent(email), true);
    xhr.send();
}

// TODO 5: Function untuk mendapatkan daftar kelas berdasarkan pilihan ras
function getClasses(race_id) {
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            var classSelect = document.getElementById('class-select');
            
            // Hapus semua opsi di dropdown sebelum menambahkan yang baru
            classSelect.innerHTML = '<option value="">Select Class</option>';
            
            // Tambahkan opsi kelas yang diterima dari response
            response.forEach(function(cls) {
                var option = document.createElement('option');
                option.value = cls.id; // Asumsikan ada field 'id' untuk setiap class
                option.text = cls.class_name; // Asumsikan ada field 'class_name'
                classSelect.appendChild(option);
            });
        }
    };
    xhr.open("GET", "get_classes.php?race_id=" + encodeURIComponent(race_id), true);
    xhr.send();
}
