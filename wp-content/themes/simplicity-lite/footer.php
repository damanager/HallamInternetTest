<?php
/* 	Simplicity Theme's Footer
	Copyright: 2012-2019, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Simplicity 1.0
*/
?>

</div><!-- container -->

<div id="footer">

<div class="versep"></div>
<div id="footer-content">

<div id="social">
	<?php  
	$flink = simplicity_get_option('facebook-link', '#');
	if($flink) echo '<a href="'.esc_url($flink),'" class="social-link facebook-link" target="_blank"></a>'; 
	$twlink = simplicity_get_option('twitter-link', '#');
	if($twlink) echo '<a href="'.esc_url($twlink),'" class="social-link twitter-link" target="_blank"></a>'; 
	$ytlink = simplicity_get_option('youtube-link', '#');
	if($ytlink) echo '<a href="'.esc_url($ytlink),'" class="social-link youtube-link" target="_blank"></a>';
	$lilink = simplicity_get_option('li-link', '#');
	if($lilink) echo '<a href="'.esc_url($lilink),'" class="social-link li-link" target="_blank"></a>';
	$fdlink = simplicity_get_option('feed-link', '#');
	if($fdlink) echo '<a href="'.esc_url($fdlink),'" class="social-link feed-link" target="_blank"></a>';
	?>
</div>

<?php get_sidebar( 'footer' ); ?>

<div id="creditline"><?php echo '&copy; ' . date("Y"). ': ' . get_bloginfo( 'name' ) . '  '; simplicity_creditline(); ?></div>

</div> <!-- footer-content -->
</div> <!-- footer -->
<?php wp_footer(); ?>
</body>
</html>