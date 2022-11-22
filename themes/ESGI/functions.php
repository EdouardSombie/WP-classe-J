<?php 

// Déclarer les emplacements de menu
add_action('after_setup_theme', 'esgi_register_menu');
function esgi_register_menu(){
	register_nav_menus( [
	    	'primary' => __( 'Menu principal', 'ESGI' ),
		] 
	);
}

// Ajouter les assets css et js (en file d'attente)
add_action('wp_enqueue_scripts', 'esgi_style_and_script');
function esgi_style_and_script(){
	wp_enqueue_style('mainCSS', get_stylesheet_uri(), 0);
	wp_enqueue_script('jQuery', get_template_directory_uri() . '/assets/js/vendor/jquery-3.6.1.min.js', 0);
	wp_enqueue_script('mainJS', get_template_directory_uri() . '/assets/js/main.js', 1);

	// Déclarer une variable ajaxURL et la passer au js (wp_localize_script)
	wp_localize_script('mainJS', 'ajaxURL', admin_url('admin-ajax.php'));
}


// Déclaration des actions ajax (load_posts)
add_action( 'wp_ajax_load_posts', 'ajax_load_posts' );
add_action( 'wp_ajax_nopriv_load_posts', 'ajax_load_posts' );


function ajax_load_posts(){
	$page = $_POST['page'];

	// Créer la query avec les parametres demandés (page, type de publications)
	$args = [
		'post_type' => 'post',
		'posts_per_page' => get_option('posts_per_page'),
		'post_status' => 'publish',
		'paged' => $page,
	];
	$wp_query = new WP_Query($args);

	// Ouvrir le buffer PHP et y mettre le template-part post-list.php
	ob_start();
	include('template-parts/post-list.php');
	echo ob_get_clean(); // Vider le tampon et lire son contenu
	wp_die();
}

// Autoriser l'ajout d'un logo custom
add_action('after_setup_theme', 'esgi_support_theme');
function esgi_support_theme(){
	add_theme_support('custom-logo');
	add_theme_support('post-thumbnails');
	add_theme_support('widgets');
}


// Ajouter des parametres de customisation

add_action('customize_register','esgi_customize');
function esgi_customize($wp_customize){

	// Définir une section ESGI
	$wp_customize->add_section( 'section_esgi', [
	  'title' => __( 'Réglages du thème ESGI' ),
	  'description' => __( 'Customisez votre thème ici.' ),
	  'panel' => '', // Not typically needed.
	  'priority' => 0,
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	] );

	// Définir les settings
	$wp_customize->add_setting( 'main_color', [
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'sanitize_hex_color',
	  'sanitize_js_callback' => '', // Basically to_json.
	] );

	$wp_customize->add_setting( 'dark_mode', [
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'sanitize_boolean',
	  'sanitize_js_callback' => '', // Basically to_json.
	] );

	$wp_customize->add_setting( 'sidebar_on', [
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'sanitize_boolean',
	  'sanitize_js_callback' => '', // Basically to_json.
	] );

	// Ajouter des controles (un par setting)
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_color', [
			'priority' => 1,
  			'label' => __( 'Couleur principale', 'ESGI' ),
  			'section' => 'section_esgi',
		] 
	) );

	$wp_customize->add_control( 'dark_mode', [
	  'type' => 'checkbox',
	  'priority' => 2, // Within the section.
	  'section' => 'section_esgi', // Required, core or custom.
	  'label' => __( 'Mode sombre' ),
	] );

	$wp_customize->add_control( 'sidebar_on', [
	  'type' => 'checkbox',
	  'priority' => 3, // Within the section.
	  'section' => 'section_esgi', // Required, core or custom.
	  'label' => __( 'Afficher la barre latérale sur les pages d\'article.' ),
	] );

}


function sanitize_boolean($value){
	return isset($value) && $value == true ? true : false;
}



// Prise en compte des réglages du customizer de thème
add_action( 'wp_head', 'esgi_apply_settings');
function esgi_apply_settings(){
	$main_color = get_theme_mod('main_color', '#3F51B5');
	echo '<style type="text/css">
				html{
					--main-color: ' . $main_color . ';
				}
			</style>
			'; 
}


// ajout d'une classe dark sur le body
add_filter('body_class', 'esgi_dark_mode');
function esgi_dark_mode($classes){
	$dark_mode = get_theme_mod('dark_mode', false);
	if($dark_mode){
		$classes[] = 'dark';
	}
	return $classes;
}


