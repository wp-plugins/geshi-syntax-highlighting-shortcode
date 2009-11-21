<?php
/*
Plugin Name: GeSHi Syntax Highlighting Shortcode
Description: Use custom fields to store your code snippets. This will help with the TimyMCE WYSIWYG editor included in Wordpress.
Plugin URI:  http://jquery101.com/
Version:     0.1.4
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
$geshi_supported_langs = array(	 "abap" => "ABAP", "actionscript" => "Actionscript", "actionscript3" => "Actionscript 3",
								 "ada" => "ADA", "apache" => "Apache Log", "applescript" => "AppleScript",
								 "aptsources" => "APT sources.list", "asm" => "ASM (x86)", "asp" => "ASP",
								 "autoit" => "AutoIT", "avisynth" => "AviSynth", "bash" => "Bash",
								 "bf" => "Brainfuck", "bibtex" => "BibTeX", "blitzbasic" => "BlitzBasic",
								 "bnf" => "Backus-Naur form", "boo" => "Boo", "c" => "C",
								 "cmac" => "C for Macs", "caddcl" => "CAD DCL", "cadlisp" => "CadLisp",
								 "cil" => "CIL / MSIL", "cfdg" => "CFDG", "cfm" => "ColdFusion",
								 "cmake" => "C Make", "cobol" => "COBOL", "cpp-qt" => "C++ (with QT)",
								 "cpp" => "C++", "csharp" => "C#", "css" => "CSS", 
								 "d" => "D", "dcs" => "DCS", "delphi" => "Delphi",
								 "diff" => "Diff File Format", "div" => "DIV", "dos" => "DOS",
								 "dot" => "DOT language", "eiffel" => "Eiffel", "email" => "E-mail",
								 "erlang" => "Erlang", "fo" => "FO", "fortran" => "Fortran",
								 "freebasic" => "FreeBasic", "genero" => "FourJ's Genero", "gettext" => "GetText",
								 "glsl" => "glSlang", "gml" => "GML", "bnuplot" => "gnuplot",
								 "groovy" => "Groovy", "haskell" => "Haskell", "hq9plus" => "HQ9+",
								 "html4strict" => "HTML", "idl" => "Uno IDL", "ini" => "INI (Config Files)",
								 "inno" => "Inno", "intercal" => "INTERCAL", "io" => "IO",
								 "java" => "Java", "java5" => "Java 5", "javascript" => "Javascript",
								 "kixtart" => "KiXtart", "klonec" => "KLone C", "klonecpp" => "KLone C++",
								 "latex" => "LaTeX", "lisp" => "Lisp", "locobasic" => "Loco Basic",
								 "lolcode" => "LOLcode",  "lotusformulas" => "Lotus Formulas", "lotusscript" => "LotusScript",
								 "lscript" => "LScript", "lsl2" => "LSL2", "lua" => "Lua",
								 "m68k" => "ASM (m68k)", "make" => "Make", "matlab" => "MATLAB",
								 "mirc" => "mIRC", "modula3" => "Modula3", "mpasm" => "MPASM",
								 "mxml" => "MXML", "mysql" => "MySQL", "nsis" => "NSIS",
								 "oberon2" => "Oberon-2", "objc" => "Objective C", "ocaml-brief" => "OCaml",
								 "ocaml" => "OpenOffice BASIC", "oobas" => "oobas", "oracle11" => "Oracle 11 SQL",
								 "oracle8" => "Oracle 8 SQL", "pascal" => "Pascal", "per" => "Perl",
								 "pic16" => "ASM (pic16)", "pixelbender" => "Pixel Bender", "perl" => "PERL",
								 "php-brief" => "PHP Brief", "php" => "PHP", "plsql" => "PL/SQL",
								 "povray" => "POV-Ray",	"powershell" => "PowerShell", "progress" => "Progress (OpenEdge ABL)",
								 "prolog" => "Prolog", "properties" => "properties", "providex" => "ProvideX",
								 "python" => "Python", "qbasic" => "Q(uick)BASIC",  "rails" => "Ruby on Rails",
								 "rebol" => "REBOL ", "reg" => "Windows Registry Files", "robots" => "robots.txt",
								 "ruby" => "Ruby", "sas" => "SAS", "scala" => "Scala", "scheme" => "Scheme",
								 "scilab" => "Scilab", "sdlbasic" => "SDLBasic", "smalltalk" => "Smalltalk",
								 "smarty" => "Smarty", "sql" => "SQL", "tcl" => "TCL",
								 "teraterm" => "Tera Term", "text" => "Text", "thinbasic" => "thinBasic",
								 "tsql" => "T-SQL", "typoscript" => "TypoScript", "vb" => "Visual BASIC",
								 "vbnet" => "VB.NET", "verilog" => "Verilog", "vhdl" => "VHDL",
								 "vim" => "VIM Script", "visualfoxpro" => "Visual Fox Pro", "visualprolog" => "Visual Prolog",
								 "whitespace" => "Whitespace", "whois" => "Whois", "winbatch" => "Winbatch",
								 "xml" => "XML", "xorg_conf" => "Xorg.conf", "xpp" => "X++", "z80" => "ASM (z80)" );

function geshi_head()
{
	wp_enqueue_script('jquery');
	$css_url = WP_PLUGIN_URL . "/geshi-syntax-highlighting-shortcode/css/syntax-shortcode.css.php";
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
		'toggle'=> get_option('syntax_shortcode_default_toggle')
	), $atts));
	// Compare the passed language to a list of acceptable code languages, if it not in the list, set it to HTML
	if(!array_key_exists($lang, $geshi_supported_langs))
	{
		$lang = "html4strict";
	}
	$uid = geshi_uid($tag);
	$geshi = new GeSHi(get_post_meta($post->ID, $tag, true), $lang);
	$geshi->enable_strict_mode(true);
	if(get_option('syntax_shortcode_css_output') == "enabled")
	{
		$geshi->enable_classes();
		$output .= "<style type='text/css'><!--";
		// Echo out the stylesheet for this code block
		$output .=  $geshi->get_stylesheet();
		// And continue echoing the page
		$output .= "--></style>";
	}
	/*
	GESHI_NORMAL_LINE_NUMBERS - Use normal line numbering
    GESHI_FANCY_LINE_NUMBERS - Use fancy line numbering
    GESHI_NO_LINE_NUMBERS - Disable line numbers (default)
	*/
	if(get_option('syntax_shortcode_numbering')== 0 )
	{
		$geshi->enable_line_numbers(GESHI_NO_LINE_NUMBERS);
	}
	elseif(get_option('syntax_shortcode_numbering')== 1 )
	{
		$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
	}
	elseif(get_option('syntax_shortcode_numbering')== 2 )
	{
		$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, get_option('syntax_shortcode_striping_nth'));
	}	
	if(get_option("syntax_shortcode_striping_enable") == "enabled")
	{
		$geshi->set_line_style('background: '.get_option ("syntax_shortcode_bgcolor").';', 'background: '.get_option ("syntax_shortcode_striping_color").';');
	}
	else
	{
		$geshi->set_line_style('background: '.get_option ("syntax_shortcode_bgcolor").';');

	}
	
	if($line != NULL)
	{
		$geshi->start_line_numbers_at($line);
	}
	// Build the output
   	$geshi_js_url = WP_PLUGIN_URL . "/geshi-syntax-highlighting-shortcode/js/syntax-shortcode.js.php";

	$output .= "<div class='geshi'>";
	if( get_option('syntax_shortcode_toggle_enable') == 'Enabled')
	{
//		if(strtolower($toggle) == "show" || (strtolower($toggle) == "enable" 
		$output .= "<script src='".$geshi_js_url."?uid=".$uid."&state=".$uid."'></script>";
		$output .= "<div class='geshi_code_actions'><a href='#' class='geshi_toggle' id='geshi_toggle_".$uid."'>".get_option('syntax_shortcode_toggle_text_hide')."</a></div>";
	}

	$output .= "<div class='code' id='geshi_".$uid."'>";
	// parse the code.
	$output .= $geshi->parse_code();
	$output .= "</div>";
	$output .= "</div>";
	// set the unique ID to null so the plugin created a new one for the next block of code.
	$uid = NULL;
	// return the output.
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

