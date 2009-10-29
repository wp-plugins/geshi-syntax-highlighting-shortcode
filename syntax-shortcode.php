<?php
/*
Plugin Name: GeSHi Syntax Highlighting Shortcode
Description: Use custom fields to store your code snippets. This will help with the TimyMCE WYSIWYG editor included in Wordpress.
Plugin URI:  http://jquery101.com/
Version:     0.1
Author:      Adam Benoit
Author URI:  http://adambenoit.com
*/

/*

USAGE:
use [syntax] shortcode in your post content to show code saved in a custom field. 

EXAMPLE:
[syntax lang=<lang> ]< Custom Field Name >[/syntax]

*/

if(!function_exists("GeSHi"))
{
	include_once("geshi/geshi.php");
}

if (!defined("WP_CONTENT_URL")) define("WP_CONTENT_URL", get_option("siteurl") . "/wp-content");
if (!defined("WP_PLUGIN_URL"))  define("WP_PLUGIN_URL",  WP_CONTENT_URL        . "/plugins");

// Declare a list of acceptable code languages.
$geshi_supported_langs = array("abap", "actionscript", "actionscript3", "ada", "apache", "applescript", "aptsources", "asm", "asp", "autoit", "avisynth", "bash", "bf", "bibtex", "blitzbasic", "bnf", "boo", "c", "cmac", "caddcl", "cadlisp", "cil", "cfdg", "cfm", "cmake", "cobol", "cpp-qt", "cpp", "csharp", "css", "d", "dcs", "delphi", "diff", "div", "dos", "dot", "eiffel", "email", "erlang", "fo", "fortran", "freebasic", "genero", "gettext", "glsl", "gml", "bnuplot", "groovy", "haskell", "hq9plus", "html4strict", "idl", "ini", "inno", "intercal", "io", "java", "java5", "javascript", "kixtart", "klonec", "klonecpp", "latex", "lisp", "locobasic", "lolcode lotusformulas", "lotusscript", "lscript", "lsl2", "lua", "m68k", "make", "matlab", "mirc", "modula3", "mpasm", "mxml", "mysql", "nsis", "oberon2", "objc", "ocaml-brief", "ocaml", "oobas", "oracle11", "oracle8", "pascal", "per", "pic16", "pixelbender", "perl", "php-brief", "php", "plsql", "povray", "powershell", "progress", "prolog", "properties", "providex", "python", "qbasic", "rails", "rebol", "reg", "robots", "ruby", "sas", "scala", "scheme", "scilab", "sdlbasic", "smalltalk", "smarty", "sql", "tcl", "teraterm", "text", "thinbasic", "tsql", "typoscript", "vb", "vbnet", "verilog", "vhdl", "vim", "visualfoxpro", "visualprolog", "whitespace", "whois", "winbatch", "xml", "xorg_conf", "xpp", "z80");

function geshi_head()
{
	wp_enqueue_script('jquery');
	$css_url = WP_PLUGIN_URL . "/syntax-shortcode/syntax-shortcode.css.php";
	echo "\n".'<link rel="stylesheet" href="' . $css_url . '" type="text/css" media="screen" />'."\n";
}

function geshi_uid($seed = NULL)
{
	if($seed == NULL)
	{
		$seed = time();
	}
	return hash("md5", $seed);
}

function syntax_shortcode($atts, $tag) {
	// Include the $post object.
	global $post;
	global $geshi_supported_langs;

	
	// Extract the variables passed theough the short code 
	// included in the post and set defaults if nothing is passed.
	extract(shortcode_atts(array(
		'lang' => get_option('syntax_shortcode_default_lang'),
		'line' => NULL,
		'toggle'=> get_option('syntax_shortcode_toggle_enable')
	), $atts));
	// Compare the passed language to a list of acceptable code languages, if it not in the list, set it to HTML
	if(!in_array($lang, $geshi_supported_langs))
	{
		$lang = "html4strict";
	}
	$uid = geshi_uid($tag);
	$geshi = new GeSHi(get_post_meta($post->ID, $tag, true), $lang);
	/*
	GESHI_NORMAL_LINE_NUMBERS - Use normal line numbering
    GESHI_FANCY_LINE_NUMBERS - Use fancy line numbering
    GESHI_NO_LINE_NUMBERS - Disable line numbers (default)
	*/
	echo get_option('syntax_shortcode_numbering');
    $geshi->enable_line_numbers(get_option('syntax_shortcode_numbering'),2);
	$geshi->set_line_style('background: #fcfcfc;', 'background: #f0f0f0;');
	if($line != NULL)
	{
		$geshi->start_line_numbers_at($line);
	}
	// Build the output
   	$geshi_js_url = WP_PLUGIN_URL . "/syntax-shortcode/syntax-shortcode.js.php";

	$output = "<div class='geshi'>";
	if($toggle == 'enabled')
	{
		$output .= "<script src='".$geshi_js_url."?uid=".$uid."'></script>";
		$output .= "<div class='geshi_code_actions'><a href='#' class='geshi_toggle' id='geshi_toggle_".$uid."'>".get_option('syntax_shortcode_toggle_text_hide')."</a></div>";
	}
	else
	{
		// nothing
	}
	$output .= "<div class='code' id='geshi_".$uid."'><pre>";
	$output .= $geshi->parse_code();
	$output .= "</pre>";
	$output .= "</div>";
	$output .= "</div>";
	$uid == NULL;
	return $output;
	
}
// Admin Menu item 
function syntax_shortcode_menu() {
  add_menu_page('Syntax Shortcode Options', 'Syntax Shortcode', 8, 'syntax-shortcode', 'syntax_shortcode_options');
}

// Admin Options page
function syntax_shortcode_options() {
	global $geshi_supported_langs;
	include_once("syntax-shortcode-options.php");
}

function syntax_shortcode_register_settings() { // whitelist options
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_default_lang' );
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_numbering' );
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_toggle_enable' );
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_default_toggle' );
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_toggle_text_hide' );
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_toggle_text_show' );
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_toggle_align' );
	if (! get_option ("syntax_shortcode_default_lang")) {
		add_option ("syntax_shortcode_default_lang", "php") ;
	}
	if (! get_option ("syntax_shortcode_numbering")) {
		add_option ("syntax_shortcode_numbering", "GESHI_NORMAL_LINE_NUMBERS") ;
	}
	if (! get_option ("syntax_shortcode_toggle_enable")) {
		add_option ("syntax_shortcode_toggle_enable", "Enabled") ;
	}
	if (! get_option ("syntax_shortcode_default_toggle")) {
		add_option ("syntax_shortcode_default_toggle", "Show") ;
	}
	if (! get_option ("syntax_shortcode_toggle_text_show")) {
		add_option ("syntax_shortcode_toggle_text_show", "Show Code") ;
	}
	if (! get_option ("syntax_shortcode_toggle_text_show")) {
		add_option ("syntax_shortcode_toggle_text_show", "Show Code") ;
	}
	if (! get_option ("syntax_shortcode_toggle_align")) {
		add_option ("syntax_shortcode_toggle_align", "Right") ;
	}
}


// Add hooks
// css
add_action('wp_head', 'geshi_head');

// shortcode
@add_shortcode('syntax','syntax_shortcode');

// Admin Actions
if ( is_admin() )
{ 	// admin menu item
	add_action('admin_menu', 'syntax_shortcode_menu');
	// Register settings 
	add_action( 'admin_init', 'syntax_shortcode_register_settings' );
} else {
  // non-admin enqueues, actions, and filters
}
?>