// Nama         : Yesi Dwi Ningtias
// NIM          : 24060122120027
// Tanggal      : 29 September 2024
// File         : ajax.js
// Deskripsi    : Fungsi-fungsi javascript yang dipanggil oleh file request

// Fungsi untuk membuat objek XMLHttpRequest
function getXMLHTTPRequest() {
    //TODO: Membuat objek ajax
    if (window.XMLHttpRequest){
        return new XMLHttpRequest();
    }else{
        return new ActiveXObject("Microsoft.XMLHTTP");
    }

}

// Server Time
function get_server_time() {
    //TODO: Membuat objek XMLHTTPRequest 
    var xmlHTTP = getXMLHTTPRequest();

    //TODO: Menyiapkan permintaan HTTP
    var page = 'get_server_time.php';
    xmlHTTP.open("GET", page, true);

    //TODO: Eksekusi Ajax 
    xmlHTTP.onreadystatechange = function() {
        document.getElementById('showtime').innerHTML = '<img src="../Praktikum5/images/ajax_loader.png"/>';
        if ((xmlHTTP.readyState == 4) && (xmlHTTP.status == 200)){
            document.getElementById('showtime').innerHTML = xmlHTTP.responseText;
        }

    }
    xmlHTTP.send(null);
}

// Add Customer (Method GET)
function add_customer_get() {
    //TODO: Membuat objek XMLHTTPRequest 
    var xmlhttp = getXMLHTTPRequest(); 
    //TODO: Mendapatkan nilai inputan name, address, city
     var name = encodeURI(document.getElementById("name").value);
     var address = encodeURI(document.getElementById("address").value);
     var city = encodeURI(document.getElementById("city").value);

    //TODO: Validasi dan set URL & inner
    if (name != "" && address != "" && city != "") {
        var url = "add_customer_get.php?name=" + name + "&address=" + address + "&city=" + city;
        var inner = "add_response";
        
        //TODO: Menyiapkan permintaan HTTP
        xmlhttp.open("GET", url, true);
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
    //TODO 1: Membuat objek XMLHTTPRequest 
    var xmlhttp = getXMLHTTPRequest();    

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
        var params = "name=" + name + "&address=" + address + "&city=" + city;
        //TODO 6: open xmlhttp request dengan POST, url secara asinkronus
        xmlhttp.open("POST", url, true);
        //TODO 7: set request header
        xmlhttp.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded");
        //TODO 8: tampilkan perintah ketika onreadystatechange
        xmlhttp.onreadystatechange = function () {
            document.getElementById(inner).innerHTML =
            '<img src="images/ajax_loader.png"/>';
            if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
                document.getElementById(inner).innerHTML = xmlhttp.responseText;
            }
            return false;
        };
        //TODO 9: kirim request POST
        xmlhttp.send(params);
    }else{
        alert("Please fill all the fields");
    }
}

// Fungsi untuk memanggil ajax
function callAjax(url, inner) {
    //TODO 1: Panggil metode getXMLHTTPRequest()
    var xmlhttp = getXMLHTTPRequest ();
    //TODO 2: open xmlhttp request dengan GET
    xmlhttp.open("GET", url, true);
    //TODO 3: tampilkan perintah ketika onreadystatechange
    xmlhttp.onreadystatechange = function() {
        document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.png"/>';
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
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
        callAjax(url,inner);
        
    }
}

// Tugas Nomor 2 : Search Book By Title (Live search)
function searchBookByTitle() {
  // Membuat objek XMLHTTPRequest
  var xmlHTTP = getXMLHTTPRequest();

  // Mendapatkan nilai inputan, inner, dan url
  var book_title = document.getElementById("book_title").value; 
  var inner = "book_details";
  var url = "get_book.php?title=" + encodeURIComponent(book_title);

  // Tidak menampilkan data buku ketika title tidak dimasukkan
  if (book_title.trim() === "") {
    document.getElementById(inner).innerHTML = "";
    return;
  }

  // Menyiapkan permintaan HTTP
  xmlHTTP.open("GET", url, true);

  // Eksekusi Ajax
  xmlHTTP.onreadystatechange = function () {
    if ((xmlHTTP.readyState == 4) && (xmlHTTP.status == 200)) {
      document.getElementById(inner).innerHTML = xmlHTTP.responseText;
    }
  };
  xmlHTTP.send(null);
}


