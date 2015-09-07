<form action="<?php echo home_url( '/' ); ?>" class="search-form clearfix">
	<fieldset>
		<input type="text" class="search-form-input text" name="s" onfocus="if (this.value == '<?php _e('Search...','island'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search...','island'); ?>';}" value="<?php _e('Search...','island'); ?>"/>
		<input type="submit" value="Search" class="submit search-button" />
	</fieldset>
</form>