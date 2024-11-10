// Nama            : Aniqah Nursabrina
// NIM             : 24060122120036
// Hari, Tanggal   : Selasa, 01 Oktober 2024
// Lab             : A1

function getXMLHTTPRequest() {
    var xmlHTTP;
    if (window.XMLHttpRequest) { // For modern browsers
        xmlHTTP = new XMLHttpRequest();
    } else { // For older IE browsers
        xmlHTTP = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xmlHTTP;
}

// TODO 4 : LENGKAPI FUNCTION UNTUK CEK EMAIL MENGGUNAKAN AJAX
function getCharacter() {
    var input = 'email'; 
    var inner = 'response'; 
    var email_address = document.getElementById(input).value;

    
    var url = 'get_character.php?email=' + email_address; 

    var xmlHTTP = getXMLHTTPRequest();
    xmlHTTP.open("GET", url, true);

    xmlHTTP.onreadystatechange = function() {
        if (xmlHTTP.readyState == 4 && xmlHTTP.status == 200) {
            document.getElementById(inner).innerHTML = xmlHTTP.responseText; 
        }
    }

    xmlHTTP.send(null);
}

function callAjax(url, inner) {
    var xmlHTTP = getXMLHTTPRequest();

    xmlHTTP.open("GET", url, true);

    xmlHTTP.onreadystatechange = function() {   
        if (xmlHTTP.readyState == 4 && xmlHTTP.status == 200) {
            // Ganti innerHTML dari elemen select class dengan opsi yang didapat dari response
            document.getElementById(inner).innerHTML = xmlHTTP.responseText;
        }
    };

    xmlHTTP.send(null);
}

function getClasses(race_id) {
    var classDropdown = 'class'; 
    var url = 'get_classes.php?race_id=' + race_id;
    if (race_id == "-") {
        document.getElementById(classDropdown).innerHTML = '<option value="-" selected disabled>-- Pilih class --</option>';
    } else {
        callAjax(url, classDropdown); 
    }
}




