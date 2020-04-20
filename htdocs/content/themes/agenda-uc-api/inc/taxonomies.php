<?php 
function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Organizadores.
	 */

	$labels = [
		"name" => __( "Organizadores", "agenda_uc_api" ),
		"singular_name" => __( "Organizador", "agenda_uc_api" ),
		"menu_name" => __( "Organizadores", "agenda_uc_api" ),
		"all_items" => __( "Todos los Organizadores", "agenda_uc_api" ),
		"edit_item" => __( "Editar Organizador", "agenda_uc_api" ),
		"view_item" => __( "Ver Organizador", "agenda_uc_api" ),
		"update_item" => __( "Actualizar el nombre de Organizador", "agenda_uc_api" ),
		"add_new_item" => __( "Añadir nuevo Organizador", "agenda_uc_api" ),
		"new_item_name" => __( "Nombre del nuevo Organizador", "agenda_uc_api" ),
		"parent_item" => __( "Organizador superior", "agenda_uc_api" ),
		"parent_item_colon" => __( "Organizador superior", "agenda_uc_api" ),
		"search_items" => __( "Buscar Organizadores", "agenda_uc_api" ),
		"popular_items" => __( "Organizadores populares", "agenda_uc_api" ),
		"separate_items_with_commas" => __( "Separar Organizadores con comas", "agenda_uc_api" ),
		"add_or_remove_items" => __( "Añadir o eliminar Organizadores", "agenda_uc_api" ),
		"choose_from_most_used" => __( "Escoger entre los Organizadores más usandos", "agenda_uc_api" ),
		"not_found" => __( "No se ha encontrado Organizadores", "agenda_uc_api" ),
		"no_terms" => __( "Ningún Organizadores", "agenda_uc_api" ),
		"items_list_navigation" => __( "Navegación de la lista de Organizadores", "agenda_uc_api" ),
		"items_list" => __( "Lista de Organizadores", "agenda_uc_api" ),
	];

	$args = [
		"label" => __( "Organizadores", "agenda_uc_api" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'organizador', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "organizador",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "organizador", [ "actividad" ], $args );

	/**
	 * Taxonomy: Lugares.
	 */

	$labels = [
		"name" => __( "Lugares", "agenda_uc_api" ),
		"singular_name" => __( "Lugar", "agenda_uc_api" ),
		"menu_name" => __( "Lugares", "agenda_uc_api" ),
		"all_items" => __( "Todos los Lugares", "agenda_uc_api" ),
		"edit_item" => __( "Editar Lugar", "agenda_uc_api" ),
		"view_item" => __( "Ver Lugar", "agenda_uc_api" ),
		"update_item" => __( "Actualizar el nombre de Lugar", "agenda_uc_api" ),
		"add_new_item" => __( "Añadir nuevo Lugar", "agenda_uc_api" ),
		"new_item_name" => __( "Nombre del nuevo Lugar", "agenda_uc_api" ),
		"parent_item" => __( "Lugar superior", "agenda_uc_api" ),
		"parent_item_colon" => __( "Lugar superior", "agenda_uc_api" ),
		"search_items" => __( "Buscar Lugares", "agenda_uc_api" ),
		"popular_items" => __( "Lugares populares", "agenda_uc_api" ),
		"separate_items_with_commas" => __( "Separar Lugares con comas", "agenda_uc_api" ),
		"add_or_remove_items" => __( "Añadir o eliminar Lugares", "agenda_uc_api" ),
		"choose_from_most_used" => __( "Escoger entre los Lugares más usandos", "agenda_uc_api" ),
		"not_found" => __( "No se ha encontrado Lugares", "agenda_uc_api" ),
		"no_terms" => __( "Ningún Lugares", "agenda_uc_api" ),
		"items_list_navigation" => __( "Navegación de la lista de Lugares", "agenda_uc_api" ),
		"items_list" => __( "Lista de Lugares", "agenda_uc_api" ),
	];

	$args = [
		"label" => __( "Lugares", "agenda_uc_api" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'lugar', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "lugar",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "lugar", [ "actividad" ], $args );

	/**
	 * Taxonomy: Tipos de evento.
	 */

	$labels = [
		"name" => __( "Tipos de evento", "agenda_uc_api" ),
		"singular_name" => __( "Tipo de evento", "agenda_uc_api" ),
		"menu_name" => __( "Tipos de evento", "agenda_uc_api" ),
		"all_items" => __( "Todos los Tipos de evento", "agenda_uc_api" ),
		"edit_item" => __( "Editar Tipo de evento", "agenda_uc_api" ),
		"view_item" => __( "Ver Tipo de evento", "agenda_uc_api" ),
		"update_item" => __( "Actualizar el nombre de Tipo de evento", "agenda_uc_api" ),
		"add_new_item" => __( "Añadir nuevo Tipo de evento", "agenda_uc_api" ),
		"new_item_name" => __( "Nombre del nuevo Tipo de evento", "agenda_uc_api" ),
		"parent_item" => __( "Tipo de evento superior", "agenda_uc_api" ),
		"parent_item_colon" => __( "Tipo de evento superior", "agenda_uc_api" ),
		"search_items" => __( "Buscar Tipos de evento", "agenda_uc_api" ),
		"popular_items" => __( "Tipos de evento populares", "agenda_uc_api" ),
		"separate_items_with_commas" => __( "Separar Tipos de evento con comas", "agenda_uc_api" ),
		"add_or_remove_items" => __( "Añadir o eliminar Tipos", "agenda_uc_api" ),
		"choose_from_most_used" => __( "Escoger entre los Tipos de evento más usandos", "agenda_uc_api" ),
		"not_found" => __( "No se ha encontrado Tipos de evento", "agenda_uc_api" ),
		"no_terms" => __( "Ningún Tipos de evento", "agenda_uc_api" ),
		"items_list_navigation" => __( "Navegación de la lista de Tipos de evento", "agenda_uc_api" ),
		"items_list" => __( "Lista de Tipos de evento", "agenda_uc_api" ),
	];

	$args = [
		"label" => __( "Tipos de evento", "agenda_uc_api" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'tipo', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "tipo",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "tipo", [ "actividad" ], $args );

	/**
	 * Taxonomy: Público a los que va dirigido.
	 */

	$labels = [
		"name" => __( "Público a los que va dirigido", "agenda_uc_api" ),
		"singular_name" => __( "Público al que va dirigido.", "agenda_uc_api" ),
		"menu_name" => __( "Público a los que va dirigido", "agenda_uc_api" ),
		"all_items" => __( "Todos los Público a los que va dirigido", "agenda_uc_api" ),
		"edit_item" => __( "Editar Público al que va dirigido.", "agenda_uc_api" ),
		"view_item" => __( "Ver Público al que va dirigido.", "agenda_uc_api" ),
		"update_item" => __( "Actualizar el nombre de Público al que va dirigido.", "agenda_uc_api" ),
		"add_new_item" => __( "Añadir nuevo Público al que va dirigido.", "agenda_uc_api" ),
		"new_item_name" => __( "Nombre del nuevo Público al que va dirigido.", "agenda_uc_api" ),
		"parent_item" => __( "Público al que va dirigido. superior", "agenda_uc_api" ),
		"parent_item_colon" => __( "Público al que va dirigido. superior", "agenda_uc_api" ),
		"search_items" => __( "Buscar Público al que va dirigido.", "agenda_uc_api" ),
		"popular_items" => __( "Público al que va dirigido. populares", "agenda_uc_api" ),
		"separate_items_with_commas" => __( "Separar Público al que va dirigido. con comas", "agenda_uc_api" ),
		"add_or_remove_items" => __( "Añadir o eliminar Público al que va dirigido.", "agenda_uc_api" ),
		"choose_from_most_used" => __( "Escoger entre los Público al que va dirigido. más usandos", "agenda_uc_api" ),
		"not_found" => __( "No se ha encontrado Público al que va dirigido.", "agenda_uc_api" ),
		"no_terms" => __( "Ningún Público al que va dirigido.", "agenda_uc_api" ),
		"items_list_navigation" => __( "Navegación de la lista de Público al que va dirigido.", "agenda_uc_api" ),
		"items_list" => __( "Lista de Público al que va dirigido.", "agenda_uc_api" ),
	];

	$args = [
		"label" => __( "Público a los que va dirigido", "agenda_uc_api" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'publico', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "publico",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "publico", [ "actividad" ], $args );
}