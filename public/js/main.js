(function() {
  'use strict';
  document.addEventListener( 'DOMContentLoaded' , function() {

    var cmds = document.getElementsByClassName('del');
    var i;
      for (i = 0; i < cmds.length; i++) {
        cmds[i].addEventListener('click', function(e) {
          console.log(cmds[i]);
          e.preventDefault();
          if(confirm('削除しますか？')) {
            document.getElementById('form_' + this.dataset.id).submit();
          }
        });
      }
  }, false);
})();
