// JavaScript Document
//"js_auto/autosuggest.php"
function suggest2(inputString,autosugest){
	if(inputString.length == 0) {
		$('#suggestions2').fadeOut();
	} else {
	$('#country2').addClass('load2');
		$.post(autosugest, {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions2').fadeIn();
				$('#suggestionsList2').html(data);
				$('#country2').removeClass('load2');
			}
		});
	}
}

function fillka(thisValue) {
	$('#KaUTTPName').val(thisValue);
	setTimeout("$('#suggestions2').fadeOut();", 100);
}

function fillka2(thisValue) {
	$('#KaUTTP').val(thisValue);
	setTimeout("$('#suggestions2').fadeOut();", 100);
}

//--------------------
