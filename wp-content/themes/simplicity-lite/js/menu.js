jQuery(document).ready(function(){ 'use strict'; 
	jQuery("#main-menu-con ul ul").css({display: "none"}); jQuery('#main-menu-con ul li').hover( function() { jQuery(this).find('ul:first').slideDown(200).css('visibility', 'visible'); jQuery(this).addClass('selected'); }, function() { jQuery(this).find('ul:first').slideUp(200); jQuery(this).removeClass('selected'); });
	
	jQuery('#mobile-menu').click(function(){ jQuery('#main-menu-con').toggle(); jQuery(this).toggleClass('yesclick'); });								 
});

//jQuery(document).ready(function(){ jQuery('#f-post-page').click(function() { jQuery('#f-post-page-container').css("display", "block"); jQuery('#f-post-page').css("display", "none"); }); });