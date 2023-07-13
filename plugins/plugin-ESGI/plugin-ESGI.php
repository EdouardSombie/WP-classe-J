<?php
/*
Plugin Name: Plugin ESGI
Plugin URI: https://esgi.fr
Description: Création du type de publication 'projects' et tout le reste...
Author: Edouard Sombié
Version: 1.0
*/

add_action('init', 'esgi_custom_post_type');
function esgi_custom_post_type() {
    $labelsProject = array(
     'name' => __( 'Projets' ),
     'singular_name' => __( 'Projet' ),
     'all_items' => __( 'Tous les projets' ),
     'add_new' => __( 'Ajouter un projet', 'Projets' ),
     'add_new_item' => __( 'Ajouter un projet' ),
     'edit_item' => __( 'Modifier un projet' ),
     'new_item' => __( 'Nouveau projet' ),
     'view_item' => __( 'Voir le projet' ),
     'search_items' => __( 'Rechercher parmi les projets' ),
     'not_found' => __( 'Aucun projet trouvé' ),
     'not_found_in_trash' => __( 'Aucun projet trouvé dans la corbeille' ),
     'parent_item_colon' => ''
     );

     $argsProject = array(
     'labels' => $labelsProject,
     'public' => true,
     'has_archive' => true, // Set to false hides Archive Pages
     'menu_icon' => 'dashicons-media-code', //pick one here ~> https://developer.wordpress.org/resource/dashicons/
     'rewrite' => array( 'slug' => 'projet' ),
     //'taxonomies' => array( 'post_tag' ),
     'query_var' => true,
     'menu_position' => 1,
     'publicly_queryable' => true, // Set to false hides Single Pages
     'supports' => array( 'thumbnail' , 'title', 'editor'),
     'show_in_rest' => true
     );

     register_post_type('project', $argsProject);

     // Déclaration d'une taxonomie personnalisée
     $labels = [
     'name' => __( 'Skills' ),
     'singular_name' => __( 'Skill' ),
     'all_items' => __( 'Tous les Skills' ),
     'add_new' => __( 'Ajouter un Skill', 'Skills' ),
     'add_new_item' => __( 'Ajouter un Skill' ),
     'edit_item' => __( 'Modifier un Skill' ),
     'new_item' => __( 'Nouveaux Skills' ),
     'view_item' => __( 'Voir le Skill' ),
     'search_items' => __( 'Rechercher parmi les Skills' ),
     'not_found' => __( 'Aucun Skill trouvé' ),
     'not_found_in_trash' => __( 'Aucun Skill trouvé dans la corbeille' ),
     'parent_item_colon' => ''
     ];
     
     $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_rest'          => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => ['slug' => 'skills'],
    );

    register_taxonomy( 'skills', 'project', $args);
}
