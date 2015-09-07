<?php
define('YOUR_SPECIAL_SECRET_KEY', '557a581dd0d1f9.69125523'); 
define('YOUR_LICENSE_SERVER_URL', 'http://lazyhood.com'); 
define('YOUR_ITEM_REFERENCE', 'lazycat'); 
add_action('admin_menu', 'slm_Island_license_menu');
function slm_Island_license_menu() {
    add_options_page('LazyCat密钥验证', 'LazyCat密钥验证', 'manage_options', __FILE__, 'Island_license_management_page');
}
function Island_license_management_page() {
    echo '<div class="wrap">';
    echo '<h2>Island密钥验证</h2>';
    if (isset($_REQUEST['activate_license'])) {
        $license_key = $_REQUEST['Island_license_key'];
        $api_params = array(
            'slm_action' => 'slm_activate',
            'secret_key' => YOUR_SPECIAL_SECRET_KEY,
            'license_key' => $license_key,
            'registered_domain' => $_SERVER['SERVER_NAME'],
            'item_reference' => urlencode(YOUR_ITEM_REFERENCE),
        );
        $response = wp_remote_get(add_query_arg($api_params, YOUR_LICENSE_SERVER_URL), array('timeout' => 20, 'sslverify' => false));
        if (is_wp_error($response)){
            echo "Unexpected Error! The query returned with an error.";
        }        
        $license_data = json_decode(wp_remote_retrieve_body($response));        
        if($license_data->result == 'success'){//Success was returned for the license activation
            echo '<div class="verify_serve">服务器返回信息: '.$license_data->message. '</div>';
            update_option('Island_license_key', $license_key); 
			wp_redirect( admin_url( 'admin.php?page=cs-framework' ) );
        }
        else{
            echo '<div class="verify_serve">服务器返回信息: '.$license_data->message. '</div>';
        }
    }
    if (isset($_REQUEST['deactivate_license'])) {
        $license_key = $_REQUEST['Island_license_key'];
        $api_params = array(
            'slm_action' => 'slm_deactivate',
            'secret_key' => YOUR_SPECIAL_SECRET_KEY,
            'license_key' => $license_key,
            'registered_domain' => $_SERVER['SERVER_NAME'],
            'item_reference' => urlencode(YOUR_ITEM_REFERENCE),
        );
        $response = wp_remote_get(add_query_arg($api_params, YOUR_LICENSE_SERVER_URL), array('timeout' => 20, 'sslverify' => false));
        if (is_wp_error($response)){
            echo "Unexpected Error! The query returned with an error.";
        }
        $license_data = json_decode(wp_remote_retrieve_body($response));
        if($license_data->result == 'success'){
            echo '<div class="verify_serve">服务器返回信息: '.$license_data->message. '</div>';
            update_option('Island_license_key', '');
        }
        else{
            echo '<div class="verify_serve">服务器返回信息: '.$license_data->message. '</div>';
        }
        
    }
    ?>
	<div class="verify_bg">
		<div class="verify_state"></div>
		<a class="verify_help" href="http://lazyhood.com/" target="_blank" title="了解更多"></a>
		<div class="verify_info"></div>
		<form action="" method="post" class="verify_form">
			<input class="regular-text" type="text" id="Island_license_key" name="Island_license_key"  placeholder="输入密钥信息" value="<?php echo get_option('Island_license_key'); ?>" >
			<ul class="verify_list">
				<li>开启高级选项+自动更新</li>
				<li>多套个性皮肤+功能补给</li>
				<li>获取永久技术支持</li>
			</ul>
			<p class="submit">
				<input type="submit" name="activate_license" value="验  证" class="button-primary" />
				<input type="submit" name="deactivate_license" value="停用" class="button" />
			</p>
		</form>
	</div>
    <?php
    echo '</div>';
}
