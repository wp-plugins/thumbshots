<div class="wrap">
	<h2><?php _e('Thumbshots Configuration', $this -> plugin_name); ?></h2>

	<form action="<?= $this -> url; ?>" method="post">	
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="linkthumbs_Y"><?php _e('Link Image to URL', $this -> plugin_name); ?></label></th>
					<td>
						<label><input <?= ($this -> get_option('linkthumbs') == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="linkthumbs" value="Y" id="linkthumbs_Y" /> <?php _e('Yes', $this -> plugin_name); ?></label>
						<label><input <?= ($this -> get_option('linkthumbs') == "N") ? 'checked="checked"' : ''; ?> type="radio" name="linkthumbs" value="N" id="linkthumbs_N" /> <?php _e('No', $this -> plugin_name); ?></label>
						<span class="howto"><?php _e('link each thumbnail to its URL', $this -> plugin_name); ?></span>
					</td>
				</tr>
				<tr>
					<th><label for="autobacklink_Y"><?php _e('Thumbshots Link in Footer', $this -> plugin_name); ?></label></th>
					<td>
						<label><input <?= ($this -> get_option('autobacklink') == "Y") ? 'checked="checked"' : ''; ?> type="radio" name="autobacklink" value="Y" id="autobacklink_Y" /> <?php _e('Yes', $this -> plugin_name); ?></label>
						<label><input <?= ($this -> get_option('autobacklink') == "N") ? 'checked="checked"' : ''; ?> type="radio" name="autobacklink" value="N" id="autobacklink_N" /> <?php _e('No', $this -> plugin_name); ?></label>
						<span class="howto"><?php _e('put a thumbshots.org backlink in the footer of your website', $this -> plugin_name); ?></span>
					</td>
				</tr>
			</tbody>
		</table>
	
		<p class="submit">
			<input type="submit" class="button-primary" name="submit" value="<?php _e('Save Configuration', $this -> plugin_name); ?>" />
		</p>
	</form>
</div>