// https://cs.com.dev/client/orderlist/detail01/
// �N���C�A���g�[�i�Č��̃J�b�g���R�s�[
//
// mozilla
// ���p�\�u���E�U��chrome42,firefox41,IE9,Opera29�ƂȂ��Ă���Asafari��X�}�z�[���͖������ۂ��B
//         https://developer.mozilla.org/ja/docs/Web/API/Document/execCommand#Browser_Compatibility
// https://developer.mozilla.org/ja/docs/Web
$(function(){
    $('.btn01').click(function(){
        var key = ( $(this).hasClass('cut') ) ? 'cut' : 'copy';
        var text = document.querySelector("#rep_title");

        text.select();
        document.execCommand(key);
    });
    $('.btn02').click(function(){
        var key = ( $(this).hasClass('cut') ) ? 'cut' : 'copy';
        var text = document.querySelector("#rep_text_body");

        text.select();
        document.execCommand(key);
    });
});


// Zclip �̓o�[�W�����̖��œ����Ȃ��H�Â��H
//$(function(){
//    $('button#copy_title').zclip({
//        path:'ZeroClipboard.swf',
//        copy:function(){
//          return $('input#rep_title').val();
//        }
//    });
//    $("a#copy_body").zclip({
//        path:"ZeroClipboard.swf",
//        copy:function(){
//          return $("textarea#rep_text_body").text();
//        }
//    });
//});
