		</div><!-- main -->
	</div><!-- wrapper -->
	<div class="clearfix"></div>
	<?php if ( is_active_sidebar(2) ) { ?>
	<div id="my-widget">
		<div class="widgets">
	    	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Right-widget') ) : else : ?>	
	    	<?php endif; ?>
	    </div>
	</div>
	<?php } ?>
	<div class="copyright">&copy; <?php echo date("Y"); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a> | <?php bloginfo('description'); ?> | <a href="http://zhw-island.com/">Theme by <strong>Teahouse</strong></a></div>
	</div>
		
	<?php if ( is_active_sidebar(3) ) { ?>
	<div id="my-sidebar" class="sb-slidebar sb-left nano">
		<div class="widgets">
	    	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Left-widget') ) : else : ?>	
	    	<?php endif; ?>
	    </div>	
	</div>
	<?php } ?>
	
	<?php wp_footer(); ?>
	<script>
    NProgress.start();
    setTimeout(function() { NProgress.done(); jQuery('.fade').removeClass('out'); }, 1000);
	</script>
</body>
</html>