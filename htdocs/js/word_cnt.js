// https://cs.com.dev/my_entrylist/detail01/
// �u�^�C�g���v/�u�{���v�̕������J�E���g

$(function(){
    $('#rep_title').bind('keyup',function(){
        var t_min = $('#t_char_min').text();            // �Œ� �g�p������
        var t_max = $('#t_char_max').text();            // �ő� �g�p������
        var thisValueLength = $(this).val().replace(/\s+/g,'').length;    // ���s�󔒍폜
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
        var b_min = $('#b_char_min').text();            // �Œ� �g�p������
        var b_max = $('#b_char_max').text();            // �ő� �g�p������
        var thisValueLength = $(this).val().replace(/\s+/g,'').length;    // ���s�󔒍폜
        
        if (thisValueLength < b_min || thisValueLength > b_max) {
            $('.count2').css("color","red");
        } else {
            $('.count2').css("color","");
        }
        $('.count2').html(thisValueLength);
    });
});
