// https://cs.com.dev/client/orderlist/detail01/
// クライアント納品案件のカット＆コピー
//
// mozilla
// 利用可能ブラウザはchrome42,firefox41,IE9,Opera29となっており、safariやスマホ端末は無理っぽい。
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


// Zclip はバージョンの問題で動かない？古い？
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