// Ajout d'une zone de widget
add_action( 'widgets_init', 'esgi_widgets_init' );
function esgi_widgets_init() {
	register_sidebar( [
		'name'          => __('Zone de widgets de la barre latérale'),
		'id'            => 'sidebar_widgets_area',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	] );
}



// ajout d'image svg au markup de la page

function getIcon($name){

	$twitter = '<svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M18 1.6875C17.325 2.025 16.65 2.1375 15.8625 2.25C16.65 1.8 17.2125 1.125 17.4375 0.225C16.7625 0.675 15.975 0.9 15.075 1.125C14.4 0.45 13.3875 0 12.375 0C10.4625 0 8.775 1.6875 8.775 3.7125C8.775 4.05 8.775 4.275 8.8875 4.5C5.85 4.3875 3.0375 2.925 1.2375 0.675C0.9 1.2375 0.7875 1.8 0.7875 2.5875C0.7875 3.825 1.4625 4.95 2.475 5.625C1.9125 5.625 1.35 5.4 0.7875 5.175C0.7875 6.975 2.025 8.4375 3.7125 8.775C3.375 8.8875 3.0375 8.8875 2.7 8.8875C2.475 8.8875 2.25 8.8875 2.025 8.775C2.475 10.2375 3.825 11.3625 5.5125 11.3625C4.275 12.375 2.7 12.9375 0.9 12.9375C0.5625 12.9375 0.3375 12.9375 0 12.9375C1.6875 13.95 3.6 14.625 5.625 14.625C12.375 14.625 16.0875 9 16.0875 4.1625C16.0875 4.05 16.0875 3.825 16.0875 3.7125C16.875 3.15 17.55 2.475 18 1.6875Z" fill="#1A1A1A"/>
</svg>';
	
	$facebook = '<svg width="12" height="18" viewBox="0 0 12 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M3.4008 18L3.375 10.125H0V6.75H3.375V4.5C3.375 1.4634 5.25545 0 7.9643 0C9.26187 0 10.3771 0.0966038 10.7021 0.139781V3.3132L8.82333 3.31406C7.35011 3.31406 7.06485 4.01411 7.06485 5.04139V6.75H11.25L10.125 10.125H7.06484V18H3.4008Z" fill="#1A1A1A"/>
</svg>
';
	
	$google = '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path id="Vector" d="M9.12143 7.71429V10.8H14.3929C14.1357 12.0857 12.85 14.6571 9.25 14.6571C6.16429 14.6571 3.72143 12.0857 3.72143 9C3.72143 5.91429 6.29286 3.34286 9.25 3.34286C11.05 3.34286 12.2071 4.11429 12.85 4.75714L15.2929 2.44286C13.75 0.9 11.6929 0 9.25 0C4.23571 0 0.25 3.98571 0.25 9C0.25 14.0143 4.23571 18 9.25 18C14.3929 18 17.8643 14.4 17.8643 9.25714C17.8643 8.61429 17.8643 8.22857 17.7357 7.71429H9.12143Z" fill="#1A1A1A"/>
</svg>';

	$linkedIn = '<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17.9698 0H1.64687C1.19966 0 0.864258 0.335404 0.864258 0.782609V17.2174C0.864258 17.5528 1.19966 17.8882 1.64687 17.8882H18.0816C18.5289 17.8882 18.8643 17.5528 18.8643 17.1056V0.782609C18.7525 0.335404 18.4171 0 17.9698 0ZM3.54749 15.205V6.70807H6.23072V15.205H3.54749ZM4.8891 5.59006C3.99469 5.59006 3.32389 4.80745 3.32389 4.02484C3.32389 3.13043 3.99469 2.45963 4.8891 2.45963C5.78351 2.45963 6.45432 3.13043 6.45432 4.02484C6.34252 4.80745 5.67171 5.59006 4.8891 5.59006ZM16.0692 15.205H13.386V11.0683C13.386 10.0621 13.386 8.8323 12.0444 8.8323C10.7028 8.8323 10.4792 9.95031 10.4792 11.0683V15.3168H7.79593V6.70807H10.3674V7.82609C10.7028 7.15528 11.5972 6.48447 12.827 6.48447C15.5102 6.48447 15.9574 8.27329 15.9574 10.5093V15.205H16.0692Z" fill="#1A1A1A"/>
</svg>';
	
	$circle = '<svg width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="3.5" cy="3.5" r="3" fill="white" stroke="#F0F0F0"/>
</svg>';

	return $$name;

}
?>