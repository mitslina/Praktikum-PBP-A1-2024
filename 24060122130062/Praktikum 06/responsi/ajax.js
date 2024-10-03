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
    var xmlhttp = new XMLHttpRequest();
    var email = encodeURI(document.getElementById('email').value);
    var inner = "error_email";
    
    if (email != "") {
        var url = "get_character.php?email=" + email;
        xmlhttp.open('GET', url, true);
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var response = xmlhttp.responseText.trim(); 
                if (response.trim() !== "") {
                    document.getElementById(inner).innerHTML = "<span style='color:red;'>Email has been used</span>";
                } else {
                    document.getElementById(inner).innerHTML = "<span style='color:green;'>Email available</span>";
                }
            }
        }
        xmlhttp.send(null);
        
    } else {
        alert("Please enter an email address");
    }
}

// TODO 5 : LENGKAPI FUNCTION UNTUK MENDAPATKAN DAFTAR CLASS BERDASARKAN PILIHAN RACE MENGGUNAKAN AJAX
function getClasses(race_id) {
    var xmlhttp = new XMLHttpRequest();
    var url = "get_classes.php?race_id=" + race_id;

    xmlhttp.open('GET', url, true);

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('class').innerHTML = xmlhttp.responseText;
        }
    }

    xmlhttp.send();
}