function syntax_shortcode_register_settings() 
{ // whitelist options

	// Code Language
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_default_lang' );
	if (! get_option ("syntax_shortcode_default_lang")) {
		add_option ("syntax_shortcode_default_lang", "php") ;
	}
	
	// Line Numbering
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_numbering' );
	if (! get_option ("syntax_shortcode_numbering")) {
		add_option ("syntax_shortcode_numbering", "GESHI_NORMAL_LINE_NUMBERS") ;
	}
	
	// Code Hiding
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_toggle_enable' );
	if (! get_option ("syntax_shortcode_toggle_enable")) {
		add_option ("syntax_shortcode_toggle_enable", "enabled") ;
	}
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_default_toggle' );
	if (! get_option ("syntax_shortcode_default_toggle")) {
		add_option ("syntax_shortcode_default_toggle", "Show") ;
	}
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_toggle_text_hide' );
	if (! get_option ("syntax_shortcode_toggle_text_hide")) {
		add_option ("syntax_shortcode_toggle_text_hide", "Show Code") ;
	}
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_toggle_text_show' );
	if (! get_option ("syntax_shortcode_toggle_text_show")) {
		add_option ("syntax_shortcode_toggle_text_show", "Show Code") ;
	}
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_toggle_align' );
	if (! get_option ("syntax_shortcode_toggle_align")) {
		add_option ("syntax_shortcode_toggle_align", "Right") ;
	}
	
	// Colors
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_bgcolor' );
	if (! get_option ("syntax_shortcode_bgcolor")) {
		add_option ("syntax_shortcode_bgcolor", "#fcfcfc") ;
	}	


	// Zebra Striping
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_striping_enable' );
	if (! get_option ("syntax_shortcode_striping_enable")) {
		add_option ("syntax_shortcode_striping_enable", "Enabled") ;
	}
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_striping_color' );
	if (! get_option ("syntax_shortcode_striping_color")) {
		add_option ("syntax_shortcode_striping_color", "#f0f0f0") ;
	}
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_striping_nth', 'intval' );
	if (! get_option ("syntax_shortcode_striping_nth")) {
		add_option ("syntax_shortcode_striping_nth", 2) ;
	}
	
	// Other settings
	register_setting( 'syntax_shortcode_options', 'syntax_shortcode_css_output' );
	if (! get_option ("syntax_shortcode_css_output")) {
		add_option ("syntax_shortcode_css_output", "enabled") ;
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
	
	wp_register_script('jquery-ui-custom-syntax', ( plugins_url('geshi-syntax-highlighting-shortcode/js/jquery-ui-1.7.2.custom.min.js')), false, '1.7.2',true);
	wp_enqueue_script('jquery-ui-custom-syntax');

} else {
  // non-admin enqueues, actions, and filters
}
?>