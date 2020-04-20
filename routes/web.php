<?php

/**
 * Application routes.
 */
Route::prefix('api/v1')->group(function () {
  
  /*
  Login
   */
  Route::post('/login/auth', 'Api\V1\LoginController@authenticate');
  Route::get('/login/create-users', 'Api\V1\LoginController@createUsers');
  
  /*
  Post Types
  middleware('auth:api')->
  */
  Route::middleware('auth:api')->get('/activities', 'Api\V1\ActivitiesController@index');
  Route::middleware('auth:api')->get('/activities/{id}', 'Api\V1\ActivitiesController@show');
  Route::middleware('auth:api')->get('/events', 'Api\V1\EventsController@index');
  Route::middleware('auth:api')->get('/events/{id}', 'Api\V1\EventsController@show');
  Route::middleware('auth:api')->get('/festivals', 'Api\V1\FestivalsController@index');
  Route::middleware('auth:api')->get('/festivals/{id}', 'Api\V1\FestivalsController@show');

  /*
  Taxonomies
  */
  Route::middleware('auth:api')->get('/categories', 'Api\V1\CategoriesController@index');
  Route::middleware('auth:api')->get('/organizers', 'Api\V1\OrganizersController@index');
  Route::middleware('auth:api')->get('/types_of_activities', 'Api\V1\TypesController@index');
  Route::middleware('auth:api')->get('/audiences', 'Api\V1\AudiencesController@index');
  
  /*
  Documentation
   */
  Route::prefix('/doc')->group(function () {
    Route::get('/', function () { return view('doc.index');})->name('doc_index');
    Route::get('/categories', function () { return view('doc.categories');})->name('doc_categories');
    Route::get('/organizers', function () { return view('doc.organizers'); })->name('doc_organizers');
    Route::get('/types_of_activities', function () { return view('doc.types_of_activities'); })->name('doc_types_of_activities');
    Route::get('/audiences', function () { return view('doc.audiences'); })->name('doc_audiences');
    Route::get('/activities', function () { return view('doc.activities');})->name('doc_activities');
    Route::get('/events', function () { return view('doc.events');})->name('doc_events');
    Route::get('/festivals', function () { return view('doc.festivals');})->name('doc_festivals');
    Route::get('/login', function () { return view('doc.login');})->name('doc_login');
  });
  
});

Route::get('/', function () {return view('welcome');});

