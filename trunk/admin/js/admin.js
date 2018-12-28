jQuery(document).ready(function($) {
	console.log('Script loaded');
	//Keywords
	function shortcodePanel(){
		//Fields creation
		$('#LinkOptions').append('<input type="button" class="button createCode" id="createCode" value="Create Shortcode" />');
		$('<div id="shortcodeResult" class="acf-field acf-field-textarea"><textarea id="generatedShortcode" disabled></textarea></div>"').insertAfter('#LinkOptions');
		$('<input type="button" class="button copyCode" id="copyCode" value="Copy Shortcode" />').insertAfter('#generatedShortcode');
		$('<div id="codeCopied"></div>').insertAfter('#copyCode');
		//Action on button click
		$('#createCode').click(function(){
			var keyword = $('.tagchecklist li button');
			var keywords = keyword.text();
			var array = keywords.split('Remove term: ');
			var keys = Array.from(array);
			keys.shift();
			var KeyCount = keyword.length;
			var KeyText = keyword.clone().children().remove().end().text();
			//Ad size
			var adSize = $('#adSize').find('select').children('option:selected').val();
			//URL
			var Url = $('#adURL').find('input').val();
			//Blank checkbox
			var blank = $('#acf-field_5bfc1d249b2e5-_blank');
			if(blank.is(':checked')){
				blank = '_blank';
			} else { blank = ''}
			//Nofollow checkbox
			var nofollow = $('#acf-field_5bfc1d249b2e5-nofollow');
			if(nofollow.is(':checked')){
				nofollow = 'nofollow';
			} else {nofollow = ''}
			//Generate Shortcode
			if($('#shortcodeResult').is(':visible')){
			} else {
				$('#shortcodeResult').fadeIn();
			}
			//Generate Shortcode text			
			$('#generatedShortcode').text('[house-ads keyword="'+keys+'" size="'+adSize+'" url="'+Url+'" target="'+blank+'" rel="'+nofollow+'"]');
			//Copy code button
			if($('#copyCode').is(':visible')){
			} else {
				$('#copyCode').fadeIn();
			}
			$('#copyCode').click(function(){			    
    			$('#generatedShortcode').removeAttr("disabled");				
				$('#generatedShortcode').focus();
				$('#generatedShortcode').select();
				document.execCommand('copy');
				$('#generatedShortcode').prop("disabled", true);
				$("#codeCopied").text("Copied to clipboard").show().fadeOut(1200);
			});
		});		
	}
	setTimeout(shortcodePanel, 1500);
});