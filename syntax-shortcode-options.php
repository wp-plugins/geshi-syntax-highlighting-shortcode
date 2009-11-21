<div class="wrap">
<?php
	$admin_css_url = WP_PLUGIN_URL . "/geshi-syntax-highlighting-shortcode/css/syntax-shortcode-admin.css.php";
	echo "\n<link rel='stylesheet' href='".$admin_css_url."' type='text/css' media='screen' />\n";
	
	$picker_css_url = WP_PLUGIN_URL . "/geshi-syntax-highlighting-shortcode/css/colorpicker.css";
	echo "\n<link rel='stylesheet' href='".$picker_css_url."' type='text/css' media='screen' />\n";
	
	$jquery_ui_css_url = WP_PLUGIN_URL . "/geshi-syntax-highlighting-shortcode/css/base/ui.all.css";
	echo "\n<link rel='stylesheet' href='".$jquery_ui_css_url."' type='text/css' media='screen' />\n";
	
	$picker_js_url = WP_PLUGIN_URL . "/geshi-syntax-highlighting-shortcode/js/colorpicker.js";
	echo "\n<script src='".$picker_js_url."' type='text/javascript' ></script>\n";
	
	$admin_js_url = WP_PLUGIN_URL . "/geshi-syntax-highlighting-shortcode/js/syntax-shortcode-admin.js.php";
	echo "\n<script src='".$admin_js_url."' type='text/javascript' ></script>\n";
