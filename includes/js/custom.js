jQuery(document).ready(function($) {

    //Weibo iframe
    if ($("#my-sidebar .share_self").length > 0) {

	} else {
			$(".sb-slidebar").css("padding", "10px 20px 0");
			$('#my-sidebar').perfectScrollbar({
				suppressScrollX: true
			});
			$(".ps-scrollbar-y-rail").css("left", "3px");
	}

    //My-nav tooltip
    $(".my-nav a").each(function(i) {
        var formattedDate = $(this).attr('title');
        $(this).attr("data-tooltip",
        function(n, v) {
            return formattedDate;
        });
    });
    $('.my-nav a').removeAttr("title");
    $('.my-nav a').addClass("simptip-position-right simptip-movable");

    //scrollUp
    $(function() {
        $.scrollUp({
            scrollName: 'scrollUp',
            // Element ID
            scrollDistance: 300,
            // Distance from top/bottom before showing element (px)
            scrollFrom: 'top',
            // 'top' or 'bottom'
            scrollSpeed: 300,
            // Speed back to top (ms)
            easingType: 'linear',
            // Scroll to top easing (see http://easings.net/)
            animation: 'fade',
            // Fade, slide, none
            animationInSpeed: 200,
            // Animation in speed (ms)
            animationOutSpeed: 200,
            // Animation out speed (ms)
            scrollText: '<i class="icon-chevron-up animated fadeInUp sb-slide"></i>',
            // Text for element, can contain HTML
            scrollTitle: true,
            // Set a custom <a> title if required. Defaults to scrollText
            scrollImg: false,
            // Set true to use image
            activeOverlay: false,
            // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });

    //slidebars
    (function($) {
        $(document).ready(function() {
            $.slidebars();
        });
    })(jQuery);

    //responsiveSlides
    $(".rslides").responsiveSlides({
        pager: false,
        nav: true,
        speed: 500
    });

    //Hidden Toggle
    $("#drawer-inside").hide();
    $("#drawer-toggle,#drawer-toggle2").toggle(function() {
        $("#drawer-inside").slideToggle(300);
        $(".icon-cog").attr('class', 'icon-remove-sign');
        return false;

    },
    function() {
        $("#drawer-inside").slideToggle(300);
        $(".icon-remove-sign").attr('class', 'icon-cog');
        return false;
    });

    //Responsive Menu
    $(".nav").mobileMenu();

    $("select.select-menu").each(function() {
        var title = $(this).attr('title');
        if ($("option:selected", this).val() != '') title = $("option:selected", this).text();
        $(this).css({
            'z-index': 10,
            'opacity': 0,
            '-khtml-appearance': 'none'
        }).after('<span class="select">' + title + '</span>').change(function() {
            val = $("option:selected", this).text();
            $(this).next().text(val);
        })
    });

    //Custom BG
    if ($("body").hasClass("custom-background")) {
        $("body").removeClass("fixed-bg");
    }

    //Tags font-size reset
    $(".tagcloud a").css("font-size", "11pt");

    //存档页面
    jQuery(document).ready(function($) {
        //===================================存档页面 jQ伸缩
        (function() {
            $('#al_expand_collapse,#archives span.al_mon').css({
                cursor: "s-resize"
            });
            $('#archives span.al_mon').each(function() {
                var num = $(this).next().children('li').size();
                var text = $(this).text();
                $(this).html(text + '<em> ( ' + num + ' 篇文章 )</em>');
            });
            var $al_post_list = $('#archives ul.al_post_list'),
            $al_post_list_f = $('#archives ul.al_post_list:first');
            $al_post_list.hide(1,
            function() {
                $al_post_list_f.show();
            });
            $('#archives span.al_mon').click(function() {
                $(this).next().slideToggle(400);
                return false;
            });
            $('#al_expand_collapse').toggle(function() {
                $al_post_list.show();
            },
            function() {
                $al_post_list.hide();
            });
        })();
    });

});