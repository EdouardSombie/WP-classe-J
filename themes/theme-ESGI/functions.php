<?php
// Déclaration des emplacements de menu

add_action('init', 'esgi_initTheme');
function esgi_initTheme(){
	register_nav_menus([
				'primary_menu' => __('Menu principal', 'ESGI') // chaine traduite dans le domaine 'ESGI'
			]);
}

