<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
	});

	add_filter('template_include', function( $template ) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});

	return;
}

Timber::$dirname = array( 'templates', 'views' );
/** Start Timber! */

class StarterSite extends Timber\Site {
	/** Add timber support. */
	public function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}
	
	
	function bootstrap( $text ) {
		$text = str_replace('wp-caption', 'figure', $text );
		$text = str_replace('figure-text', 'figure-caption', $text );

		$text = str_replace('<img class="', '<img class="rounded2 ', $text );
		// $text = str_replace('<img class="', '<img class="rounded ', $text );

		$text = str_replace('alignright', 'uk-align-right ml-3 ', $text );
		$text = str_replace('alignleft', 'uk-align-left mr-3 ', $text );
		$text = str_replace('aligncenter', 'uk-align-center mr-3 ', $text );

		// if ( strpos($text, 'figure') ) {
		// 	$text = str_replace('class="figure float-left ', 'class="figure float-left mr-3 ', $text );
		// 	$text = str_replace('class="figure float-right ', 'class="figure float-right ml-3 ', $text );
		//
		// }



		// $text = str_replace("figure-text", "figure-caption", $text );
		// $text = str_replace("figure-text", "figure-caption", $text );
		// $text = str_replace("figure-text", "figure-caption", $text );
		//
		//
		// $( "img.alignright" ).addClass('rounded').addClass('float-right').removeClass('alignright').css('margin-left', '1rem').css('margin-top', '0.5rem');
		// $( "img.alignleft" ).addClass('rounded').addClass('float-left').removeClass('alignleft').css('margin-right', '1rem').css('margin-top', '0.5rem');


		return $text;
	}
	
	
	/** This is where you can register custom post types. */
	public function register_post_types() {
	
		/**  Post Type: Authors **/
		$labels = array(
			"name" => __( "Authors", "" ),
			"singular_name" => __( "Author", "" ),
		);

		$args = array(
			"label" => __( "Authors", "" ),
			"labels" => $labels,
			"description" => "",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"delete_with_user" => false,
			"show_in_rest" => false,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"has_archive" => false,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"rewrite" => array( "slug" => "author_post", "with_front" => true ),
			"query_var" => true,
			"menu_icon" => "dashicons-groups",
			"supports" => array( "title", "editor", "thumbnail" ),
		);

		register_post_type( "author_post", $args );


		if( function_exists('acf_add_local_field_group') ) {
			acf_add_local_field_group(array(
	'key' => 'group_5b97eb96a03e1',
	'title' => 'Author',
	'fields' => array(
		array(
			'key' => 'field_5b97eb9d882ca',
			'label' => 'Author Post Category',
			'name' => 'author_post_category',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'taxonomy' => 'category',
			'field_type' => 'select',
			'allow_null' => 0,
			'add_term' => 1,
			'save_terms' => 1,
			'load_terms' => 1,
			'return_format' => 'id',
			'multiple' => 0,
		),
		array(
			'key' => 'field_5ba92fd52f86c',
			'label' => 'Author Thumbnail Image',
			'name' => 'author_thumbnail_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5ba92fb39bc6a',
			'label' => 'Author Page Image',
			'name' => 'author_page_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'author_post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'featured_image',
	),
	'active' => 1,
	'description' => '',
));

			acf_add_local_field_group(array(
	'key' => 'group_5ba92b848a663',
	'title' => 'Home Page',
	'fields' => array(
		array(
			'key' => 'field_5ba92b8762805',
			'label' => 'Header',
			'name' => 'header',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'page-home.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

			acf_add_local_field_group(array(
	'key' => 'group_5b97ec32c8b29',
	'title' => 'Post',
	'fields' => array(
		array(
			'key' => 'field_5b97ec387d8b3',
			'label' => 'Author',
			'name' => 'author_post',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'taxonomy' => 'category',
			'field_type' => 'select',
			'allow_null' => 0,
			'add_term' => 0,
			'save_terms' => 1,
			'load_terms' => 1,
			'return_format' => 'id',
			'multiple' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'format',
		1 => 'categories',
		2 => 'tags',
	),
	'active' => 1,
	'description' => '',
));
		}
	
	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {

	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['menu'] = new Timber\Menu();
		$context['site'] = $this;
		return $context;
	}

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter( new Twig_SimpleFilter( 'myfoo', array( $this, 'myfoo' ) ) );
		$twig->addFilter('bootstrap', new Twig_SimpleFilter('bootstrap', array($this, 'bootstrap')));
		return $twig;
	}

}

new StarterSite();
