<?php 
function cptui_register_my_cpts() {

	/**
	 * Post Type: Actividades.
	 */

	$labels = [
		"name" => __( "Actividades", "agenda_uc_api" ),
		"singular_name" => __( "Actividad", "agenda_uc_api" ),
		"menu_name" => __( "Actividades", "agenda_uc_api" ),
		"all_items" => __( "Todas las Actividades", "agenda_uc_api" ),
		"add_new" => __( "Agregar nueva", "agenda_uc_api" ),
		"add_new_item" => __( "Agregar nueva Actividad", "agenda_uc_api" ),
		"edit_item" => __( "Editar Actividad", "agenda_uc_api" ),
		"new_item" => __( "Nueva Actividad", "agenda_uc_api" ),
		"view_item" => __( "Ver Actividad", "agenda_uc_api" ),
		"view_items" => __( "Ver Actividades", "agenda_uc_api" ),
		"search_items" => __( "Buscar Actividades", "agenda_uc_api" ),
		"not_found" => __( "Actividad no encontrada", "agenda_uc_api" ),
		"not_found_in_trash" => __( "Actividad no encontrada en la papelera", "agenda_uc_api" ),
		"parent" => __( "Padrea de Actividad:", "agenda_uc_api" ),
		"featured_image" => __( "Featured image for this Actividad", "agenda_uc_api" ),
		"set_featured_image" => __( "Set featured image for this Actividad", "agenda_uc_api" ),
		"remove_featured_image" => __( "Remove featured image for this Actividad", "agenda_uc_api" ),
		"use_featured_image" => __( "Use as featured image for this Actividad", "agenda_uc_api" ),
		"archives" => __( "Actividad archives", "agenda_uc_api" ),
		"insert_into_item" => __( "Insert into Actividad", "agenda_uc_api" ),
		"uploaded_to_this_item" => __( "Upload to this Actividad", "agenda_uc_api" ),
		"filter_items_list" => __( "Filter Actividades list", "agenda_uc_api" ),
		"items_list_navigation" => __( "Actividades list navigation", "agenda_uc_api" ),
		"items_list" => __( "Actividades list", "agenda_uc_api" ),
		"attributes" => __( "Actividades attributes", "agenda_uc_api" ),
		"name_admin_bar" => __( "Actividad", "agenda_uc_api" ),
		"item_published" => __( "Actividad published", "agenda_uc_api" ),
		"item_published_privately" => __( "Actividad published privately.", "agenda_uc_api" ),
		"item_reverted_to_draft" => __( "Actividad reverted to draft.", "agenda_uc_api" ),
		"item_scheduled" => __( "Actividad scheduled", "agenda_uc_api" ),
		"item_updated" => __( "Actividad updated.", "agenda_uc_api" ),
		"parent_item_colon" => __( "Padrea de Actividad:", "agenda_uc_api" ),
	];

	$args = [
		"label" => __( "Actividades", "agenda_uc_api" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "actividad", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title" ],
	];

	register_post_type( "actividad", $args );

	/**
	 * Post Type: Eventos.
	 */

	$labels = [
		"name" => __( "Eventos", "agenda_uc_api" ),
		"singular_name" => __( "Evento", "agenda_uc_api" ),
		"menu_name" => __( "Eventos", "agenda_uc_api" ),
		"all_items" => __( "Todos los Eventos", "agenda_uc_api" ),
		"add_new" => __( "Añadir nuevo", "agenda_uc_api" ),
		"add_new_item" => __( "Añadir nuevo Evento", "agenda_uc_api" ),
		"edit_item" => __( "Editar Evento", "agenda_uc_api" ),
		"new_item" => __( "Nuevo Evento", "agenda_uc_api" ),
		"view_item" => __( "Ver Evento", "agenda_uc_api" ),
		"view_items" => __( "Ver Eventos", "agenda_uc_api" ),
		"search_items" => __( "Buscar Eventos", "agenda_uc_api" ),
		"not_found" => __( "No se ha encontrado Eventos", "agenda_uc_api" ),
		"not_found_in_trash" => __( "No se han encontrado Eventos en la papelera", "agenda_uc_api" ),
		"parent" => __( "Evento superior", "agenda_uc_api" ),
		"featured_image" => __( "Imagen destacada para Evento", "agenda_uc_api" ),
		"set_featured_image" => __( "Establece una imagen destacada para Evento", "agenda_uc_api" ),
		"remove_featured_image" => __( "Eliminar la imagen destacada de Evento", "agenda_uc_api" ),
		"use_featured_image" => __( "Usar como imagen destacada de Evento", "agenda_uc_api" ),
		"archives" => __( "Archivos de Evento", "agenda_uc_api" ),
		"insert_into_item" => __( "Insertar en Evento", "agenda_uc_api" ),
		"uploaded_to_this_item" => __( "Subir a Evento", "agenda_uc_api" ),
		"filter_items_list" => __( "Filtrar la lista de Eventos", "agenda_uc_api" ),
		"items_list_navigation" => __( "Navegación de la lista de Eventos", "agenda_uc_api" ),
		"items_list" => __( "Lista de Eventos", "agenda_uc_api" ),
		"attributes" => __( "Atributos de Eventos", "agenda_uc_api" ),
		"name_admin_bar" => __( "Evento", "agenda_uc_api" ),
		"item_published" => __( "Evento publicado", "agenda_uc_api" ),
		"item_published_privately" => __( "Evento publicado como privado.", "agenda_uc_api" ),
		"item_reverted_to_draft" => __( "Evento devuelto a borrador.", "agenda_uc_api" ),
		"item_scheduled" => __( "Evento programado", "agenda_uc_api" ),
		"item_updated" => __( "Evento actualizado.", "agenda_uc_api" ),
		"parent_item_colon" => __( "Evento superior", "agenda_uc_api" ),
	];

	$args = [
		"label" => __( "Eventos", "agenda_uc_api" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "evento", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title" ],
	];

	register_post_type( "evento", $args );

	/**
	 * Post Type: Festivales.
	 */

	$labels = [
		"name" => __( "Festivales", "agenda_uc_api" ),
		"singular_name" => __( "Festival", "agenda_uc_api" ),
		"menu_name" => __( "Festivales", "agenda_uc_api" ),
		"all_items" => __( "Todos los Festivales", "agenda_uc_api" ),
		"add_new" => __( "Añadir nuevo", "agenda_uc_api" ),
		"add_new_item" => __( "Añadir nuevo Festival", "agenda_uc_api" ),
		"edit_item" => __( "Editar Festival", "agenda_uc_api" ),
		"new_item" => __( "Nuevo Festival", "agenda_uc_api" ),
		"view_item" => __( "Ver Festival", "agenda_uc_api" ),
		"view_items" => __( "Ver Festivales", "agenda_uc_api" ),
		"search_items" => __( "Buscar Festivales", "agenda_uc_api" ),
		"not_found" => __( "No se ha encontrado Festivales", "agenda_uc_api" ),
		"not_found_in_trash" => __( "No se han encontrado Festivales en la papelera", "agenda_uc_api" ),
		"parent" => __( "Festival superior", "agenda_uc_api" ),
		"featured_image" => __( "Imagen destacada para Festival", "agenda_uc_api" ),
		"set_featured_image" => __( "Establece una imagen destacada para Festival", "agenda_uc_api" ),
		"remove_featured_image" => __( "Eliminar la imagen destacada de Festival", "agenda_uc_api" ),
		"use_featured_image" => __( "Usar como imagen destacada de Festival", "agenda_uc_api" ),
		"archives" => __( "Archivos de Festival", "agenda_uc_api" ),
		"insert_into_item" => __( "Insertar en Festival", "agenda_uc_api" ),
		"uploaded_to_this_item" => __( "Subir a Festival", "agenda_uc_api" ),
		"filter_items_list" => __( "Filtrar la lista de Festivales", "agenda_uc_api" ),
		"items_list_navigation" => __( "Navegación de la lista de Festivales", "agenda_uc_api" ),
		"items_list" => __( "Lista de Festivales", "agenda_uc_api" ),
		"attributes" => __( "Atributos de Festivales", "agenda_uc_api" ),
		"name_admin_bar" => __( "Festival", "agenda_uc_api" ),
		"item_published" => __( "Festival publicado", "agenda_uc_api" ),
		"item_published_privately" => __( "Festival publicado como privado.", "agenda_uc_api" ),
		"item_reverted_to_draft" => __( "Festival devuelto a borrador.", "agenda_uc_api" ),
		"item_scheduled" => __( "Festival programado", "agenda_uc_api" ),
		"item_updated" => __( "Festival actualizado.", "agenda_uc_api" ),
		"parent_item_colon" => __( "Festival superior", "agenda_uc_api" ),
	];

	$args = [
		"label" => __( "Festivales", "agenda_uc_api" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "festival", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title" ],
	];

	register_post_type( "festival", $args );
}