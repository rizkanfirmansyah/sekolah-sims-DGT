// JavaScript Document
//"js_auto/autosuggest.php"
function suggest(inputString,autosugest){
    if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
	$('#country').addClass('load');
		$.post(autosugest, {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions').fadeIn();
				$('#suggestionsList').html(data);
				$('#country').removeClass('load');
			}
		});
	}
}

function fill(thisValue) {
	$('#kodepustaka').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

function fill2(thisValue) {
	$('#judul').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}

//--------------------
