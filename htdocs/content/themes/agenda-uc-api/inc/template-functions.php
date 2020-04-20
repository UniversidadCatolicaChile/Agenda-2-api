<?php

use Themosis\Support\Facades\Action;
use Themosis\Support\Facades\Filter;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
Filter::add('body_class', function ($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (! is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (! is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
});

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
Action::add('wp_head', function () {
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="'.esc_url(get_bloginfo('pingback_url')).'">';
    }
});

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
Action::add('after_setup_theme', function () {
    $GLOBALS['content_width'] = 640;
}, 0);


Action::add('admin_menu', function () {
  remove_menu_page('edit.php');                   //Posts
  //remove_menu_page('edit.php?post_type=page');    //Pages
  remove_menu_page('edit-comments.php');    //comments
  remove_meta_box('tagsdiv-organizador','actividad','side');
  remove_meta_box('tagsdiv-lugar','actividad','side');
  remove_meta_box('tagsdiv-tipo_de_evento','actividad','side');
  remove_meta_box('tagsdiv-tipo','actividad','side');
  remove_meta_box('tagsdiv-publico','actividad','side');

  remove_meta_box('tagsdiv-organizador','evento','side');
  remove_meta_box('tagsdiv-lugar','evento','side');
  remove_meta_box('tagsdiv-tipo_de_evento','evento','side');
  remove_meta_box('tagsdiv-tipo','evento','side');
  remove_meta_box('tagsdiv-publico','evento','side');

  remove_meta_box('tagsdiv-organizador','festival','side');
  remove_meta_box('tagsdiv-lugar','festival','side');
  remove_meta_box('tagsdiv-tipo_de_festival','festival','side');
  remove_meta_box('tagsdiv-tipo','festival','side');
  remove_meta_box('tagsdiv-publico','festival','side');
});


Action::add('acf/init', function () {
  acf_update_setting('google_api_key', 'AIzaSyBxsNQkaC6f48I3rmKwqNBXK6DooN0MsLY');
});

Filter::add('intermediate_image_sizes_advanced', function ($sizes) {
      unset( $sizes['small']); // 150px
      unset( $sizes['medium']); // 300px
      unset( $sizes['large']); // 1024px
      unset( $sizes['medium_large']); // 768px
      return $sizes;
});

Action::add('init', function () {
  foreach ( get_intermediate_image_sizes() as $size ) {
      if ( !in_array( $size, array( 'normal', 'normal_not_croped') ) ) {
          remove_image_size( $size );
      }
  }
});

Action::add('init', 'cptui_register_my_cpts');
Action::add('init', 'cptui_register_my_taxes');

function acf_json_save_point($path)
{
  $path = get_stylesheet_directory() . '/acf-json';
	return $path;

}

function acf_json_load_point($paths)
{
	unset($paths[0]);
	$paths[] = get_stylesheet_directory() . '/acf-json';
	return $paths;

}


Filter::add('acf/prepare_field/key=field_5e15ca86f2470', function ($field) {
  if ( ! current_user_can( 'update_core' ) ) {
    return false;
  }

  return $field;
});

function wpse28782_remove_menu_items() {
    if( !current_user_can( 'administrator' ) ):
        remove_menu_page( 'edit.php?post_type=evento' );
        remove_menu_page( 'edit.php?post_type=festival' );
    endif;
}

Action::add('admin_menu', 'wpse28782_remove_menu_items');

function array_msort($array, $cols)
{
    $colarr = array();
    foreach ($cols as $col => $order) {
        $colarr[$col] = array();
        foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
    }
    $eval = 'array_multisort(';
    foreach ($cols as $col => $order) {
        $eval .= '$colarr[\''.$col.'\'],'.$order.',';
    }
    $eval = substr($eval,0,-1).');';
    eval($eval);
    $ret = array();
    foreach ($colarr as $col => $arr) {
        foreach ($arr as $k => $v) {
            $k = substr($k,1);
            if (!isset($ret[$k])) $ret[$k] = $array[$k];
            $ret[$k][$col] = $array[$k][$col];
        }
    }
    return $ret;

}

function upload_field_cust($file, $post_id)
{
  require_once( ABSPATH . 'wp-admin/includes/image.php' );
  $wp_upload_dir = wp_upload_dir();
  $upload = wp_upload_bits($file["name"], null, file_get_contents($file["url"]));
  $filename = $upload['file'];
  $filetype = wp_check_filetype( basename( $filename ), null );
  $attachment = array(
    'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ),
    'post_mime_type' => $filetype['type'],
    'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
    'post_content'   => '',
    'post_status'    => 'inherit'
  );
  $attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
  $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
  wp_update_attachment_metadata( $attach_id,  $attach_data );
  return $attach_id;

}

