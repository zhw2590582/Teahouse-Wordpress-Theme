jQuery(document).ready(function($) {
	
	/*	判断密钥验证 */		
	$verify=$(".regular-text").val();
	if($verify==""){
		$(".verify_state").addClass("verify_no");
		$(".verify_state").removeClass("verify_yes");
		$(".verify_info").html("<b style='color:red;'>未验证</b>");
	}else{
		$(".verify_state").addClass("verify_yes");
		$(".verify_state").removeClass("verify_no");
		$(".verify_info").html("<b style='color:#05991D;'>验证成功</b>");
	}
	
	/*	判断后台demo用户，禁用相关条目 */	
	if ($('#adminmenu').children('li').length < 8) {
	$('#dashboard_activity , .user-pass1-wrap , .user-pass2-wrap , .show-admin-bar , .user-nickname-wrap').remove();		
	$("#save , .cs-restore , .button-primary , .verify_form .button").attr("disabled", "disabled");
	$('.cs-add').live('click', function(event) {
	  alert("此功能对demo用户不可用"); 
	  event.preventDefault();  
	});
	} else {} 	
	
	/*	判断文章形式 */
	$(':radio[name="post_format"]').change(function() {
		$('#standard_options').toggle(this.value == 0);
		$('#status_options').toggle(this.value == 'status');
		$('#aside_options').toggle(this.value == 'aside');
	});
	$(':radio[name="post_format"]:checked').change();
	
	/*	判断页面模板 */	
    $('#page_template').change( function() {

      $('#default_page').hide();
      $('#about_page').hide();
      $('#archive_page').hide();
      $('#background_page').hide();
      $('#friend_page').hide();
      $('#message_page').hide();
      $('#tag_page').hide();

      switch( $( this ).val() ) {

        case 'custom-about.php':
          $('#about_page').show();
        break;

        case 'custom-archive.php':
          $('#archive_page').show();
        break;

        case 'custom-background.php':
          $('#background_page').show();
        break;

        case 'custom-friend.php':
        $('#friend_page').show();
        break;		
		
        case 'custom-message.php':
          $('#message_page').show();
        break;	
		
        case 'custom-tag.php':
          $('#tag_page').show();
        break;			
		
        default:
          $('#default_page').show();
        break;
      }

    }).change();

});