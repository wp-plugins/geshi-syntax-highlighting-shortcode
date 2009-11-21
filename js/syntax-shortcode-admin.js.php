<?php
header('Content-type: text/javascript');
require_once('../../../../wp-load.php'); 
?>
jQuery(function($) {

	$('#syntax_shortcode_bgcolor')
	.ColorPicker({
		color: '<?php echo get_option('syntax_shortcode_bgcolor'); ?>',
		onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val('#' + hex);
			$(el).css('backgroundColor', '#' + hex);
			$(el).ColorPickerHide();
		},
		onHide: function (el) {
			$(el).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#syntax_shortcode_bgcolor').css('backgroundColor', '#' + hex);
			$('#syntax_shortcode_bgcolor').val('#' + hex);
		}
	})
	$('#syntax_shortcode_striping_color')
	.ColorPicker({
		color: '<?php echo get_option('syntax_shortcode_striping_color'); ?>',
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val('#' + hex);
			$(el).css('backgroundColor', '#' + hex);

			$(el).ColorPickerHide();
		},
		onHide: function (el) {
			$(el).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#syntax_shortcode_striping_color').css('backgroundColor', '#' + hex);
			$('#syntax_shortcode_striping_color').val('#' + hex);
		}
	})
	$('#syntax_shortcode_striping_nth_slider').slider({ 
		min: 1,
		max: 25,
		value: <?php echo get_option('syntax_shortcode_striping_nth'); ?>,
		change: function(event, ui) { 
			$('#syntax_shortcode_striping_nth').val(ui.value);
			$('#syntax_shortcode_striping_color_picker_text').html('<b>'+ui.value+'</b>');
		}
		

	});
	$("#syntax_shortcode_striping_nth").val($("#syntax_shortcode_striping_nth_slider").slider("value"));
			$('#syntax_shortcode_striping_color_picker_text').html('<b>'+ui.value+'</b>');

});