?>
	
	
	<h2>Syntax Shortcode Options</h2>
	<form method="post" action="options.php">
		<?php
			settings_fields( 'syntax_shortcode_options' );
		?>
		<h3>Code Language</h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Default Code Language</th>
				<td width="300px">
					<select name="syntax_shortcode_default_lang">
					<?php
					if(is_array($geshi_supported_langs))
					{
						foreach($geshi_supported_langs as $this_lang_key => $this_lang_value)
						{
							echo "<option value='".$this_lang_key."'";
							if($this_lang == get_option('syntax_shortcode_default_lang'))
							{
								echo " selected";
							}
							echo ">".$this_lang_value."&nbsp;&nbsp;</option>\n";
						}
					}				
					
					?>
					</select>
					</td><td><span class="description">The code language that will be used if you do not include one in the shortcode.</span></td>
				</td>
			</tr>
		</table>
		<h3>Line Numbering</h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Line Numbering Type</th>
				<td width="300px">
					<select name="syntax_shortcode_numbering">
					<?php 
					$syntax_shortcode_numbering_list = array(	0 => "Disable line numbers (default)",
																1 => "Use normal line numbering",
																2 => "Use fancy line numbering");
					
					if(is_array($syntax_shortcode_numbering_list))
					{
						foreach($syntax_shortcode_numbering_list as $this_option_name=>$this_option_value)
						{
							echo "<option value='".$this_option_name."'";
							if($this_option_name == get_option('syntax_shortcode_numbering'))
							{
								echo " selected";
							}
							echo ">".$this_option_value."&nbsp;&nbsp;</option>\n";
						}
					}	
					?>
					</select>
					</td><td><span class="description">Line numbering enabled</span></td>
				</td>
			</tr>
		</table>
		<h3>Code Hiding</h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Enable jQuery-based Collapse</th>
				<td width="300px">
					<input type="checkbox" id="syntax_shortcode_toggle_enable" name="syntax_shortcode_toggle_enable" value="enabled"
					<?php
					if(get_option('syntax_shortcode_toggle_enable') == "enabled")
					{
						echo " checked";
					}
					?>
					>
					
					</td><td><span class="description">Turns colapsing feature on/off.</span></td>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Toggle default</th>
				<td width="300px">
					<select name="syntax_shortcode_default_toggle">
					<?php $syntax_shortcode_default_toggle_list = array("Show","Hide");
					
					if(is_array($syntax_shortcode_default_toggle_list))
					{
						foreach($syntax_shortcode_default_toggle_list as $this_default)
						{
							echo "<option value='".$this_default."'";
							if($this_default == get_option('syntax_shortcode_default_toggle'))
							{
								echo " selected";
							}
							echo ">".$this_default."&nbsp;&nbsp;</option>\n";
						}
					}	
					?>
					</select>
					</td><td><span class="description">Default toggle position.</span></td>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Show Text</th>
				<td width="300px">
					<input type="text" id="syntax_shortcode_toggle_text_show" name="syntax_shortcode_toggle_text_show" value="<?php echo get_option('syntax_shortcode_toggle_text_show'); ?>" size="32" maxlength="20">
					
					</td><td><span class="description">syntax_shortcode_toggle_text_hide 20Max</span></td>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Hide Text</th>
				<td width="300px">
					<input type="text" id="syntax_shortcode_toggle_text_hide" name="syntax_shortcode_toggle_text_hide" value="<?php echo get_option('syntax_shortcode_toggle_text_hide'); ?>" size="32" maxlength="20">
					
					
					</td><td><span class="description">syntax_shortcode_toggle_text_hide 20Max</span></td>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Toggle Text Align</th>
				<td width="300px">
					<select name="syntax_shortcode_toggle_align">
					<?php $syntax_shortcode_toggle_align_list = array("Left","Center","Right");
					
					if(is_array($syntax_shortcode_toggle_align_list))
					{
						foreach($syntax_shortcode_toggle_align_list as $this_align)
						{
							echo "<option value='".$this_align."'";
							if($this_align == get_option('syntax_shortcode_toggle_align'))
							{
								echo " selected";
							}
							echo ">".$this_align."&nbsp;&nbsp;</option>\n";
						}
					}	
					?>
					</select>
					</td><td><span class="description">syntax_shortcode_toggle_align Left Center Right</span></td>
				</td>
			</tr>
		</table>
		<h3>Colors</h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Background Color</th>
				<td width="300px">
					<input type="text" id="syntax_shortcode_bgcolor" name="syntax_shortcode_bgcolor" value="<?php echo get_option('syntax_shortcode_bgcolor'); ?>" size="8" maxlength="7"style="background-color:<?php echo get_option('syntax_shortcode_bgcolor'); ?>">
					<div id="syntax_shortcode_bgcolor_picker"/>
					</td>
					<td><span class="description">Background of the code area.</span></td>
				</td>
			</tr>
		</table>
		<h3>Zebra Striping</h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Enable Zebra Striping</th>
				<td width="300px">
					<input type="checkbox" id="syntax_shortcode_striping_enable" name="syntax_shortcode_striping_enable" value="enabled"
					<?php
					if(get_option('syntax_shortcode_striping_enable') == "enabled")
					{
						echo " checked";
					}
					?>
					>
					</td><td><span class="description">Turns Zebra Striping feature on/off. Note: Zebra Striping only works when <em>Line Numbering Type</em> is set to ""Use fancy line numbering"</span></td>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Stripe every n<sup>th</sup> line</th>
				<td width="300px">
					<input type="text" id="syntax_shortcode_striping_nth" name="syntax_shortcode_striping_nth" value="<?php echo get_option('syntax_shortcode_striping_nth'); ?>" size="8" maxlength="7">
					<div id="syntax_shortcode_striping_nth_slider"/>
					</td><td><span class="description">Background color of the Zebra Stripes.</span></td>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Background Color</th>
				<td width="300px">
					<input type="text" id="syntax_shortcode_striping_color" name="syntax_shortcode_striping_color" value="<?php echo get_option('syntax_shortcode_striping_color'); ?>" size="8" maxlength="7" style="background-color:<?php echo get_option('syntax_shortcode_striping_color'); ?>">
					<div id="syntax_shortcode_striping_color_picker"></div>
					</td><td><span class="description">Background color of the Zebra Stripes.</span></td>
				</td>
			</tr>
		</table>
		<h3>CSS Output</h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Enable CSS Output</th>
				<td width="300px">
					<input type="checkbox" id="syntax_shortcode_css_output" name="syntax_shortcode_css_output" value="enabled"
					<?php
					if(get_option('syntax_shortcode_css_output') == "enabled")
					{
						echo " checked";
					}
					?>
					>
					</td>
					<td><span class="description">When displaying large blocks of code, using CSS output will reduce the size of the outputted code.</span></td>
				</td>
			</tr>
		</table>			
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
	
</div>