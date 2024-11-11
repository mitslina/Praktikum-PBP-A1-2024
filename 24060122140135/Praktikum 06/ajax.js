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
    var email = document.getElementById("email").value;

    if (email) {
        var xhr = getXMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = xhr.responseText; 
                var errorEmail = document.getElementById("error_email");

                if (response === "available") {
                    errorEmail.innerHTML = "<span class='text-success'>Email is available!</span>";
                } else {
                    errorEmail.innerHTML = "<span class='text-danger'>Email is already taken!</span>";
                }
            }
        };

        xhr.open("POST", "character_registration.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("email=" + encodeURIComponent(email));
    } else {
        document.getElementById("error_email").innerHTML = "";
    }
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
