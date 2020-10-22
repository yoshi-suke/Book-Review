(function() {
  'use strict';
  document.addEventListener( 'DOMContentLoaded' , function() {

  var title = document.getElementById('name');
  var author = document.getElementById('author');
  var isbn = document.getElementById('isbn');
  var token = document.getElementsByName('csrf-token').item(0).content;
  isbn.onchange = function(){
    var isbn = document.getElementById('isbn').value;

    //XMLHttpRequestオブジェクトを生成
    var xmlhttp  = new XMLHttpRequest();

    //非同期通信の状態が変わった時に実行
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var response = JSON.parse(xmlhttp.responseText);
        title.value = response.bookTitle;
        author.value = response.bookAuthors;
      }
    };

    xmlhttp.open("POST", "/books/create");
    xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xmlhttp.setRequestHeader('X-CSRF-Token', token);
    xmlhttp.send("isbn=" + isbn);
  };

}, false);

})();
