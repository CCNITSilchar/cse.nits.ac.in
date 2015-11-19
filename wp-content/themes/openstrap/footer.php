<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package Openstrap
 * @subpackage Openstrap
 * @since Openstrap 0.1
 */
?>

</div> <!-- #main-row-->
</div> <!-- .container #main-container-->
</div> <!-- #wrap -->
<footer style="width:90%; margin-left:5%;">
		<?php
		/* A sidebar in the footer? Yep. You can customize
		 * your footer with three columns of widgets.
		 */
			get_sidebar( 'footer' );		
			$copyrighttxt = of_get_option('copyright_text');
			$copyrighttxt = ! empty($copyrighttxt) ? $copyrighttxt : __('&copy; ', 'openstrap') . __(date('Y')) . sprintf(' <a href="%1$s" title="%2$s" rel="home">%3$s</a>', esc_url(home_url( '/' )), get_bloginfo( 'name' ), get_bloginfo( 'name' ));
			$d=sprintf('<a href="%1$s" title="%2$s" rel="home">%3$s</a>', esc_url(home_url( '/' )), get_bloginfo( 'name' ), get_bloginfo( 'name' ));			
		?>
<div id="footer">
  <div class="container footer-nav ">

	<div class="pull-left">
	<?php
		wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'list-inline', 'depth' =>1, 'container' => false, 'fallback_cb' => false ) ); 
	?>
	</div>	

	<div class="pull-right hidden-xs">
	<p class="text-muted credit"><?php echo $copyrighttxt;?> <?php // echo openstrap_get_branding();?> </p>
	</div> 	
  </div>
</div>
</footer> 
</div> <!-- #bodychild -->
<?php wp_footer(); ?>
<?php /* DONT EVER REMOVE BELOW CODE WITHOUT ASKING HVL or YC */ ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61276971-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
