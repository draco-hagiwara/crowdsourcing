$(function() {
	//$('#typo').css('color', '#ebc000');

	//$('.page-main > div:nth-child(1) .inner').css('opacity', 0.5);

	//$('#typo')
	//	.on('mouseover', function() {
	//		$('#typo').css({
	//			color: '#ebc000',
	//			backgroundColor: '#ae5e9b'
	//		});
	//	})
	//	.on('mouseout', function() {
	//		$('#typo').css({
	//			color: '',
	//			backgroundColor: ''
	//		});
	//	});

    $('#typo .inner')
        .css('top', '-100px')
        .on('click', function(){
            $('#typo .inner').animate({
                    top: '100px'
                },
                1500,
                function(){
                    $('#typo .inner').animate({top: '0px'}, 500);
                }
            );
        });	
	
});
