<?php
use App\Customer;
use Themosis\Support\Facades\Action;
use Themosis\Support\Facades\Filter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
  $attach_id = false;
  try {
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
  } catch (Exception $e) {
    return $attach_id;
  }
  return $attach_id;
}

function set_readonly( $field ) {
  $field['disabled'] = 1;
  return $field;
}

function set_other_readonly( $field ) {
  global $post;
  if($post){
    if($post->post_status == 'publish'){
      $field['disabled'] = 1;
    }
  }
  return $field;
}

add_filter('acf/load_field/key=field_5ee8cbfe0fca1', 'set_readonly');
add_filter('acf/load_field/key=field_5ee8cbd50fc9f', 'set_other_readonly');
add_filter('acf/load_field/key=field_5ee8cbe00fca0', 'set_other_readonly');



#add_action( 'draft_to_publish', 'create_api_user', 10, 1);

add_action('acf/save_post', 'create_api_user');

function create_api_user($post_id){
  $post = get_post($post_id);
  if ( 'usuarios_api' == $post->post_type ) {
    if(get_post_status($post_id) == 'publish'){
      $email = trim(strtolower(get_field('correo',$post_id)));
      $password = get_field('contrasena',$post_id);
      $user = Customer::where('email', '=', $email)->first();

      if(!$user){
          $token = Str::random(80);
          $user = Customer::create([
              'name' => get_the_title($post_id),
              'email' => $email,
              'password' => Hash::make($password),
              'api_token' => hash('sha256', $token)
          ]);

          $user->forceFill([
              'api_token' => hash('sha256', $token),
          ])->save();

          update_field('token',$token,$post_id);
      }else{
          $token = trim(get_field('token',$post_id));
          $user->forceFill([
              'api_token' => hash('sha256', $token),
              'email' => $email,
              'password' => Hash::make($password),
          ])->save();
      }
    }
  }
}

add_action( 'before_delete_post', 'remove_user_api' );
function remove_user_api( $post_id ){
    global $post_type;
    if ( $post_type != 'usuarios_api' ) return;
    $email = trim(strtolower(get_field('correo',$post_id)));
    $user = Customer::where('email', '=', $email)->first();
    if($user){
      $user->delete();
    }
}