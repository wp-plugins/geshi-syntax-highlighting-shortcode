<div class="wrap">
	<h2>Syntax Shortcode Options</h2>
	<form method="post" action="options.php">
		<?php
			settings_fields( 'syntax_shortcode_options' );
		?>
		<h3>Code Language</h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Default Code Language</th>
				<td>
					<select name="syntax_shortcode_default_lang">
					<?php
					if(is_array($geshi_supported_langs))
					{
						foreach($geshi_supported_langs as $this_lang)
						{
							echo "<option value='".$this_lang."'";
							if($this_lang == get_option('syntax_shortcode_default_lang'))
							{
								echo " selected";
							}
							echo ">".$this_lang."&nbsp;&nbsp;</option>\n";
						}
					}				
					
					?>
					</select>
					<span class="description">The code language that will be used if you do not include one in the shortcode.</span>
				</td>
			</tr>
		</table>
		<h3>Line Numbering</h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Line Numbering Type</th>
				<td>
					<select name="syntax_shortcode_numbering">
					<?php $syntax_shortcode_numbering_list = array(	GESHI_NO_LINE_NUMBERS =>"Disable line numbers (default)",
																	GESHI_NORMAL_LINE_NUMBERS=>"Use normal line numbering",
																	GESHI_FANCY_LINE_NUMBERS=>"Use fancy line numbering");
					
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
					<span class="description">Line numbering enabled</span>
				</td>
			</tr>
		</table>
		<h3>Code Hiding</h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Enable jQuery-based Collapse</th>
				<td>
					<input type="checkbox" id="syntax_shortcode_toggle_enable" name="syntax_shortcode_toggle_enable" value="enabled"
					<?php
					if(get_option('syntax_shortcode_toggle_enable') == "enabled")
					{
						echo " checked";
					}
					?>
					>
					
					<span class="description">Turns colapsing feature on/off.</span>
				</td>
			</tr>
<!--			<tr valign="top">
				<th scope="row">Toggle default</th>
				<td>
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
					<span class="description">Default toggle position.</span>
				</td>
			</tr>
-->			<tr valign="top">
				<th scope="row">Show Text</th>
				<td>
					<input type="text" id="syntax_shortcode_toggle_text_show" name="syntax_shortcode_toggle_text_show" value="<?php echo get_option('syntax_shortcode_toggle_text_show'); ?>" size="32" maxlength="20">
					
					<span class="description">syntax_shortcode_toggle_text_hide 20Max</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Hide Text</th>
				<td>
					<input type="text" id="syntax_shortcode_toggle_text_hide" name="syntax_shortcode_toggle_text_hide" value="<?php echo get_option('syntax_shortcode_toggle_text_hide'); ?>" size="32" maxlength="20">
					
					
					<span class="description">syntax_shortcode_toggle_text_hide 20Max</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Toggle Text Align</th>
				<td>
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
					<span class="description">syntax_shortcode_toggle_align Left Center Right</span>
				</td>
			</tr>
		</table>
					
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
</div>