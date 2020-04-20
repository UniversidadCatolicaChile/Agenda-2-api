<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use \WP_Query;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      add_filter('posts_where', function($where){
        $where = str_replace("meta_key = 'datos_lugar_y_horarios_horario_varios_dias_Fechas_$", "meta_key LIKE 'datos_lugar_y_horarios_horario_varios_dias_Fechas_%", $where);
        return $where;
      });
      
      $meta_query = array('relation' => 'AND');

      $from = $request->get('from');
      $to = $request->get('to');
      $featured = $request->get('featured');
      $limit = $request->get('limit'); 
      $page = $request->get('page'); 
      
      if(empty($limit)){
        $limit = 10;
        
      }else{
        if($limit > 40){
          $limit = 10;
        }
      }
      
      if(empty($page)){
        $page = 1;
      }
      
      $meta_query_val = array('relation' => 'OR');
      
      if(!empty($from) && !empty($to)){
        
        $meta_query_val[] = array(
                                'key'     => 'datos_lugar_y_horarios_horario_un_dia_fecha_un_día',
                                'value'   => array($from, $to),
                                'compare' => 'BETWEEN',
        );
        
        $meta_query_val[] = array(
                                'key'     => 'datos_lugar_y_horarios_horario_varios_dias_Fechas_$_dia',
                                'value'   => array($from, $to),
                                'compare' => 'BETWEEN',
        );
        
      }elseif(!empty($from)){
        $meta_query_val[] = array(
                                'key'     => 'datos_lugar_y_horarios_horario_un_dia_fecha_un_día',
                                'value'   => $from,
                                'compare' => '>=',
        );
        
        $meta_query_val[] = array(
                                'key'     => 'datos_lugar_y_horarios_horario_varios_dias_Fechas_$_dia',
                                'value'   => $from,
                                'compare' => '>=',
        );
      }elseif (!empty($to)) {
        $meta_query_val[] = array(
                                'key'     => 'datos_lugar_y_horarios_horario_un_dia_fecha_un_día',
                                'value'   => $to,
                                'compare' => '<=',
        );
        
        $meta_query_val[] = array(
                                'key'     => 'datos_lugar_y_horarios_horario_varios_dias_Fechas_$_dia',
                                'value'   => $to,
                                'compare' => '<=',
        );
      }else{
        $today = Carbon::now();
        
        $from = $today->format('Ymd');
        $meta_query_val[] = array(
                                'key'     => 'datos_lugar_y_horarios_horario_un_dia_fecha_un_día',
                                'value'   => $from,
                                'compare' => '>=',
        );
        
        $meta_query_val[] = array(
                                'key'     => 'datos_lugar_y_horarios_horario_varios_dias_Fechas_$_dia',
                                'value'   => $from,
                                'compare' => '>=',
        );
      }
      
      if(count($meta_query_val) > 1){
        $meta_query[] = $meta_query_val;
      }
      
      
      if(!empty($featured)){
        $meta_query[] =  array(
                                'key'     => 'es_destacado',
                                'value'   => $featured,
                                'compare' => '=',
        );
      }
      
      $tax_query = array();
      
      $audience = $request->get('audience');
      if(!empty($audience)){
        $tax_query[] = array(
          'taxonomy'     => 'publico',
          'field'   => 'term_id',
          'terms' => explode(',',$audience),
        );
      }
      
      $organizers = $request->get('organizers');
      if(!empty($organizers)){
        $tax_query[] = array(
          'taxonomy'     => 'organizador',
          'field'   => 'term_id',
          'terms' => explode(',',$organizers),
        );
      }
      
      $types_of_activities = $request->get('types_of_activities');
      if(!empty($types_of_activities)){
        $tax_query[] = array(
          'taxonomy'     => 'tipo',
          'field'   => 'term_id',
          'terms' => explode(',',$types_of_activities),
        );
      }
      
      $categories = $request->get('categories');
      if(!empty($categories)){
        $tax_query[] = array(
          'taxonomy'     => 'category',
          'field'   => 'term_id',
          'terms' => explode(',',$categories),
        );
      }
      
      $tags = $request->get('tags');
      if(!empty($tags)){
        $tax_query[] = array(
          'taxonomy'     => 'post_tag',
          'field'   => 'term_id',
          'terms' => explode(',',$tags),
        );
      }

      $args_query = array('post_type' => 'actividad', 'meta_query' => $meta_query,'fields' => 'ids');

      if(!empty($tax_query)){
        $args_query['tax_query']  = $tax_query;
      }
      
      $activities = new WP_Query($args_query);
      
      
      
      $meta_query_events = array('relation' => 'OR');
      
      if($activities->have_posts()){
        while ($activities->have_posts()) {
          $activities->next_post();
          $meta_query_events[] = array(
                                  'key'     => 'actividades',
                                  'value' => '"' . $activities->post.'"',
                                  'compare' => 'LIKE'
          );
        }
      }
      
      
      
      $events = new WP_Query(
                              array(
                                    'post_type' => 'evento',
                                    'posts_per_page' => $limit,
                                    'page' => $page,
                                    'meta_query' => $meta_query_events
                              )
                            );
      
      
      $events_array = array();
      $activities_array = array();
      while($events->have_posts()){
        $events->next_post();
        $activities = get_field('actividades',$events->post->ID);
        $dates = array();
        foreach ($activities as $key_activity => $activity_id) {
          $fields = get_field('datos_lugar_y_horarios',$activity_id);
          if($fields['horario']['un_dia_o_varios'] == 1){
            if($fields['horario']['un_dia']['fecha_un_dia'] >= date_i18n('Ymd') ){
              $dates[] = array('day'=>$fields['horario']['un_dia']['fecha_un_dia'], 'hours' => $fields['horario']['un_dia']['horas']);
            }
          }else{
            if(!empty($fields['horario']['varios_dias']['fechas'])){
              foreach ($fields['horario']['varios_dias']['fechas'] as $key_fecha => $fecha) {
                if($fecha['dia'] >= date_i18n('Ymd') ){
                  $dates[] = array('day'=>$fecha['dia'], 'hours' => $fecha['horas']);
                }
              }
              
            }
          }
        }
        
        $dates = array_msort($dates, array('day'=>SORT_ASC));
        $event = array(
                                'id' => $events->post->ID,
                                'title' => $events->post->post_title,
                                'created_at' => $events->post->post_date,
                                'status' => $events->post->post_status,
                                'activities' => $activities,
                                'dates' => $dates
        ); 
                              
        $featured_image = get_field('imagen_principal',$events->post->ID);            
        if(!empty($featured_image)){
            $image = $featured_image;

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
            
            $event['featured_image'] = $image_array;
        }
        
        $events_array[] = $event;
        
      }

      return new JsonResponse([
                                'success' => true, 
                                'limit' => $limit, 
                                'page' => $page, 
                                'total_count' => $events->post_count, 
                                'max_num_pages' => $events->max_num_pages, 
                                'events' => $events_array
                              ], 
                              200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $event_ob = get_post($id);
      $activities = get_field('actividades',$event_ob->ID);
      $dates = array();
      foreach ($activities as $key_activity => $activity_id) {
        $fields = get_field('datos_lugar_y_horarios',$activity_id);
        if($fields['horario']['un_dia_o_varios'] == 1){
          if($fields['horario']['un_dia']['fecha_un_dia'] >= date_i18n('Ymd') ){
            $dates[] = array('day'=>$fields['horario']['un_dia']['fecha_un_dia'], 'hours' => $fields['horario']['un_dia']['horas']);
          }
        }else{
          if(!empty($fields['horario']['varios_dias']['fechas'])){
            foreach ($fields['horario']['varios_dias']['fechas'] as $key_fecha => $fecha) {
              if($fecha['dia'] >= date_i18n('Ymd') ){
                $dates[] = array('day'=>$fecha['dia'], 'hours' => $fecha['horas']);
              }
            }
            
          }
        }
      }
      
      $dates = array_msort($dates, array('day'=>SORT_ASC));
      $event = array(
                              'id' => $event_ob->ID,
                              'title' => $event_ob->post_title,
                              'created_at' => $event_ob->post_date,
                              'status' => $event_ob->post_status,
                              'activities' => $activities,
                              'dates' => $dates
      ); 
                            
      $featured_image = get_field('imagen_principal',$event_ob->ID);            
      if(!empty($featured_image)){
          $image = $featured_image;

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
          
          $event['featured_image'] = $image_array;
      }
      
      return new JsonResponse(['success' => true, 'event' => $event], 200);
    }

}
