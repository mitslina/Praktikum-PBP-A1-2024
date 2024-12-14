// Nama         : Helga Nurul Bhaiti
// NIM          : 24060122130062
// Tanggal      : 01/10/2024
// File         : ajax.js
// Deskripsi    : Fungsi-fungsi javascript yang dipanggil oleh file request

// Fungsi untuk membuat objek XMLHttpRequest
function getXMLHTTPRequest() {
    //TODO: Membuat objek ajax
    if (window.XMLHttpRequest){//inisiasi fungsi ajax
        //code for modern browsers
        return new XMLHttpRequest();
    } else{
        //code for old IE browsers
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

// Server Time
function get_server_time() {
    //TODO: Membuat objek XMLHTTPRequest 
    var xmlHTTP = getXMLHTTPRequest();
    //get page true akan dijalankan secara asinkronos
    var page = 'get_server_time.php';
    

    //TODO: Menyiapkan permintaan HTTP
    //document.. akan menampilkan gambar
    xmlHTTP.open("GET",page,true);

    //TODO: Eksekusi Ajax 
    xmlHTTP.onreadystatechange = function() {
        document.getElementById('showtime').innerHTML = '<img src="images/ajax_loader.png"/>';
        if ((xmlHTTP.readyState == 4) && (xmlHTTP.status == 200)){
            document.getElementById('showtime').innerHTML = xmlHTTP.responseText;
        }
    }
    xmlHTTP.send(null);
}
//ajax berhasil dijalankkan dan didapatkan responnya dri if \ document.....
//cek status, sumber daya yg di req itu ada
//kalau memenuhi akan menampilkan responnya dri ..responseText
//klo pke post method parameter xmlhttp.send(null) akan ada parameter jdi isinya bkn null, ini null karena memakai get method
//klo berhasil mencet akan menampilkan waktu server
//jdi ajax akan request ke get_server_time (fungsi get_server_time dipanggil di show_server_time dimana ia memanggil fungsi ketika memencet tombol show server time)

// Add Customer (Method GET)
function add_customer_get() {
    //TODO: Membuat objek XMLHTTPRequest 
    var xmlhttp = getXMLHTTPRequest();

    //TODO: Mendapatkan nilai inputan name, address, city
    //get input value
    var name = encodeURI(document.getElementById('name').value);
    var address = encodeURI(document.getElementById('address').value);
    var city = encodeURI(document.getElementById('city').value);

    //TODO: Validasi dan set URL & inner
    if (name != "" && address != "" && city != "") {
        var url = "add_customer_get.php?name=" + name + "&address=" + address + "&city=" + city;
        var inner = "add_response";
        
        //TODO: Menyiapkan permintaan HTTP
        xmlhttp.open('GET',url,true);

        //TODO: Eksekusi Ajax
        xmlhttp.onreadystatechange = function(){
            document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.png"/>';
            if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
                document.getElementById(inner).innerHTML = xmlhttp.responseText;
            }
            return false;
        }
        xmlhttp.send(null);
        
    } else {
        //TODO : Membuat alert jika data form kosong
        alert("Please fill all the fields");
    } 
}


// Add Customer (Method POST)
function add_customer_post() {
    var xmlhttp = getXMLHTTPRequest();

    var name = encodeURI(document.getElementById('name').value);
    var address = encodeURI(document.getElementById('address').value);
    var city = encodeURI(document.getElementById('city').value);

    if (name != "" && address != "" && city != "") {
        var url = "add_customer_post.php"; 
        alert(url);
        var inner = "add_response";
        var params = "name=" + name + "&address=" + address + "&city=" + city;
        
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xmlhttp.onreadystatechange = function() {
            document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.png"/>';
            if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
                document.getElementById(inner).innerHTML = xmlhttp.responseText;
            }
            return false;
        }

        xmlhttp.send(params);
    } else {
        alert("Please fill all the fields");
    }
}

// Fungsi untuk memanggil ajax
function callAjax(url, inner) {
    //TODO 1: Panggil metode getXMLHTTPRequest()
    var xmlhttp = getXMLHTTPRequest();
    //TODO 2: open xmlhttp request dengan GET
    xmlhttp.open('GET', url, true);
    //TODO 3: tampilkan perintah ketika onreadystatechange
    xmlhttp.onreadystatechange = function() {
        document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.gif"/>';
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(inner).innerHTML = xmlhttp.responseText;
        }
        return false;
    }
     //TODO 4: kirim request GET
    xmlhttp.send(null);
}

// Show Customer Detail
function showCustomer(customerid) {
    //TODO 1: set inner html
    var inner = 'detail_customer';
    //TODO 2: set url dengan parameter customerid
    var url = 'get_customer.php?id=' + customerid;
    if (customerid == "") {
        // TODO 3: Mengosongkan elemen html
        document.getElementById(inner).innerHTML = '';
    } else {
        // TODO 4: Menjalankan Fungsi Ajax
        callAjax(url, inner);
    }
}

// Tugas Nomor 2 : Search Book By Title (Live search)
function searchBookByTitle(){    
    //TODO 1: Mendapatkan nilai inputan, inner, dan url
    var book_title = document.getElementById('book_title').value;
    var inner = 'book_detail';
    var url = 'get_book.php?title=' + encodeURIComponent(book_title); 

    if (book_title.trim() === "") {
        document.getElementById(inner).innerHTML = "";
        return;
    }

    // TODO 2: Menjalankan Fungsi Ajax
    callAjax(url, inner);
}

