<?php
/**
 * This is the BODY header include template.
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://b2evolution.net/man/skin-development-primer}
 *
 * This is meant to be included in a page template.
 *
 * @package evoskins
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

// ---------------------------- SITE HEADER INCLUDED HERE ----------------------------
// If site headers are enabled, they will be included here:
siteskin_include( '_site_body_header.inc.php' );
// ------------------------------- END OF SITE HEADER --------------------------------

?>

<?php
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

<script>
	$(window).resize(function() {

		if ( $(window).width() < 768 ) {
			$( '.navbar.main-header-navigation .navbar-header' ).css( 'max-width', '100%' );
		} else {
			var nav_width = $( '.navbar.main-header-navigation .navbar-collapse .nav' ).width() + 30;

			if( $.browser.chrome  || $.browser.safari ) {
				$( '.navbar.main-header-navigation .navbar-header' ).css( 'max-width', '-webkit-calc(100% - ' + nav_width + 'px)' );
			} else {
				$( '.navbar.main-header-navigation .navbar-header' ).css( 'max-width', 'calc(100% - ' + nav_width + 'px)' );
			}

		// $( '.navbar.main-header-navigation .navbar-header' ).css( 'max-width', 'calc(100% - ' + nav_width + 'px)' );
	}

	});
	$(window).trigger('resize');
</script>