<?php
/**
 * This file implements a class derived of the generic Skin class in order to provide custom code for
 * the skin in this folder.
 *
 * This file is part of the b2evolution project - {@link http://b2evolution.net/}
 *
 * @package skins
 * @subpackage bootstrap_main
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

/**
 * Specific code for this skin.
 *
 * ATTENTION: if you make a new skin you have to change the class name below accordingly
 */
class jared_Skin extends Skin
{
	/**
	 * Skin version
	 * @var string
	 */
	var $version = '1.0.0';

	/**
	 * Do we want to use style.min.css instead of style.css ?
	 */
	var $use_min_css = true;  // true|false|'check' Set this to true for better optimization

	/**
	 * Get default name for the skin.
	 * Note: the admin can customize it.
	 */
	function get_default_name()
	{
		return 'Jared Skin';
	}


	/**
	 * Get default type for the skin.
	 */
	function get_default_type()
	{
		return 'rwd';
	}


	/**
	 * What evoSkins API does has this skin been designed with?
	 *
	 * This determines where we get the fallback templates from (skins_fallback_v*)
	 * (allows to use new markup in new b2evolution versions)
	 */
	function get_api_version()
	{
		return 6;
	}


	/**
	 * Get supported collection kinds.
	 *
	 * This should be overloaded in skins.
	 *
	 * For each kind the answer could be:
	 * - 'yes' : this skin does support that collection kind (the result will be was is expected)
	 * - 'partial' : this skin is not a primary choice for this collection kind (but still produces an output that makes sense)
	 * - 'maybe' : this skin has not been tested with this collection kind
	 * - 'no' : this skin does not support that collection kind (the result would not be what is expected)
	 * There may be more possible answers in the future...
	 */
	public function get_supported_coll_kinds()
	{
		$supported_kinds = array(
				'main' => 'yes',
				'std' => 'yes',		// Blog
				'photo' => 'no',
				'forum' => 'no',
				'manual' => 'no',
				'group' => 'no',  // Tracker
				// Any kind that is not listed should be considered as "maybe" supported
			);

		return $supported_kinds;
	}


	/*
	 * What CSS framework does has this skin been designed with?
	 *
	 * This may impact default markup returned by Skin::get_template() for example
	 */
	function get_css_framework()
	{
		return 'bootstrap';
	}


