<?php
/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');


    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );

}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @return void
 */
function godsend_scripts_styles() {


	// Loads our Lato Google Font.
	wp_enqueue_style( 'googlefont-style', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,400italic', array() );


	// Loads our main stylesheet.
	wp_enqueue_style( 'godsend-style', get_template_directory_uri() . '/css/style.css?v=1.1', array(), '2014-12-14' );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'godsend-ie', get_template_directory_uri() . '/css/ie.css', array( 'godsend-style' ), '2013-07-18' );
	wp_style_add_data( 'godsend-ie', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'godsend-js', get_template_directory_uri() . '/js/functions.js', array('jquery'), '1.0.0', true );
}

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

function create_comic_pages_godsend()
{
    $labels = array(
		'name'              => _x( 'Chapters', 'taxonomy general name' ),
		'singular_name'     => _x( 'Chapter', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Chapters' ),
		'all_items'         => __( 'All Chapters' ),
		'parent_item'       => __( 'Parent Chapter' ),
		'parent_item_colon' => __( 'Parent Chapter:' ),
		'edit_item'         => __( 'Edit Chapter' ),
		'update_item'       => __( 'Update Chapter' ),
		'add_new_item'      => __( 'Add New Chapter' ),
		'new_item_name'     => __( 'New Chapter Name' ),
		'menu_name'         => __( 'Chapters' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'chapter' ),
	);

	register_taxonomy( 'chapter', array( 'comic-page' ), $args );

    register_post_type('comic-page', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Comic Pages', 'godsend'), // Rename these to suit
            'singular_name' => __('Comic Page', 'godsend'),
            'add_new' => __('Add New', 'godsend'),
            'add_new_item' => __('Add New Comic Page', 'godsend'),
            'edit' => __('Edit', 'godsend'),
            'edit_item' => __('Edit Comic Page', 'godsend'),
            'new_item' => __('New Comic Page', 'godsend'),
            'view' => __('View Comic Page', 'godsend'),
            'view_item' => __('View Comic Page', 'godsend'),
            'search_items' => __('Search Comic Pages', 'godsend'),
            'not_found' => __('No Comic Pages found', 'godsend'),
            'not_found_in_trash' => __('No Comic Pages found in Trash', 'godsend')
        ),
        'public' => true,
        'menu_icon' => 'dashicons-format-image',
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'comments'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'chapter'
        ) // Add Category and Post Tags support
    ));
}
/**
 * Remove the slug from published post permalinks. Only affect our CPT though.
 */
function vipx_remove_cpt_slug( $post_link, $post, $leavename ) {

    if ( ! in_array( $post->post_type, array( 'comic-page' ) ) || 'publish' != $post->post_status )
        return $post_link;

    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

    return $post_link;
}
add_filter( 'post_type_link', 'vipx_remove_cpt_slug', 10, 3 );

function vipx_parse_request_tricksy( $query ) {

    // Only noop the main query
    if ( ! $query->is_main_query() )
        return;

    // Only noop our very specific rewrite rule match
    if ( 2 != count( $query->query )
        || ! isset( $query->query['page'] ) )
        return;

    // 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
    if ( ! empty( $query->query['name'] ) )
        $query->set( 'post_type', array( 'post', 'comic-page', 'page' ) );
}
add_action( 'pre_get_posts', 'vipx_parse_request_tricksy' );
// Replace Posts label as Announcements in Admin Panel 

function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Announcements';
    $submenu['edit.php'][5][0] = 'Announcements';
    $submenu['edit.php'][10][0] = 'Add Announcements';
    echo '';
}
function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'Announcements';
        $labels->singular_name = 'Announcement';
        $labels->add_new = 'Add Announcement';
        $labels->add_new_item = 'Add Announcement';
        $labels->edit_item = 'Edit Announcement';
        $labels->new_item = 'Announcement';
        $labels->view_item = 'View Announcement';
        $labels->search_items = 'Search Announcements';
        $labels->not_found = 'No Announcements found';
        $labels->not_found_in_trash = 'No Announcements found in Trash';
}


function add_comic_pages_to_loop( $query ) {
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'comic-page' ) );
		//$query->set( 'posts_per_page', 1 );
	return $query;
}

function register_my_menus() {
  register_nav_menus(
    array(
      'primary' => __( 'Header Menu' ),
      'footer1' => __( '1st Footer Menu' ),
      'footer2' => __( '2nd Footer Menu' ),
      'social' => __( 'Social Menu' )
    )
  );
}

