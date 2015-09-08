// 图像懒加载
echo.init({
	offset: 100,
	throttle: 250,
	unload: false,
});

// 作品模板
(function(){
minigrid('.grid', '.grid-item');

window.addEventListener('resize', function(){
  minigrid('.grid', '.grid-item');
});
})();

// Banner + 读者墙提示文本
MouseTooltip.init();

// 播放器	
jQuery(window).load(function($) {
	jQuery('<div class="mejs-button mejs-toggle-player-button mejs-toggle-player"><button type="button" aria-controls="" title=""></button></div>').appendTo(jQuery(".cue-playlist-container .mejs-controls"));

	jQuery(".mejs-toggle-playlist-button").click(function() {
		jQuery(".cue-playlist").toggleClass("open");
	});

	jQuery(".mejs-toggle-player-button").click(function() {
		jQuery(".cue-playlist").toggleClass("is-closed");
		jQuery(".cue-playlist-container").toggleClass("playlist-closed");
	});

});

//滚动公告栏	
function AutoScroll(obj){ 
	jQuery(obj).find("ul:first").animate({ 
		marginTop:"-25px" 
	},500,function(){ 
		jQuery(this).css({marginTop:"0px"}).find("li:first").appendTo(this); 
		}); 
} 
jQuery(document).ready(function(){ 
	setInterval('AutoScroll("#bulletin")',4000);
	jQuery(".bulletin_remove").click(function() {
		event.preventDefault();
		jQuery("#bulletin_box").addClass("hide");
	});	
});

jQuery(document).ready(function($) {
	
// 评论分页
$body=(window.opera)?(document.compatMode=="CSS1Compat"?$('html'):$('body')):$('html,body');
// 点击分页导航链接时触发分页
$('body').on('click', '#comment-nav-below a', function(e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: $(this).attr('href'),
        beforeSend: function(){
            $('#comment-nav-below').remove();
            $('.commentlist').remove();
            $('#loading-comments').slideDown();
            $body.animate({scrollTop: $('#comments-title').offset().top - 65}, 800 );
        },
        dataType: "html",
        success: function(out){
            result = $(out).find('.commentlist');
            nextlink = $(out).find('#comment-nav-below');
            $('#loading-comments').slideUp('fast');
            $('#loading-comments').after(result.fadeIn(500));
            $('.commentlist').after(nextlink);
        }
    });
});	
	
// 评论拖动验证
//http://codepen.io/souporserious/pen/XJQLEb
	if($(".pullee").length>0){	
		$(".form-submit #submit").attr("disabled", true);				
		$(".form-submit #submit").addClass("disabled");				

		var inputRange = document.getElementsByClassName('pullee')[0],
			maxValue = 250,
			speed = 12,
			currValue, rafID;
		inputRange.min = 0;
		inputRange.max = maxValue;

		function unlockStartHandler() {
			window.cancelAnimationFrame(rafID);
			currValue = +this.value
		}
		function unlockEndHandler() {
			currValue = +this.value;
			if (currValue >= maxValue) {
				successHandler()
			} else {
				rafID = window.requestAnimationFrame(animateHandler)
			}
		}
		function animateHandler() {
			inputRange.value = currValue;
			if (currValue > -1) {
				window.requestAnimationFrame(animateHandler)
			}
			currValue = currValue - speed
		}
		function successHandler() {
			$(".unlock .fa").removeClass("fa-lock");
			$(".unlock .fa").addClass("fa-check");
			inputRange.value = 250;
			$(".pullee").attr("disabled", "disabled");		
			$(".form-submit #submit").attr("disabled", false);
			$(".form-submit #submit").removeClass("disabled");			
			
		};
		inputRange.addEventListener('mousedown', unlockStartHandler, false);
		inputRange.addEventListener('mousestart', unlockStartHandler, false);
		inputRange.addEventListener('mouseup', unlockEndHandler, false);
		inputRange.addEventListener('touchend', unlockEndHandler, false);
	} else {}		


//访客计数器	
	$(function () {
		$("#customers_num").text(zero($("#customers_num").text()));
	});
	function zero(sell) {
		if (sell.length < 6) {
			var nsell = "";
			for (var i = 0; i < 6 - sell.length; i++) {
				nsell += "0";
			}
			return nsell + sell;
		} else {
			return sell;
		}
	}
	