Route::get('singular', ['evento', function ($post, $query) {
  $fields = get_fields($post);
  $activities_array = [];
  $dates = array();
  $organizers = array();
  $audiences = array();
  $types = array();
  
  $activities_field = $fields['actividades'];


  
  $activities_query = new WP_Query(
                          array(
                                'post_type' => 'actividad',
                                'nopaging' => true,
                                'post__in' => $activities_field
                          )
                        );
  
  while($activities_query->have_posts()){
    $activity = array();
    $activities_query->next_post();
    $fields = get_fields($activities_query->post);
    $activity['id'] = $activities_query->post->ID;
    $activity['featured'] = $fields['es_destacado'];
    $activity['title'] = $activities_query->post->post_title;
    $activity['created_at'] = $activities_query->post->post_date;
    $activity['status'] = $activities_query->post->post_status;
    $activity['slug'] = $activities_query->post->post_name;
    
    if(!empty($fields['imagen_principal'])){
        $image = $fields['imagen_principal'];

        $image_array = array();
        $image_array['alt'] = $image['alt'];
        $image_array['mime_type'] = $image['modified'];
        $image_array['sizes'] = $image['sizes'];
        
        unset($image_array['sizes']['thumbnail']);
        unset($image_array['sizes']['thumbnail-width']);
        unset($image_array['sizes']['thumbnail-height']);
        unset($image_array['sizes']['medium']);
        unset($image_array['sizes']['medium-width']);
        unset($image_array['sizes']['medium-height']);
        unset($image_array['sizes']['medium_large']);
        unset($image_array['sizes']['medium_large-width']);
        unset($image_array['sizes']['medium_large-height']);
        unset($image_array['sizes']['large']);
        unset($image_array['sizes']['large-width']);
        unset($image_array['sizes']['large-height']);
        
        $activity['featured_image'] = $image_array;
    }
    
    $activity['audience'] = array();
    
    if(!empty($fields['datos_generales']['publico'])){
      foreach ($fields['datos_generales']['publico'] as $key_pub => $pub) {
        $activity['audience'][] = array('id' => $pub->term_id, 'name' => $pub->name);
        $audiences[] = array('id' => $pub->term_id, 'name' => $pub->name);
      }
    }
    
    if(!empty($fields['datos_generales']['organizador'])){
      $organizers[] = array('id' => $fields['datos_generales']['organizador']->term_id, 'name' => $fields['datos_generales']['organizador']->name);
      $activity['organizers'][] = array('id' => $fields['datos_generales']['organizador']->term_id, 'name' => $fields['datos_generales']['organizador']->name);
    }
    
    if(!empty($fields['datos_generales']['tipo'])){
      $activity['type'][] = array('id' => $fields['datos_generales']['tipo']->term_id, 'name' => $fields['datos_generales']['tipo']->name);
      $types[] = array('id' => $fields['datos_generales']['tipo']->term_id, 'name' => $fields['datos_generales']['tipo']->name);
    }
    
    $activity['place'] = array();
    
    if(!empty($fields['datos_lugar_y_horarios']['lugar'])){
      if($fields['datos_lugar_y_horarios']['lugar']['es_otro_lugar']){
        $activity['place']['name'] = $fields['datos_lugar_y_horarios']['lugar']['otro_lugar_text'];
        $activity['place']['addres'] = $fields['datos_lugar_y_horarios']['lugar']['ubicacion']['address'];
        $activity['place']['coordinates'] = array( 'lat' => $fields['datos_lugar_y_horarios']['lugar']['ubicacion']['lat'], 'lng' => $fields['datos_lugar_y_horarios']['lugar']['ubicacion']['lng']);
      }else{
        if(!empty($fields['datos_lugar_y_horarios']['lugar']['lugar'])){
          $ubicacion = get_field('ubicacion',$fields['datos_lugar_y_horarios']['lugar']['lugar']->term_id);
          $activity['place']['name'] = $fields['datos_lugar_y_horarios']['lugar']['lugar']->name;
          if($ubicacion){
            $activity['place']['addres'] = $ubicacion['address'];
            $activity['place']['coordinates'] = array( 'lat' => $ubicacion['lat'], 'lng' => $ubicacion['lng']);
          }
          
        }
      }
    }
    
    $activity['dates'] = array();
    
    if(!empty($fields['datos_lugar_y_horarios']['horario'])){
      if($fields['datos_lugar_y_horarios']['horario']['un_dia_o_varios'] == 1){
        $activity['dates'][] = array('day'=>$fields['datos_lugar_y_horarios']['horario']['un_dia']['fecha_un_dia'], 'hours' => $fields['datos_lugar_y_horarios']['horario']['un_dia']['horas']);
        $dates[] = array('day'=>$fields['datos_lugar_y_horarios']['horario']['un_dia']['fecha_un_dia'], 'hours' => $fields['datos_lugar_y_horarios']['horario']['un_dia']['horas']);
      }else{
        if(!empty($fields['datos_lugar_y_horarios']['horario']['varios_dias']['fechas'])){
          foreach ($fields['datos_lugar_y_horarios']['horario']['varios_dias']['fechas'] as $key_fecha => $fecha) {
            $activity['dates'][] = array('day'=>$fecha['dia'], 'hours' => $fecha['horas']);
            $dates[] = array('day'=>$fecha['dia'], 'hours' => $fecha['horas']);
          }
          
        }
      }
    }
        
    $activities_array[] = $activity;
    
    $audiences = array_map("unserialize", array_unique(array_map("serialize", $audiences)));
    $organizers = array_map("unserialize", array_unique(array_map("serialize", $organizers)));
    $types = array_map("unserialize", array_unique(array_map("serialize", $types)));
    
  }
  
  $dates = array_msort($dates, array('day'=>SORT_ASC));
  return view('event.single', [
                                'post' => $post, 
                                'fields' => get_fields($post), 
                                'audiences' => $audiences,
                                'organizers' => $organizers,
                                'types' => $types,
                                'dates' => $dates,
                                'activities' => $activities_array
                              ]);
}]);
