<?php
/**
 * This is the template that displays the help screen for a collection
 *
 * This file is not meant to be called directly.
 * It is meant to be called by an include in the main.page.php template.
 * To display the archive directory, you should call a stub AND pass the right parameters
 * For example: /blogs/index.php?disp=help
 *
 * b2evolution - {@link http://b2evolution.net/}
 * Released under GNU GPL License - {@link http://b2evolution.net/about/gnu-gpl-license}
 * @copyright (c)2003-2016 by Francois Planque - {@link http://fplanque.com/}
 *
 * @package evoskins
 * @subpackage bootstrap_main_skin
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );


global $app_version, $disp, $Collection, $Blog;

if( evo_version_compare( $app_version, '6.4' ) < 0 )
{ // Older skins (versions 2.x and above) should work on newer b2evo versions, but newer skins may not work on older b2evo versions.
	die( 'This skin is designed for b2evolution 6.4 and above. Please <a href="http://b2evolution.net/downloads/index.html">upgrade your b2evolution</a>.' );
}

// This is the main template; it may be used to display very different things.
// Do inits depending on current $disp:
skin_init( $disp );


// -------------------------- HTML HEADER INCLUDED HERE --------------------------
skin_include( '_html_header.inc.php' );
// -------------------------------- END OF HEADER --------------------------------


// ---------------------------- SITE HEADER INCLUDED HERE ----------------------------
// If site headers are enabled, they will be included here:
siteskin_include( '_site_body_header.inc.php' );
// ------------------------------- END OF SITE HEADER --------------------------------
?>


<?php
if( $Skin->show_container_when_access_denied( 'menu' ) )
{ // Display 'Menu' widget container

$affix_positioning_fix = $Settings->get( 'site_skins_enabled' ) ? ' data-offset-top="43.2"' : 'data-offset-top="1"';
$transparent_Class = '';
if( $Skin->get_setting( 'nav_bg_transparent' ) ) { $transparent_Class = ' is_transparent'; }
?>
<nav class="navbar navbar-default main-header-navigation<?php echo $transparent_Class; ?>" data-spy="affix"<?php echo $affix_positioning_fix; ?>>
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<?php
		skin_widget( array(
			// CODE for the widget:
			'widget'              => 'coll_title',
			// Optional display params
			'block_start'         => '<div class="navbar-brand">',
			'block_end'           => '</div>',
			'item_class'           => 'navbar-brand',
		) );
		// ------------------------- "Menu" Collection logo --------------------------
		?>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav navbar-right">
		<?php
			// ------------------------- "Menu" CONTAINER EMBEDDED HERE --------------------------
			// Display container and contents:
			// Note: this container is designed to be a single <ul> list
			skin_container( NT_('Menu'), array(
					// The following params will be used as defaults for widgets included in this container:
					'block_start'         => '',
					'block_end'           => '',
					'block_display_title' => false,
					'list_start'          => '',
					'list_end'            => '',
					'item_start'          => '<li class="evo_widget $wi_class$">',
					'item_end'            => '</li>',
					'item_selected_start' => '<li class="active evo_widget $wi_class$">',
					'item_selected_end'   => '</li>',
					'item_title_before'   => '',
					'item_title_after'    => '',
				) );
			// ----------------------------- END OF "Menu" CONTAINER -----------------------------
		?>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>
<?php } ?>

<div class="evo_container__standalone_page_area_oth">

<div class="container">

<header class="row">

	<div class="coll-xs-12 coll-sm-12 col-md-4 col-md-push-8">
		<?php
		if( $Skin->show_container_when_access_denied( 'page_top' ) )
		{ // Display 'Page Top' widget container
		?>
		<div class="evo_container evo_container__page_top">
		<?php
			// ------------------------- "Page Top" CONTAINER EMBEDDED HERE --------------------------
			// Display container and contents:
			skin_container( NT_('Page Top'), array(
					// The following params will be used as defaults for widgets included in this container:
					'block_start'         => '<div class="evo_widget $wi_class$">',
					'block_end'           => '</div>',
					'block_display_title' => false,
					'list_start'          => '<ul>',
					'list_end'            => '</ul>',
					'item_start'          => '<li>',
					'item_end'            => '</li>',
					// Widget 'Search form':
					'search_input_before'  => '<div class="input-group">',
					'search_input_after'   => '',
					'search_submit_before' => '<span class="input-group-btn">',
					'search_submit_after'  => '</span></div>',    
				) );
			// ----------------------------- END OF "Page Top" CONTAINER -----------------------------
		?>
		</div>
		<?php } ?>
	</div><!-- .col -->
	
	<div class="col-md-12">
		<?php
			// ------------------------ TITLE FOR THE CURRENT REQUEST ------------------------
			// request_title( array(
					// 'title_before'      => '<h1 class="page_title">',
					// 'title_after'       => '</h1>',
					// 'title_none'        => '',
					// 'glue'              => ' - ',
				// ) );
				
				echo '<h1 class="page_title">'.T_('Content issues').'</h1>'; // Hardcoded, since dynamic content is not properly installed for disp=help
			// ----------------------------- END OF REQUEST TITLE ----------------------------
		?>
	</div>

</header><!-- .row -->

</div><!-- .container -->

</div><!-- .evo_container__standalone_page_area_7 -->

<div class="container main_page_wrapper">

<div class="row">
	<div class="col-md-12">
		<main><!-- This is were a link like "Jump to main content" would land -->

		<!-- ================================= START OF MAIN AREA ================================== -->

		<?php
			// ------------------------- MESSAGES GENERATED FROM ACTIONS -------------------------
			messages( array(
					'block_start' => '<div class="action_messages">',
					'block_end'   => '</div>',
				) );
			// --------------------------------- END OF MESSAGES ---------------------------------
		?>

		<?php
			// -------------- MAIN CONTENT TEMPLATE INCLUDED HERE (Based on $disp) --------------
			skin_include( '$disp$' );
			// Note: you can customize any of the sub templates included here by
			// copying the matching php file into your skin directory.
			// ------------------------- END OF MAIN CONTENT TEMPLATE ---------------------------
		?>

		</main>

	</div><!-- .col -->

</div><!-- .row -->

</div><!-- .container -->

<!-- =================================== START OF FOOTER =================================== -->
<footer class="container-fluid footer_wrapper">
			
	<?php
	if( $Skin->show_container_when_access_denied( 'footer' ) )
	{ // Display 'Footer' widget container
	?>
	<div class="container evo_container evo_container__footer">
		<?php
		// ------------------------- "Footer" CONTAINER EMBEDDED HERE --------------------------
		// Display container and contents:
		skin_container( NT_('Footer'), array(
				// The following params will be used as defaults for widgets included in this container:
				'block_start'         => '<div class="evo_widget $wi_class$">',
				'block_end'           => '</div>',
				// Widget 'Search form':
				'search_input_before'  => '<div class="input-group">',
				'search_input_after'   => '',
				'search_submit_before' => '<span class="input-group-btn">',
				'search_submit_after'  => '</span></div>',    
			) );
		// ----------------------------- END OF "Footer" CONTAINER -----------------------------
		?>
	</div>
	<?php } ?>
	
	<p class="baseline">
		<?php
		// Display footer text (text can be edited in Blog Settings):
		$Blog->footer_text( array(
				'before' => '',
				'after'  => ' &bull; ',
			) );
		// TODO: dh> provide a default class for pTyp, too. Should be a name and not the ityp_ID though..?!
		
		// Display a link to contact the owner of this blog (if owner accepts messages):
		$Blog->contact_link( array(
				'before' => '',
				'after'  => ' &bull; ',
				'text'   => T_('Contact'),
				'title'  => T_('Send a message to the owner of this blog...'),
			) );
			
		// Display a link to help page:
		$Blog->help_link( array(
				'before' => ' ',
				'after'  => ' ',
				'text'   => T_('Help'),
			) );
			
		// Display additional credits:
		// If you can add your own credits without removing the defaults, you'll be very cool :))
		// Please leave this at the bottom of the page to make sure your blog gets listed on b2evolution.net
		credits( array(
				'list_start' => '&bull;',
				'list_end'   => ' ',
				'separator'  => '&bull;',
				'item_start' => ' ',
				'item_end'   => ' ',
			) );
		?>
	</p>

	<?php
		// Please help us promote b2evolution and leave this logo on your blog:
		powered_by( array(
				'block_start' => '<div class="powered_by">',
				'block_end'   => '</div>',
				// Check /rsc/img/ for other possible images -- Don't forget to change or remove width & height too
				'img_url'     => '$rsc$img/powered-by-b2evolution-120t.gif',
				'img_width'   => 120,
				'img_height'  => 32,
			) );
	?>

</footer><!-- .footer_wrapper -->

<?php
// ---------------------------- SITE FOOTER INCLUDED HERE ----------------------------
// If site footers are enabled, they will be included here:
siteskin_include( '_site_body_footer.inc.php' );
// ------------------------------- END OF SITE FOOTER --------------------------------


// ------------------------- HTML FOOTER INCLUDED HERE --------------------------
skin_include( '_html_footer.inc.php' );
// ------------------------------- END OF FOOTER --------------------------------
?>