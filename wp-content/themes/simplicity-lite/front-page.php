<?php
/*
	Template Name: Front Page
	Simplicity Theme's Front Page to Display the Home Page if Selected
	Copyright: 2012-2019, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Simplicity 1.0
*/
get_header(); ?>
<div id="header-bottom"> </div>
<div id="container">
	<h1 id="heading"><?php echo esc_textarea(simplicity_get_option('heading_text', 'Welcome to the World of Creativity!')); ?></h1>
	<p class="heading-desc"><?php echo esc_textarea(simplicity_get_option('heading_des', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel enim porta, porttitor dolor ut, tristique libero. Integer cursus lectus eros')); ?></p>

<div id="rslide-container" class="slideback resslide box100">
	<div id="slidebox" class="slidesize box90">
		<ul id="rslide" class="rslides">
			<?php
			foreach (range(1,3) as $sinumber)
			  {
				  $sldimg = ''; $sldimg = simplicity_get_option('slide-image' . $sinumber, get_template_directory_uri() . '/images/slides/' . $sinumber . '.jpg');
				  $sldttl = ''; $sldttl = simplicity_get_option('slide-image' . $sinumber . '-title', 'This is a Test Image Title' );
				  $sldcap = ''; $sldcap = simplicity_get_option('slide-image' . $sinumber . '-caption', 'This is a Test Image for Simplicity Theme. If you feel any problem please contact with D5 Creation.');

				if ( $sldimg ) : ?>
					<li>
						<img src="<?php echo esc_url($sldimg); ?>" alt="<?php echo esc_textarea($sldttl); ?>" />
						<?php if( $sldttl || $sldcap ): ?>
           					<div class="ft-title sb-description">
           						<?php if($sldttl) echo '<h3>'.esc_textarea($sldttl).'</h3>'; ?>	
           							<?php if($sldcap) echo esc_textarea($sldcap); ?>	
							</div>
           				<?php endif; ?>
					</li>
			<?php  endif;  } ?>
		</ul>
	</div>
</div> <!-- slide-container -->

<?php get_template_part( 'featured-box' ); ?> 

<?php if (simplicity_get_option('fpostex', '0') != '1'): get_template_part( 'fcontent' ); endif;?>

<div class="content-ver-sep"></div>
<?php 
$btmquote = simplicity_get_option('bottom-quotation1', 'All the developers of D5 Creation have come from the disadvantaged part or group of the society. All have established themselves after a long and hard struggle in their life ----- D5 Creation Team');
if($btmquote) echo '<div class="customers-comment"><blockquote>'.esc_textarea($btmquote).'</blockquote></div>'; ?>
<?php get_footer(); ?>