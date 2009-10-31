<?php 
header('Content-type: text/css'); 
require_once('../../../wp-load.php'); 
?>
.geshi {
  color: #100;
  background-color: #f9f9f9;
  border: 1px solid silver;
  margin: 0 0 1.5em 0;
  overflow: auto;
}

/* IE FIX */
.geshi {
  overflow-x: auto;
  overflow-y: hidden;
  padding-bottom: expression(this.scrollWidth > this.offsetWidth ? 15 : 0);
  width: 100%;
}

.geshi table {
  border-collapse: collapse;
}

.geshi div, .geshi td {
  vertical-align: top;
  padding: 2px 4px;
}
/*
.geshi .line_numbers {
  text-align: right;
  background-color: #def;
  color: gray;
  overflow: visible;
}
*/
/* potential overrides for other styles */
.geshi pre {
  margin: 0;
  width: auto;
  float: none;
  clear: none;
  overflow: visible;
  font-size: 12px;
  line-height: 1.333;
  white-space: pre;
}


// // // 

.geshi_toggle{
	
}
.geshi_code_actions{
	text-align: <?php echo get_option('syntax_shortcode_toggle_align'); ?>;
	padding: 4px;
}
</style>