//固定小工具
		
	var rh = $('.rightbar').height();
	var bh = $('#main').height();	
	$("#wrapper").css("min-height", rh + 100 );

	
	
	if($(".rightbar").length>0 && bh > rh ){
		var documentHeight = 0;
		var topPadding = 15;		
		$(function() {
			var offset = $(".rightbar aside:last").offset();
			documentHeight = $(document).height();
			$(window).scroll(function() {
				var sideBarHeight = $(".rightbar aside:last").height();
				if ($(window).scrollTop() > offset.top) {
					var newPosition = ($(window).scrollTop() - offset.top) + topPadding;
					var maxPosition = documentHeight - (sideBarHeight + 368);
					if (newPosition > maxPosition) {
						newPosition = maxPosition;
					}
					$(".rightbar aside:last").addClass("lfixed");
				} else {
					$(".rightbar aside:last").removeClass("lfixed");
				};
			});
		});		
	} else {}	

//子菜单	
	$(".header-menu-list .dropdown-wrapper").each(function(i) {
		var Menu = $(this).parent().parent().find("a");
		var SubMenu = $(this).children();
		var DropdownLeft = Menu.offset().left - SubMenu.width()/2 + Menu.width()/2;
		$(this).css("padding-left", function(n, v) {
			return DropdownLeft;
		});
	});

//图像CSS类	
	$("#content img, .avatar img").addClass('ajax_gif');
	$("#content img").parent().addClass('content-img');
	$("#content img, .avatar img").load(function() {
		$(this).removeClass('ajax_gif');
	});

//Tooltip
	$(".tagcloud a").each(function(i) {
		var formattedDate = $(this).attr('title');
		$(this).attr("data-tooltip", function(n, v) {
			return formattedDate;
		});
		$(this).removeAttr("title").addClass("simptip-position-bottom simptip-smooth simptip-movable");
	});

//推荐文章
	$('#sticky').lightSlider({
		item: 4,
		slideMove: 2,
		auto: false,
		loop: true,
		controls: false,
		pager: false,
		easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
		speed: 600,
		pause: 4000,
		responsive: [{
			breakpoint: 800,
			settings: {
				item: 3,
				slideMove: 1,
				slideMargin: 6,
			}
		}, {
			breakpoint: 480,
			settings: {
				item: 2,
				slideMove: 1
			}
		}]
	});

//底部按钮
	$(window).scroll(function() {
		if ($(window).scrollTop() > 200) {
			$(".foot_btn").fadeIn(500);
		} else {
			$(".foot_btn").fadeOut(500);
		}
	});

	$(".scrolltotop").click(function() {
		$('body,html').animate({
			scrollTop: 0
		}, 1000);
		return false;
	});

	$(".comment_btn").click(function() {
		$("html,body").animate({
			scrollTop: $("#comment-jump").offset().top - 60
		}, 1000);
		return false;
	});

	$("#r-wx").mouseenter(function() {
		$("#fi-wx-show").css({
			display: "block"
		});
	});

	$("#r-wx").mouseleave(function() {
		$("#fi-wx-show").css({
			display: "none"
		});
	});
	
	$(".baidu_share").mouseenter(function() {
		$(".share_show").css({
			display: "block"
		});
	});

	$(".baidu_share").mouseleave(function() {
		$(".share_show").css({
			display: "none"
		});
	});	

//滚动事件
	var prevTop = 0,
		currTop = 0;
	$(window).scroll(function() {
		currTop = $(window).scrollTop();
		if (currTop < prevTop) { //判断小于则为向上滚动
		} else {
			$(".login_bg").hide();
		}
		//prevTop = currTop; //IE下有BUG，所以用以下方式
		setTimeout(function() {
			prevTop = currTop
		}, 0);
	});

//登录面板	

	$(".login-toggle").toggle(function() {
		$(".login_bg").slideToggle(300);
		return false;
	}, function() {
		$(".login_bg").slideToggle(300);
		return false;
	});

//自适应菜单
	$("#menu-toggle").click(function() {
		$(".mobile-nav , #menu-toggle").toggleClass("open-nav");
	});
	
});
