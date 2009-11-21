<?php
header('Content-type: text/javascript');
require_once('../../../../wp-load.php'); 
if(isset($_GET['uid']) && ctype_xdigit($_GET['uid']))
{
	$uid = $_GET['uid'];
}
?>
jQuery(document).ready(function($) {
	$('#geshi_<?php echo $uid; ?>').hide('slow');
	$("#geshi_toggle_<?php echo $uid; ?>").text("<?php echo get_option('syntax_shortcode_toggle_text_show'); ?>");
	
	$("#geshi_toggle_<?php echo $uid; ?>").toggle(function () {
		$('#geshi_<?php echo $uid; ?>').show('slow');
		$("#geshi_toggle_<?php echo $uid; ?>").text("<?php echo get_option('syntax_shortcode_toggle_text_hide'); ?>");

		return false;
	}, function() {
		$('#geshi_<?php echo $uid; ?>').hide('slow');
		$("#geshi_toggle_<?php echo $uid; ?>").text("<?php echo get_option('syntax_shortcode_toggle_text_show'); ?>");
		return false;
	});		

	return false;
});
<?php

?>