function godsend_register_theme_customizer( $wp_customize ) {
 
    
    $wp_customize->add_section( 'godsend_details' , array(
	    'title'      => __( 'Footer Details', 'godsend' ),
	    'priority'   => 30,
	) );

	$wp_customize->add_setting(
        'details_1',
        array(
            'default'     => 'All rights reserved.'
        )
    );
    $wp_customize->add_setting(
        'details_2',
        array(
            'default'     => 'Built by Team Eight. Powered by WordPress'
        )
    );
 
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'godsend_details_field_1', array(
        'label'          => __( 'Details 1', 'godsend' ),
        'section'        => 'godsend_details',
        'settings'       => 'details_1'
	) ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'godsend_details_field_2', array(
        'label'          => __( 'Details 2', 'godsend' ),
        'section'        => 'godsend_details',
        'settings'       => 'details_2'
	) ) );
 
}
add_action( 'customize_register', 'godsend_register_theme_customizer' );


// builds out comic nav link in a UL

function godsend_comic_nav() {
	global $post;
	$postid = get_the_ID();

	?>
	<div class="comic-nav cf">
		<?php
			$previous_post = get_previous_post();
			if (!empty( $previous_post )) {
		?>
		<div class="previous li">
			<?php include('partials/comic-nav-1.svg'); ?>
			<a href="<?php echo get_permalink( $previous_post->ID ); ?>"><i class="icon-angle-left"></i>Previous</a>
		</div>
		<?php } else { ?>
		<div class="previous li inactive">
			<?php include('partials/comic-nav-1.svg'); ?>
			<span><i class="icon-angle-left"></i>Previous</span>
		</div>
		<?php } ?>

		<?php 
			$args = array( 'post_type'=>'comic-page', 'posts_per_page'=>-1, 'numberposts'=>-1 );
			$comics_pages = get_posts($args);

			$latest_comic = $comics_pages[0]->ID;
			$first_comic = end($comics_pages)->ID;					
			//echo "<pre>"; var_dump($latest_comic); echo "</pre>";
		?>
		<div class="center">
			<?php 
				if($postid!=$first_comic){
			?>
			<div class="first li">
				<?php include('partials/comic-nav-2.svg'); ?>
				<a href="<?php echo get_permalink( $first_comic ); ?>"><i class="icon-angle-double-left"></i>First</a>
			</div>
			<?php }else{ ?>
			<div class="first li inactive">
				<?php include('partials/comic-nav-2.svg'); ?>
				<span><i class="icon-angle-double-left"></i>First</span>
			</div>
			<?php } ?>
			<div class="chapters li">
				<?php include('partials/comic-nav-3.svg'); ?>
				<a href="<?php echo site_url(); ?>/chapters">Chapters</a>
			</div>
			<?php 
				if($postid!=$latest_comic){
			?>
			<div class="latest li">
				<?php include('partials/comic-nav-4.svg'); ?>
				<a href="<?php echo get_permalink( $latest_comic ); ?>">Latest<i class="icon-angle-double-right"></i></a>
			</div>
			<?php }else{ ?>
			<div class="latest li inactive">
				<?php include('partials/comic-nav-4.svg'); ?>
				<span>Latest<i class="icon-angle-double-right"></i></span>
			</div>
			<?php } ?>
		</div>

		<?php
			$next_post = get_next_post();
			if (!empty( $next_post )) {
		?>
		<div class="next li">
			<?php include('partials/comic-nav-5.svg'); ?>
			<a href="<?php echo get_permalink( $next_post->ID ); ?>">Next<i class="icon-angle-right"></i></a>
		</div>
		<?php } else { ?>
		<div class="next li inactive">
			<?php include('partials/comic-nav-5.svg'); ?>
			<span>Next<i class="icon-angle-right"></i></span>
		</div>
		<?php } ?>
	</div>
	<?php

}

//Function to add featured image in RSS feeds
function featured_image_in_rss($content)
{
    // Global $post variable
    global $post;
    // Check if the post has a featured image
    if (has_post_thumbnail($post->ID))
    {
        $content = get_the_post_thumbnail($post->ID, 'full', array('style' => 'margin-bottom:10px;')) . $content;
    }
    return $content;
}
//Add the filter for RSS feeds Excerpt
add_filter('the_excerpt_rss', 'featured_image_in_rss');
//Add the filter for RSS feed content
add_filter('the_content_feed', 'featured_image_in_rss');

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action( 'init', 'register_my_menus' );
add_action( 'pre_get_posts', 'add_comic_pages_to_loop' );
add_action( 'wp_enqueue_scripts', 'godsend_scripts_styles' );
add_action('init', 'create_comic_pages_godsend'); // Add our Custom Post Type
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