	/**
	 * Get definitions for editable params
	 *
	 * @see Plugin::GetDefaultSettings()
	 * @param local params like 'for_editing' => true
	 */
	function get_param_definitions( $params )
	{
		$r = array_merge( array(
				'layout_section_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Layout Settings')
				),
					'max_image_height' => array(
						'label' => T_('Max image height'),
						'note' => 'px. ' . T_('Set maximum height for post images.'),
						'defaultvalue' => '',
						'type' => 'integer',
						'size' => '7',
						'allow_empty' => true,
					),
				'layout_section_end' => array(
					'layout' => 'end_fieldset',
				),
				
				
				// ============ Navigation Section ============
				'navigation_section_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Navigation Settings')
				),
					'nav_bg_transparent' => array(
						'label' => T_('Transparent background'),
						'note' => T_('Check this to enable transparent background until navigation breaks into hamburger layout.'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'nav_bg_color' => array(
						'label' => T_('Background color'),
						'note' => T_('This color will be used if Background image is not set or does not exist.'),
						'defaultvalue' => '#333333',
						'type' => 'color',
					),
					'nav_links_color' => array(
						'label' => T_('Links color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'nav_button_color' => array(
						'label' => T_('Button text color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
				'navigation_section_end' => array(
					'layout' => 'end_fieldset',
				),
				
				
				// ============ Page Top Section ============
				'pagetop_section_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Page Top Settings')
				),
					'pagetop_button_bg_color' => array(
						'label' => T_('Button background color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'pagetop_button_color' => array(
						'label' => T_('Button text color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
				'pagetop_section_end' => array(
					'layout' => 'end_fieldset',
				),

				
				// ============ Section 1 - Front Page Main Area ============
				'section_1_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Section 1 - Front Page Main Area')
				),
					'section_1_display' => array(
						'label' => T_('Display this section'),
						'note' => T_('Check this to enable Front Page Main Area.'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'section_1_image_file_ID' => array(
						'label' => T_('Background image'),
						'type' => 'fileselect',
						'initialize_with' => 'shared/global/monument-valley/monuments.jpg',
						'thumbnail_size' => 'fit-320x320'
					),
					'section_1_bg_color' => array(
						'label' => T_('Background color'),
						'note' => T_('This color will be used if Background image is not set or does not exist.'),
						'defaultvalue' => '#333333',
						'type' => 'color',
					),
					'section_1_coll_title_color' => array(
						'label' => T_('Collection title color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'section_1_title_color' => array(
						'label' => T_('Content title color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'section_1_text_color' => array(
						'label' => T_('Text color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'section_1_link_color' => array(
						'label' => T_('Links color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'section_1_muted_color' => array(
						'label' => T_('Muted text color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#F0F0F0',
						'type' => 'color',
					),
					'section_1_icon_color' => array(
						'label' => T_('Inverse icon color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#CCCCCC',
						'type' => 'color',
					),
					'section_1_button_bg_color' => array(
						'label' => T_('Button background color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'section_1_button_color' => array(
						'label' => T_('Button text color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'section_1_text_align' => array(
						'label'    => T_('Align text'),
						'note'     => '',
						'type'     => 'radio',
						'options'  => array(
							array( 'section_1_left', T_('Left') ),
							array( 'section_1_center', T_('Center') ),
							array( 'section_1_right', T_('Right') ),
						),
						'defaultvalue' => 'section_1_center',
					),
				'section_1_end' => array(
					'layout' => 'end_fieldset',
				),
				

				// ============ Section 2 - Front Page Secondary Area ============
				'section_2_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Section 2 - Front Page Secondary Area')
				),
					'section_2_display' => array(
						'label' => T_('Display this section'),
						'note' => T_('Check this to enable Front Page Secondary Area.'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'section_2_image_file_ID' => array(
						'label' => T_('Background image'),
						'type' => 'fileselect',
						'defaultvalue' => NULL,
						'initialize_with' => 'shared/global/sunset/sunset.jpg',
						'thumbnail_size' => 'fit-320x320'
					),
					'section_2_bg_color' => array(
						'label' => T_('Background color'),
						'note' => T_('This color will be used if Background image is not set or does not exist.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'section_2_title_color' => array(
						'label' => T_('Title color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#222222',
						'type' => 'color',
					),
					'section_2_text_color' => array(
						'label' => T_('Content color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#adadad',
						'type' => 'color',
					),
					'section_2_link_color' => array(
						'label' => T_('Links color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'section_2_link_h_color' => array(
						'label' => T_('Links hover color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'section_2_button_bg_color' => array(
						'label' => T_('Button background color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'section_2_button_color' => array(
						'label' => T_('Button text color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'section_2_text_align' => array(
						'label'    => T_('Align text'),
						'note'     => '',
						'type'     => 'radio',
						'options'  => array(
							array( 'section_2_left', T_('Left') ),
							array( 'section_2_center', T_('Center') ),
							array( 'section_2_right', T_('Right') ),
						),
						'defaultvalue' => 'section_2_center',
					),
				'section_2_end' => array(
					'layout' => 'end_fieldset',
				),
				
				
				// ============ Section 3 - Front Page Area 3 ============
				'section_3_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Section 3 - Front Page Area 3')
				),
					'section_3_display' => array(
						'label' => T_('Display this section'),
						'note' => T_('Check this to enable Front Page Area 3.'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'section_3_image_file_ID' => array(
						'label' => T_('Background image'),
						'type' => 'fileselect',
						'initialize_with' => 'shared/global/monument-valley/monument-valley-road.jpg',
						'thumbnail_size' => 'fit-320x320'
					),
					'section_3_bg_color' => array(
						'label' => T_('Background color'),
						'note' => T_('This color will be used if Background image is not set or does not exist.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'section_3_title_color' => array(
						'label' => T_('Title color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#222222',
						'type' => 'color',
					),
					'section_3_text_color' => array(
						'label' => T_('Content color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#adadad',
						'type' => 'color',
					),
					'section_3_link_color' => array(
						'label' => T_('Links color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'section_3_link_h_color' => array(
						'label' => T_('Links hover color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'section_3_button_bg_color' => array(
						'label' => T_('Button background color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'section_3_button_color' => array(
						'label' => T_('Button text color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'section_3_text_align' => array(
						'label'    => T_('Align text'),
						'note'     => '',
						'type'     => 'radio',
						'options'  => array(
							array( 'section_3_left', T_('Left') ),
							array( 'section_3_center', T_('Center') ),
							array( 'section_3_right', T_('Right') ),
						),
						'defaultvalue' => 'section_3_center',
					),
				'section_3_end' => array(
					'layout' => 'end_fieldset',
				),
				
				
				// ============ Section 4 - Front Page Area 4 ============
				'section_4_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Section 4 - Front Page Area 4')
				),
					'section_4_display' => array(
						'label' => T_('Display this section'),
						'note' => T_('Check this to enable Front Page Area 4.'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'section_4_image_file_ID' => array(
						'label' => T_('Background image'),
						'type' => 'fileselect',
						'defaultvalue' => NULL,
						'initialize_with' => 'shared/global/sunset/sunset.jpg',
						'thumbnail_size' => 'fit-320x320'
					),
					'section_4_bg_color' => array(
						'label' => T_('Background color'),
						'note' => T_('This color will be used if Background image is not set or does not exist.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'section_4_title_color' => array(
						'label' => T_('Title color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#222222',
						'type' => 'color',
					),
					'section_4_text_color' => array(
						'label' => T_('Content color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#adadad',
						'type' => 'color',
					),
					'section_4_link_color' => array(
						'label' => T_('Links color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'section_4_link_h_color' => array(
						'label' => T_('Links hover color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'section_4_button_bg_color' => array(
						'label' => T_('Button background color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'section_4_button_color' => array(
						'label' => T_('Button text color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'section_4_text_align' => array(
						'label'    => T_('Align text'),
						'note'     => '',
						'type'     => 'radio',
						'options'  => array(
							array( 'section_4_left', T_('Left') ),
							array( 'section_4_center', T_('Center') ),
							array( 'section_4_right', T_('Right') ),
						),
						'defaultvalue' => 'section_4_center',
					),
				'section_4_end' => array(
					'layout' => 'end_fieldset',
				),
				
				
				// ============ Section 5 - Front Page Area 5 ============
				'section_5_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Section 5 - Front Page Area 5')
				),
					'section_5_display' => array(
						'label' => T_('Display this section'),
						'note' => T_('Check this to enable Front Page Area 5.'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'section_5_image_file_ID' => array(
						'label' => T_('Background image'),
						'type' => 'fileselect',
						'initialize_with' => 'shared/global/monument-valley/bus-stop-ahead.jpg',
						'thumbnail_size' => 'fit-320x320'
					),
					'section_5_bg_color' => array(
						'label' => T_('Background color'),
						'note' => T_('This color will be used if Background image is not set or does not exist.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'section_5_title_color' => array(
						'label' => T_('Title color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#222222',
						'type' => 'color',
					),
					'section_5_text_color' => array(
						'label' => T_('Content color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#adadad',
						'type' => 'color',
					),
					'section_5_link_color' => array(
						'label' => T_('Links color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'section_5_link_h_color' => array(
						'label' => T_('Links hover color'),
						'note' => T_('Click to select a color'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'section_5_button_bg_color' => array(
						'label' => T_('Button background color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'section_5_button_color' => array(
						'label' => T_('Button text color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'section_5_text_align' => array(
						'label'    => T_('Align text'),
						'note'     => '',
						'type'     => 'radio',
						'options'  => array(
							array( 'section_5_left', T_('Left') ),
							array( 'section_5_center', T_('Center') ),
							array( 'section_5_right', T_('Right') ),
						),
						'defaultvalue' => 'section_5_center',
					),
				'section_5_end' => array(
					'layout' => 'end_fieldset',
				),
				
				// ============ Footer Section ============
				'footer_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Footer Settings')
				),
					'footer_bg_color' => array(
						'label' => T_('Background color'),
						'note' => T_('E-g: #00ff00 for green'),
						'defaultvalue' => '#222222',
						'type' => 'color',
					),
					'footer_content_color' => array(
						'label' => T_('Content color'),
						'note' => T_('E-g: #00ff00 for green'),
						'defaultvalue' => '#ffffff',
						'type' => 'color',
					),
					'footer_link_color' => array(
						'label' => T_('Content color'),
						'note' => T_('E-g: #00ff00 for green'),
						'defaultvalue' => '#ffffff',
						'type' => 'color',
					),
					'footer_link_h_color' => array(
						'label' => T_('Content color'),
						'note' => T_('E-g: #00ff00 for green'),
						'defaultvalue' => '#ffffff',
						'type' => 'color',
					),
					'footer_button_bg_color' => array(
						'label' => T_('Button background color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#318780',
						'type' => 'color',
					),
					'footer_button_color' => array(
						'label' => T_('Button text color'),
						'note' => T_('Click to select a color.'),
						'defaultvalue' => '#FFFFFF',
						'type' => 'color',
					),
					'footer_text_align' => array(
						'label'    => T_('Align text'),
						'note'     => '',
						'type'     => 'radio',
						'options'  => array(
							array( 'footer_left', T_('Left') ),
							array( 'footer_center', T_('Center') ),
							array( 'footer_right', T_('Right') ),
						),
						'defaultvalue' => 'footer_center',
					),
				'footer_end' => array(
					'layout' => 'end_fieldset',
				),

				
				// ============ Featured Posts Settings ============
				'featured_posts_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Featured posts Settings')
				),
					'bgimg_text_color' => array(
						'label' => T_('Text color on background image'),
						'note' => T_('E-g: #00ff00 for green'),
						'defaultvalue' => '#fff',
						'type' => 'color',
					),
					'bgimg_link_color' => array(
						'label' => T_('Link color on background image'),
						'note' => T_('E-g: #00ff00 for green'),
						'defaultvalue' => '#6cb2ef',
						'type' => 'color',
					),
					'bgimg_hover_link_color' => array(
						'label' => T_('Hover link color on background image'),
						'note' => T_('E-g: #00ff00 for green'),
						'defaultvalue' => '#6cb2ef',
						'type' => 'color',
					),
				'featured_posts_end' => array(
					'layout' => 'end_fieldset',
				),


				// ============ Colorbox Image Settings ============
				'section_colorbox_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Colorbox Image Zoom')
				),
					'colorbox' => array(
						'label' => T_('Colorbox Image Zoom'),
						'note' => T_('Check to enable javascript zooming on images (using the colorbox script)'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'colorbox_vote_post' => array(
						'label' => T_('Voting on Post Images'),
						'note' => T_('Check this to enable AJAX voting buttons in the colorbox zoom view'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'colorbox_vote_post_numbers' => array(
						'label' => T_('Display Votes'),
						'note' => T_('Check to display number of likes and dislikes'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'colorbox_vote_comment' => array(
						'label' => T_('Voting on Comment Images'),
						'note' => T_('Check this to enable AJAX voting buttons in the colorbox zoom view'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'colorbox_vote_comment_numbers' => array(
						'label' => T_('Display Votes'),
						'note' => T_('Check to display number of likes and dislikes'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'colorbox_vote_user' => array(
						'label' => T_('Voting on User Images'),
						'note' => T_('Check this to enable AJAX voting buttons in the colorbox zoom view'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'colorbox_vote_user_numbers' => array(
						'label' => T_('Display Votes'),
						'note' => T_('Check to display number of likes and dislikes'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
				'section_colorbox_end' => array(
					'layout' => 'end_fieldset',
				),


				// ============ Username Settings ============
				'section_username_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Username options')
				),
					'gender_colored' => array(
						'label' => T_('Display gender'),
						'note' => T_('Use colored usernames to differentiate men & women.'),
						'defaultvalue' => 0,
						'type' => 'checkbox',
					),
					'bubbletip' => array(
						'label' => T_('Username bubble tips'),
						'note' => T_('Check to enable bubble tips on usernames'),
						'defaultvalue' => 0,
						'type' => 'checkbox',
					),
					'autocomplete_usernames' => array(
						'label' => T_('Autocomplete usernames'),
						'note' => T_('Check to enable auto-completion of usernames entered after a "@" sign in the comment forms'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
				'section_username_end' => array(
					'layout' => 'end_fieldset',
				),


				// ============ Special Disps Settings ============
				'section_access_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('When access is denied or requires login...')
				),
					'access_login_containers' => array(
						'label' => T_('Display on login screen'),
						'note' => '',
						'type' => 'checklist',
						'options' => array(
							array( 'header',   sprintf( T_('"%s" container'), NT_('Header') ),   1 ),
							array( 'page_top', sprintf( T_('"%s" container'), NT_('Page Top') ), 1 ),
							array( 'menu',     sprintf( T_('"%s" container'), NT_('Menu') ),     0 ),
							array( 'footer',   sprintf( T_('"%s" container'), NT_('Footer') ),   1 )
							),
						),
				'section_access_end' => array(
					'layout' => 'end_fieldset',
				),
			), parent::get_param_definitions( $params ) );

		return $r;
	}


	/**
	 * Get ready for displaying the skin.
	 *
	 * This may register some CSS or JS...
	 */
	function display_init()
	{
		global $Messages, $disp, $debug;

		// Request some common features that the parent function (Skin::display_init()) knows how to provide:
		parent::display_init( array(
				'jquery',                  // Load jQuery
				'font_awesome',            // Load Font Awesome (and use its icons as a priority over the Bootstrap glyphicons)
				'bootstrap',               // Load Bootstrap (without 'bootstrap_theme_css')
				'bootstrap_evo_css',       // Load the b2evo_base styles for Bootstrap (instead of the old b2evo_base styles)
				'bootstrap_messages',      // Initialize $Messages Class to use Bootstrap styles
				'style_css',               // Load the style.css file of the current skin
				'colorbox',                // Load Colorbox (a lightweight Lightbox alternative + customizations for b2evo)
				'bootstrap_init_tooltips', // Inline JS to init Bootstrap tooltips (E.g. on comment form for allowed file extensions)
				'disp_auto',               // Automatically include additional CSS and/or JS required by certain disps (replace with 'disp_off' to disable this)
			) );

		// Skin specific initializations:

		// Limit images by max height:
		$max_image_height = intval( $this->get_setting( 'max_image_height' ) );
		if( $max_image_height > 0 )
		{
			add_css_headline( '.evo_image_block img { max-height: '.$max_image_height.'px; width: auto; }' );
		}

		// Add custom CSS:
		$custom_css = '';

		if( in_array( $disp, array( 'front', 'login', 'register', 'lostpassword', 'activateinfo', 'access_denied', 'access_requires_login' ) ) )
		{
			$FileCache = & get_FileCache();

			
			// ============ Section 1 - Front Page Main Area ============
			if( $this->get_setting( 'section_1_display' ) )
			{

			// ============ Navigation Section ============
			if( $color = $this->get_setting( 'nav_bg_color' ) )
			{
				$custom_css .= '.navbar { background-color: ' . $color . " }\n";
			}
			if( $color = $this->get_setting( 'nav_links_color' ) )
			{
				$custom_css .= '.navbar.navbar-default a, .navbar.navbar-default a:hover, .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>li>a, .navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover { color: ' . $color . " }\n";
			}
			if( $this->get_setting( 'nav_bg_transparent' ) )
			{
				$custom_css .= "@media only screen and (min-width: 766px) { .navbar { background-color: transparent } }\n";
			}
			
			
			// ============ Page Top Section ============
			if( $color = $this->get_setting( 'pagetop_button_bg_color' ) )
			{
				$custom_css .= '.evo_container__page_top .evo_widget > .btn.btn-default { background-color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'pagetop_button_color' ) )
			{
				$custom_css .= '.evo_container__page_top .evo_widget > .btn.btn-default { color: '.$color." }\n";
			}
			

			if( $this->get_setting( 'section_1_image_file_ID' ) )
			{
				$bg_image_File = & $FileCache->get_by_ID( $this->get_setting( 'section_1_image_file_ID' ), false, false );
			}
			if( !empty( $bg_image_File ) && $bg_image_File->exists() )
			{
				$custom_css .= '.evo_pictured_layout { background-image: url('.$bg_image_File->get_url().") }\n";
			}
			else
			{
				$color = $this->get_setting( 'section_1_bg_color' );
				$custom_css .= '.evo_pictured_layout { background: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_1_coll_title_color' ) )
			{
				$custom_css .= 'body.pictured .main_page_wrapper .widget_core_coll_title h1 a { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_1_title_color' ) )
			{
				$custom_css .= 'body.pictured .main_page_wrapper h2.page-header { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_1_muted_color' ) )
			{
				$custom_css .= 'body.pictured .main_page_wrapper .text-muted { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_1_text_color' ) )
			{
				$custom_css .= 'body.pictured .front_main_content, body.pictured .front_main_content h1 small, .evo_container__header, .evo_container__page_top { color: '.$color." }\n";
			}

			$link_color = $this->get_setting( 'section_1_link_color' );
			$icon_color = $this->get_setting( 'section_1_icon_color' );
			if( $link_color )
			{
				$custom_css .= 'body.pictured .main_page_wrapper .front_main_area a,
				body.pictured .main_page_wrapper .front_main_area div.evo_withteaser div.item_content > a { color: '.$link_color.' }
				body.pictured .main_page_wrapper .front_main_area div.widget_core_coll_item_list.evo_noexcerpt.evo_withteaser ul li div.item_content > a,
				body.pictured .main_page_wrapper .front_main_area div.widget_core_coll_post_list.evo_noexcerpt.evo_withteaser ul li div.item_content > a { color: '.$link_color." }\n";
			}
			if( $link_color && $icon_color )
			{
				$custom_css .= 'body.pictured .front_main_content .ufld_icon_links a:not([class*="ufld__textcolor"]):not(:hover) { color: '.$icon_color." }\n";
				$custom_css .= 'body.pictured .front_main_content .ufld_icon_links a:not([class*="ufld__bgcolor"]):not(:hover) { background-color: '.$link_color." }\n";
				$custom_css .= 'body.pictured .front_main_content .ufld_icon_links a:hover:not([class*="ufld__hovertextcolor"]) { color: '.$link_color." }\n";
				$custom_css .= 'body.pictured .front_main_content .ufld_icon_links a:hover:not([class*="ufld__hoverbgcolor"]) { background-color: '.$icon_color." }\n";
			}
			if( $color = $this->get_setting( 'section_1_button_bg_color' ) )
			{
				$custom_css .= '.evo_container__front_page_primary .evo_widget > .btn.btn-default { background-color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_1_button_color' ) )
			{
				$custom_css .= '.evo_container__front_page_primary .evo_widget > .btn.btn-default { color: '.$color." }\n";
			}
			if( $this->get_setting( 'section_1_text_align' ) == 'section_1_center' )
			{
				$custom_css .= ".evo_container__front_page_primary { text-align: center }\n";
			}
			if( $this->get_setting( 'section_1_text_align' ) == 'section_1_right' )
			{
				$custom_css .= ".evo_container__front_page_primary { text-align: right }\n";
			}
			}

			
			// ============ Section 2 - Front Page Secondary Area ============
			if( $this->get_setting( 'section_2_display' ) )
			{
			if( $this->get_setting( 'section_2_image_file_ID' ) )
			{
				$bg_image_File1 = & $FileCache->get_by_ID( $this->get_setting( 'section_2_image_file_ID' ), false, false );
			}
			if( !empty( $bg_image_File1 ) && $bg_image_File1->exists() )
			{
				$custom_css .= '.evo_container__front_page_secondary_area { background-image: url('.$bg_image_File1->get_url().") }\n";
			}
			else
			{
				$color = $this->get_setting( 'section_2_bg_color' );
				$custom_css .= '.evo_container__front_page_secondary_area { background: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_2_title_color' ) )
			{
				$custom_css .= '.evo_container__front_page_secondary_area h2.page-header { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_2_text_color' ) )
			{
				$custom_css .= '.evo_container__front_page_secondary_area { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_2_link_color' ) )
			{
				$custom_css .= '.evo_container__front_page_secondary_area a { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_2_link_h_color' ) )
			{
				$custom_css .= '.evo_container__front_page_secondary_area a:hover { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_2_button_bg_color' ) )
			{
				$custom_css .= '.evo_container__front_page_secondary_area .evo_widget > .btn.btn-default { background-color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_2_button_color' ) )
			{
				$custom_css .= '.evo_container__front_page_secondary_area .evo_widget > .btn.btn-default { color: '.$color." }\n";
			}
			if( $this->get_setting( 'section_2_text_align' ) == 'section_2_center' )
			{
				$custom_css .= ".evo_container__front_page_secondary_area { text-align: center }\n";
			}
			if( $this->get_setting( 'section_2_text_align' ) == 'section_2_right' )
			{
				$custom_css .= ".evo_container__front_page_secondary_area { text-align: right }\n";
			}
			}

			
			// ============ Section 3 - Front Page Area 3 ============
			if( $this->get_setting( 'section_3_display' ) )
			{
			if( $this->get_setting( 'section_3_image_file_ID' ) )
			{
				$bg_image_File2 = & $FileCache->get_by_ID( $this->get_setting( 'section_3_image_file_ID' ), false, false );
			}
			if( !empty( $bg_image_File2 ) && $bg_image_File2->exists() )
			{
				$custom_css .= '.evo_container__front_page_area_3 { background-image: url('.$bg_image_File2->get_url().") }\n";
			}
			else
			{
				$color = $this->get_setting( 'section_3_bg_color' );
				$custom_css .= '.evo_container__front_page_area_3 { background: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_3_title_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_3 h2.page-header { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_3_text_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_3 { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_3_link_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_3 a { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_3_link_h_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_3 a:hover { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_3_button_bg_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_3 .evo_widget > .btn.btn-default { background-color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_3_button_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_3 .evo_widget > .btn.btn-default { color: '.$color." }\n";
			}
			if( $this->get_setting( 'section_3_text_align' ) == 'section_3_center' )
			{
				$custom_css .= ".evo_container__front_page_area_3 { text-align: center }\n";
			}
			if( $this->get_setting( 'section_3_text_align' ) == 'section_3_right' )
			{
				$custom_css .= ".evo_container__front_page_area_3 { text-align: right }\n";
			}
			}

			
			// ============ Section 4 - Front Page Area 4 ============
			if( $this->get_setting( 'section_4_display' ) )
			{
			if( $this->get_setting( 'section_4_image_file_ID' ) )
			{
				$bg_image_File3 = & $FileCache->get_by_ID( $this->get_setting( 'section_4_image_file_ID' ), false, false );
			}
			if( !empty( $bg_image_File3 ) && $bg_image_File3->exists() )
			{
				$custom_css .= '.evo_container__front_page_area_4 { background-image: url('.$bg_image_File3->get_url().") }\n";
			}
			else
			{
				$color = $this->get_setting( 'section_4_bg_color' );
				$custom_css .= '.evo_container__front_page_area_4 { background: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_4_title_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_4 h2.page-header { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_4_text_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_4 { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_4_link_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_4 a { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_4_link_h_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_4 a:hover { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_4_button_bg_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_4 .evo_widget > .btn.btn-default { background-color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_4_button_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_4 .evo_widget > .btn.btn-default { color: '.$color." }\n";
			}
			if( $this->get_setting( 'section_4_text_align' ) == 'section_4_center' )
			{
				$custom_css .= ".evo_container__front_page_area_4 { text-align: center }\n";
			}
			if( $this->get_setting( 'section_4_text_align' ) == 'section_4_right' )
			{
				$custom_css .= ".evo_container__front_page_area_4 { text-align: right }\n";
			}
			}
			
			
			// ============ Section 5 - Front Page Area 5 ============
			if( $this->get_setting( 'section_5_display' ) )
			{
			if( $this->get_setting( 'section_5_image_file_ID' ) )
			{
				$bg_image_File4 = & $FileCache->get_by_ID( $this->get_setting( 'section_5_image_file_ID' ), false, false );
			}
			if( !empty( $bg_image_File4 ) && $bg_image_File4->exists() )
			{
				$custom_css .= '.evo_container__front_page_area_5 { background-image: url('.$bg_image_File4->get_url().") }\n";
			}
			else
			{
				$color = $this->get_setting( 'section_5_bg_color' );
				$custom_css .= '.evo_container__front_page_area_5 { background: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_5_title_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_5 h2.page-header { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_5_text_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_5 { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_5_link_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_5 a { color: '.$color." }\n";
			}
			if( $color =  $this->get_setting( 'section_5_link_h_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_5 a:hover { color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_5_button_bg_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_5 .evo_widget > .btn.btn-default { background-color: '.$color." }\n";
			}
			if( $color = $this->get_setting( 'section_5_button_color' ) )
			{
				$custom_css .= '.evo_container__front_page_area_5 .evo_widget > .btn.btn-default { color: '.$color." }\n";
			}
			if( $this->get_setting( 'section_5_text_align' ) == 'section_5_center' )
			{
				$custom_css .= ".evo_container__front_page_area_5 { text-align: center }\n";
			}
			if( $this->get_setting( 'section_5_text_align' ) == 'section_5_right' )
			{
				$custom_css .= ".evo_container__front_page_area_5 { text-align: right }\n";
			}
			}
		}


		// ============ Featured Posts Settings ============
		if( $color = $this->get_setting( 'bgimg_text_color' ) )
		{	// Custom text color on background image:
			$custom_css .= '.evo_hasbgimg { color: '.$color." }\n";
		}
		if( $color = $this->get_setting( 'bgimg_link_color' ) )
		{	// Custom link color on background image:
			$custom_css .= '.evo_hasbgimg a { color: '.$color." }\n";
		}
		if( $color = $this->get_setting( 'bgimg_hover_link_color' ) )
		{	// Custom link hover color on background image:
			$custom_css .= '.evo_hasbgimg a:hover { color: '.$color." }\n";
		}
		
		
		// ============ Footer Section ============
		if( $color = $this->get_setting( 'footer_bg_color' ) )
		{	// Custom text color on background image:
			$custom_css .= '.footer_wrapper { background-color: '.$color." }\n";
		}
		if( $color = $this->get_setting( 'footer_content_color' ) )
		{	// Custom link color on background image:
			$custom_css .= '.footer_wrapper { color: '.$color." }\n";
		}
		if( $color = $this->get_setting( 'footer_link_color' ) )
		{	// Custom link color on background image:
			$custom_css .= '.footer_wrapper a { color: '.$color." }\n";
		}
		if( $color = $this->get_setting( 'footer_link_h_color' ) )
		{	// Custom link color on background image:
			$custom_css .= '.footer_wrapper a:hover { color: '.$color." }\n";
		}
		if( $color = $this->get_setting( 'footer_button_bg_color' ) )
		{ // Custom background color:
			$custom_css .= '.footer_wrapper .evo_widget > .btn.btn-default { background-color: '.$color." }\n";
		}
		if( $color = $this->get_setting( 'footer_button_color' ) )
		{ // Custom background color:
			$custom_css .= '.footer_wrapper .evo_widget > .btn.btn-default { color: '.$color." }\n";
		}
		if( $this->get_setting( 'footer_text_align' ) == 'footer_center' )
		{
			$custom_css .= ".footer_wrapper { text-align: center }\n";
		}
		if( $this->get_setting( 'footer_text_align' ) == 'footer_right' )
		{
			$custom_css .= ".footer_wrapper { text-align: right }\n";
		}

		if( ! empty( $custom_css ) )
		{
			if( $disp == 'front' )
			{ // Use standard bootstrap style on width <= 640px only for disp=front
				$custom_css = '@media only screen and (min-width: 641px)
					{
						'.$custom_css.'
					}';
			}
			$custom_css = '<style type="text/css">
<!--
'.$custom_css.'
-->
</style>';
		add_headline( $custom_css );
		}
	}


	/**
	 * Check if we can display a widget container when access is denied to collection by current user
	 *
	 * @param string Widget container key: 'header', 'page_top', 'menu', 'sidebar', 'sidebar2', 'footer'
	 * @return boolean TRUE to display
	 */
	function show_container_when_access_denied( $container_key )
	{
		global $Collection, $Blog;

		if( $Blog->has_access() )
		{	// If current user has an access to this collection then don't restrict containers:
			return true;
		}

		// Get what containers are available for this skin when access is denied or requires login:
		$access = $this->get_setting( 'access_login_containers' );

		return ( ! empty( $access ) && ! empty( $access[ $container_key ] ) );
	}

}

?>