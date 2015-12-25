// https://cs.com.dev/my_entrylist/detail01/
// 「タイトル」/「本文」の文字数カウント

$(function(){
    $('#rep_title').bind('keyup',function(){
        var t_min = $('#t_char_min').text();            // 最低 使用文字数
        var t_max = $('#t_char_max').text();            // 最大 使用文字数
        var thisValueLength = $(this).val().replace(/\s+/g,'').length;    // 改行空白削除
        //console.log(t_min);
        //console.log(t_max);
        //console.log(thisValueLength);
        
        if (thisValueLength < t_min || thisValueLength > t_max) {
            $('.count1').css("color","red");
        } else {
            $('.count1').css("color","");
        }
        $('.count1').html(thisValueLength);
    });

    $('#rep_text_body').bind('keyup',function(){
        var b_min = $('#b_char_min').text();            // 最低 使用文字数
        var b_max = $('#b_char_max').text();            // 最大 使用文字数
        var thisValueLength = $(this).val().replace(/\s+/g,'').length;    // 改行空白削除
        
        if (thisValueLength < b_min || thisValueLength > b_max) {
            $('.count2').css("color","red");
        } else {
            $('.count2').css("color","");
        }
        $('.count2').html(thisValueLength);
    });
});
