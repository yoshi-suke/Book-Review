(function() {
  'use strict';
  document.addEventListener( 'DOMContentLoaded' , function() {

    var cmds = document.getElementsByClassName('del');
    // var test = document.getElementById('test');
    var i;

    // test.addEventListener('click', function(e) {
      //   console.log('hello!');
      // });



      for (i = 0; i < cmds.length; i++) {
        // console.log(typeof(cmds[i]));
        cmds[i].addEventListener('click', function(e) {
          console.log(cmds[i]);

          e.preventDefault();
          if(confirm('削除しますか？')) {
            document.getElementById('form_' + this.dataset.id).submit();
          }
        });
      }
  }, false);

//
})();
