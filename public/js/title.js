(function() {
  'use strict';
  document.addEventListener( 'DOMContentLoaded' , function() {

  var title = document.getElementById('name');
  var search = document.getElementById('search');
  var author = document.getElementById('author');
  var isbn = document.getElementById('isbn');
  var token = document.getElementsByName('csrf-token').item(0).content;
  search.onclick = function(){
    var titleValue = title.value;

    //XMLHttpRequestオブジェクトを生成
    var xmlhttp  = new XMLHttpRequest();

    //非同期通信の状態が変わった時に実行
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var response = JSON.parse(xmlhttp.responseText);
        var card = document.getElementById('card');
        // 以前の検索結果を削除
        var oldCand = document.getElementsByClassName('candidate');
        for (let i = 0, len = oldCand.length; i < len; i++) {
          card.removeChild(oldCand[0]);
        };
        for (let i = 0, len = response.length; i < len; i++) {
          //候補リストの表示
          var anchor = document.createElement('a');
          var div = document.createElement('div');
          var br = document.createElement('br');
          div.classList.add('media', 'border', 'border-secondary', 'rounded', 'bg-white', 'py-4', 'mb-1', 'candidate');
          var tmp_title = document.createTextNode(response[i].bookTitle);
          if (response[i].bookAuthors === null) {
            // 著者がいなかったパターン
              var tmp_author = document.createTextNode('(著者不明)');
          } else {
            // 著者がいたパターン
            var tmp_author = document.createTextNode('(' + response[i].bookAuthors + ')');
          }
          div.appendChild(tmp_title);
          div.appendChild(br);
          div.appendChild(tmp_author);
          card.appendChild(div);
        }
          var cand = document.getElementsByClassName('candidate');
          for(let i = 0, len = cand.length; i  < len; i++) {
            cand[i].addEventListener('click', () => {
              var text = cand[i].textContent;
              title.value = text.split('(')[0];
              author.value = text.split('(')[1].split(')')[0];
              isbn.value = response[i].bookIsbn;
            });
          }
      }
    };
    xmlhttp.open("POST", "/books/create");
    xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xmlhttp.setRequestHeader('X-CSRF-Token', token);
    xmlhttp.send("name=" + titleValue);
  };

}, false);

})();
