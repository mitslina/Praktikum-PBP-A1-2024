// Nama         : Maulida Aprillia Cinta Ariyatin
// NIM          : 24060122120029
// Tanggal      : 24 September 2024
// File         : ajax.js
// Deskripsi    : Fungsi-fungsi javascript yang dipanggil oleh file request

// Fungsi untuk membuat objek XMLHttpRequest
function getXMLHTTPRequest() {
    //TODO: Membuat objek ajax
    if(window.XMLHttpRequest){
        return new XMLHttpRequest;
    } else {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

// Server Time
function get_server_time() {
    //TODO: Membuat objek XMLHTTPRequest 
    var xmlHTTP = getXMLHTTPRequest();
    var page = 'get_server_time.php';
    //TODO: Menyiapkan permintaan HTTP
    xmlHTTP.open("GET", page, true);
    //TODO: Eksekusi Ajax 
    xmlHTTP.onreadystatechange = function() {
        document.getElementById('showtime').innerHTML = '<img src="../images/ajax loader.png" />'
        if((xmlHTTP.readyState==4) && (xmlHTTP.status == 200)){
            document.getElementById('showtime').innerHTML = xmlHTTP.responseText;
        }
    }
    xmlHTTP.send(null);
}

// Add Customer (Method GET)
function add_customer_get() {
    //TODO: Membuat objek XMLHTTPRequest 
    var xmlHTTP = getXMLHTTPRequest();
    //TODO: Mendapatkan nilai inputan name, address, city
    var name = encodeURI(document.getElementById('name').value);
    var address = encodeURI(document.getElementById('address').value);
    var city = encodeURI(document.getElementById('city').value);

    //TODO: Validasi dan set URL & inner
    if (name != "" && address != "" && city != "") {
        var url = "add_customer_get.php?name=" + name + "&address=" + address + "&city=" + city;
        var inner = "add_response";
        
        //TODO: Menyiapkan permintaan HTTP
        xmlHTTP.open('GET', url, true);
        //TODO: Eksekusi Ajax
        xmlHTTP.onreadystatechange = function(){
            document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.png" />'

            if((xmlHTTP.readyState==4) && (xmlHTTP.status == 200)){
                document.getElementById(inner).innerHTML = xmlHTTP.responseText;
            }
            return false;
        }
        xmlHTTP.send(null);
        
    } else {
        //TODO : Membuat alert jika data form kosong
        alert("Please fill all the fields");
    } 
}


// Add Customer (Method POST)
function add_customer_post() {
    //TODO 1: Membuat objek XMLHTTPRequest 
    var xmlHTTP = getXMLHTTPRequest();

    //TODO 2: Mendapatkan nilai inputan name, address, city
    var name = encodeURI(document.getElementById('name').value);
    var address = encodeURI(document.getElementById('address').value);
    var city = encodeURI(document.getElementById('city').value);

    // Validate
    if (name != "" && address != "" && city != ""){
        //TODO 3: set url add_customer_post.php
        var url = "add_customer_post.php"; alert(url);
        //TODO 4: set inner 
        var inner = "add_response";
        //TODO 5: set parameter 
        var params = "name="+ name +"&address=" + address + "&city=" + city;
        //TODO 6: open xmlhttp request dengan POST, url secara asinkronus
        xmlHTTP.open("POST", url, true);

        //TODO 7: set request header
        xmlHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //TODO 8: tampilkan perintah ketika onreadystatechange
        xmlHTTP.onreadystatechange = function(){
            document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.png" />'

            if((xmlHTTP.readyState==4) && (xmlHTTP.status == 200)){
                document.getElementById(inner).innerHTML = xmlHTTP.responseText;
            }
            return false;
        }
        //TODO 9: kirim request POST
        xmlHTTP.send(params);
    }else{
        alert("Please fill all the fields");
    }
}

// Fungsi untuk memanggil ajax
function callAjax(url, inner) {
    //TODO 1: Panggil metode getXMLHTTPRequest()
    var xmlHTTP = getXMLHTTPRequest();
     //TODO 2: open xmlhttp request dengan GET
    xmlHTTP.open('GET', url, true);
     //TODO 3: tampilkan perintah ketika onreadystatechange
    xmlHTTP.onreadystatechange = function(){
        document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.png" />';
        if((xmlHTTP.readyState==4) && (xmlHTTP.status==200)){
            document.getElementById(inner).innerHTML=xmlHTTP.responseText;
        }
        return false;
    }
     //TODO 4: kirim request GET
    xmlHTTP.send(null);
}

// Show Customer Detail
function showCustomer(customerid) {
    //TODO 1: set inner html
    var inner = 'detail_customer';
    //TODO 2: set url dengan parameter customerid
    var url = 'get_customer.php?id=' + customerid;
    if (customerid == "") {
        // TODO 3: Mengosongkan elemen html
        document.getElementById(inner).innerHTML='';
    } else {
        // TODO 4: Menjalankan Fungsi Ajax
        callAjax(url,inner);
    }
}

// Tugas Nomor 2 : Search Book By Title (Live search)
function searchBookByTitle(){    
    //TODO 1: Mendapatkan nilai inputan, inner, dan url
    var book_title = document.getElementById('book_title').value.trim();
    var inner = 'book_info'; 
    var url = 'get_book.php?title=' + encodeURIComponent(book_title);

    if (book_title.trim() === "") {
        document.getElementById(inner).innerHTML = "";
        document.getElementById('book_info').style.display = 'none';
        return;
    }

    // TODO 2: Menjalankan Fungsi Ajax
    var xmlHTTP = getXMLHTTPRequest();
    xmlHTTP.open('GET', url, true);
    xmlHTTP.onreadystatechange = function(){
        if(xmlHTTP.readyState == 1){
            document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.png" />';
        }
        if((xmlHTTP.readyState == 4) && (xmlHTTP.status == 200)){
            document.getElementById(inner).innerHTML = xmlHTTP.responseText;
            document.getElementById('book_info').style.display = 'block';
        }
    };
    xmlHTTP.send(null);
}

