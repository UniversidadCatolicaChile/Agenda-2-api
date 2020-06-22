<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use \WP_Query;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        add_filter('posts_where', function($where){
          $where = str_replace("meta_key = 'datos_lugar_y_horarios_horario_varios_dias_fechas_$", "meta_key LIKE 'datos_lugar_y_horarios_horario_varios_dias_fechas_%", $where);
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
                                  'key'     => 'datos_lugar_y_horarios_horario_un_dia_fecha_un_dia',
                                  'value'   => array($from, $to),
                                  'compare' => 'BETWEEN',
          );
          
          $meta_query_val[] = array(
                                  'key'     => 'datos_lugar_y_horarios_horario_varios_dias_fechas_$_dia',
                                  'value'   => array($from, $to),
                                  'compare' => 'BETWEEN',
          );
          
        }elseif(!empty($from)){
          $meta_query_val[] = array(
                                  'key'     => 'datos_lugar_y_horarios_horario_un_dia_fecha_un_dia',
                                  'value'   => $from,
                                  'compare' => '>=',
          );
          
          $meta_query_val[] = array(
                                  'key'     => 'datos_lugar_y_horarios_horario_varios_dias_fechas_$_dia',
                                  'value'   => $from,
                                  'compare' => '>=',
          );
        }elseif (!empty($to)) {
          $meta_query_val[] = array(
                                  'key'     => 'datos_lugar_y_horarios_horario_un_dia_fecha_un_dia',
                                  'value'   => $to,
                                  'compare' => '<=',
          );
          
          $meta_query_val[] = array(
                                  'key'     => 'datos_lugar_y_horarios_horario_varios_dias_fechas_$_dia',
                                  'value'   => $to,
                                  'compare' => '<=',
          );
        }else{
          $today = Carbon::now();
          
          $from = $today->format('Ymd');
          $meta_query_val[] = array(
                                  'key'     => 'datos_lugar_y_horarios_horario_un_dia_fecha_un_dia',
                                  'value'   => $from,
                                  'compare' => '>=',
          );
          
          $meta_query_val[] = array(
                                  'key'     => 'datos_lugar_y_horarios_horario_varios_dias_fechas_$_dia',
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

        $keywords = $request->get('keywords');
        if($keywords){
          $keywords = explode(',',$keywords);
          if(!empty($keywords)){
            foreach($keywords as $key => $word){
              if(trim($word) != ''){
                $meta_query[] = array(
                    'key'     => 'datos_generales_keywords',
                    'value'   => '"'.$word.'"',
                    'compare' => 'LIKE',
                );
              }
            }
          }
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

        $args_query = array(
                              'post_type' => 'actividad', 
                              'posts_per_page' => $limit,
                              'paged' => $page,
                              'meta_query' => $meta_query);

        if(!empty($tax_query)){
          $args_query['tax_query']  = $tax_query;
        }

        $activities = new WP_Query($args_query);
        
        $activities_array = array();
        

        
        if($activities->have_posts()){
          while($activities->have_posts()){
            $activity = array();
            $activities->next_post();
            $fields = get_fields($activities->post);
            $activity['id'] = $activities->post->ID;
            if(!isset($fields['es_destacado'])){
              $activity['featured'] = 0;
            }else{
              $activity['featured'] = $fields['es_destacado'];
            }
            $activity['title'] = $activities->post->post_title;
            $activity['created_at'] = $activities->post->post_date;
            $activity['status'] = $activities->post->post_status;
            $activity['slug'] = $activities->post->post_name;
            
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
              }
            }
            
            if(!empty($fields['datos_generales']['organizador'])){
              $activity['organizers'][] = array('id' => $fields['datos_generales']['organizador']->term_id, 'name' => $fields['datos_generales']['organizador']->name);
            }
            
            if(!empty($fields['datos_generales']['tipo'])){
              $activity['type'][] = array('id' => $fields['datos_generales']['tipo']->term_id, 'name' => $fields['datos_generales']['tipo']->name);
            }


            if(!empty($fields['datos_generales']['keywords'])){
                $activity['keywords'][] = $fields['datos_generales']['keywords'];
            }
            
            $activity['place'] = array();
            
            if(!empty($fields['datos_lugar_y_horarios']['lugar'])){
              if($fields['datos_lugar_y_horarios']['lugar']['es_otro_lugar']){
                $activity['place']['name'] = $fields['datos_lugar_y_horarios']['lugar']['otro_lugar_text'];
                $activity['place']['addres'] = $fields['datos_lugar_y_horarios']['lugar']['ubicacion']['address'];
                $activity['place']['coordinates'] = array( 'lat' => $fields['datos_lugar_y_horarios']['lugar']['ubicacion']['lat'], 'lng' => $fields['datos_lugar_y_horarios']['lugar']['ubicacion']['lng']);
                $activity['place']['detail'] = $fields['datos_lugar_y_horarios']['lugar']['detalle_de_lugar'];
              }else{
                if(!empty($fields['datos_lugar_y_horarios']['lugar']['lugar'])){
                  $ubicacion = get_field('ubicacion',$fields['datos_lugar_y_horarios']['lugar']['lugar']);
                  $activity['place']['name'] = $fields['datos_lugar_y_horarios']['lugar']['lugar']->name;
                  if($ubicacion){
                    $activity['place']['addres'] = $ubicacion['address'];
                    $activity['place']['coordinates'] = array( 'lat' => $ubicacion['lat'], 'lng' => $ubicacion['lng']);
                  }
                  $activity['place']['detail'] = $fields['datos_lugar_y_horarios']['lugar']['detalle_de_lugar'];
                  
                }
              }
            }
            
            $activity['dates'] = array();
            
            if(!empty($fields['datos_lugar_y_horarios']['horario'])){
              if($fields['datos_lugar_y_horarios']['horario']['un_dia_o_varios'] == 1){
                if($fields['datos_lugar_y_horarios']['horario']['un_dia']['fecha_un_dia'] >= date_i18n('Ymd') ){
                  $activity['dates'][] = array('day'=>$fields['datos_lugar_y_horarios']['horario']['un_dia']['fecha_un_dia'], 'hours' => $fields['datos_lugar_y_horarios']['horario']['un_dia']['horas']);
                }
              }else{
                if(!empty($fields['datos_lugar_y_horarios']['horario']['varios_dias']['fechas'])){
                  foreach ($fields['datos_lugar_y_horarios']['horario']['varios_dias']['fechas'] as $key_fecha => $fecha) {
                    if($fecha['dia'] >= date_i18n('Ymd') ){
                      $activity['dates'][] = array('day'=>$fecha['dia'], 'hours' => $fecha['horas']);
                    }
                  }
                  
                }
              }
            }
            $activities_array[] = $activity;
            
          }
        }
        
        return new JsonResponse([
                                  'success' => true, 
                                  'limit' => $limit, 
                                  'page' => $page, 
                                  'total_count' => $activities->post_count, 
                                  'max_num_pages' => $activities->max_num_pages, 
                                  'activities' => $activities_array
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
      
      
      $activity = array();
      $activity_object = get_post($id);
      if(!$activity_object){
        $activity_object = get_page_by_path($id, OBJECT, 'actividad' );
      }
      $fields = get_fields($activity_object);
      $activity['id'] = $activity_object->ID;
      
      if(!isset($fields['es_destacado'])){
        $activity['featured'] = 0;
      }else{
        $activity['featured'] = $fields['es_destacado'];
      }
      
      $activity['title'] = $activity_object->post_title;
      $activity['content'] = $fields['descripcion'];
      $activity['created_at'] = $activity_object->post_date;
      $activity['updated_at'] = $activity_object->post_modified;
      $activity['status'] = $activity_object->post_status;
      $activity['slug'] = $activity_object->post_name;
      
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
      
      $images = array();
      if(!empty($fields['imagenes'])){
        foreach ($fields['imagenes'] as $key_image => $image) {
          $image_array = array();
          $image_array['id'] = $image['ID'];
          $image_array['title'] = $image['title'];
          $image_array['alt'] = $image['alt'];
          $image_array['created_at'] = $image['date'];
          $image_array['updated_at'] = $image['modified'];
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
          
          $images[] = $image_array;
        }
      }
      
      $activity['images'] = $images;
      
      $activity['contact_info'] = array();
      $activity['contact_info']['emails'] = array();
      $activity['contact_info']['phone_numbers'] = array();
      
      if(!empty($fields['informacion_de_contacto'])){
        
        if(!empty($fields['informacion_de_contacto']['emails'])){
          foreach ($fields['informacion_de_contacto']['emails'] as $key_mail => $mail) {
            $activity['contact_info']['emails'][] = $mail['email'];
          }
        }
        
        if(!empty($fields['informacion_de_contacto']['telefonos'])){
          foreach ($fields['informacion_de_contacto']['telefonos'] as $key_phone => $phone) {
            $activity['contact_info']['phone_numbers'][] = '+56'.$phone['telefono'];
          }
        }
      }
      
      $activity['pricing_info'] = array();
      
      if($fields['gratuito_o_pagado'] == 0){
        $activity['pricing_info']['is_free'] = true;
        $activity['pricing_info']['url'] = $fields['valores']['url'];
        $activity['pricing_info']['agreements'] = $fields['convenios'];
      }else{
        $activity['pricing_info']['is_free'] = false;
        $activity['pricing_info']['from'] = $fields['valores']['desde'];
        $activity['pricing_info']['to'] = $fields['valores']['hasta'];
        $activity['pricing_info']['url'] = $fields['valores']['url'];
        $activity['pricing_info']['agreements'] = $fields['convenios'];
      }
      
      
      $activity['audience'] = array();
      
      if(!empty($fields['datos_generales']['publico'])){
        foreach ($fields['datos_generales']['publico'] as $key_pub => $pub) {
          $activity['audience'][] = array('id' => $pub->term_id, 'name' => $pub->name);
        }
      }
      
      if(!empty($fields['datos_generales']['organizador'])){
        $activity['organizers'][] = array('id' => $fields['datos_generales']['organizador']->term_id, 'name' => $fields['datos_generales']['organizador']->name);
      }
      
      if(!empty($fields['datos_generales']['tipo'])){
        $activity['type'][] = array('id' => $fields['datos_generales']['tipo']->term_id, 'name' => $fields['datos_generales']['tipo']->name);
      }
      
      $activity['place'] = array();
      
      if(!empty($fields['datos_lugar_y_horarios']['lugar'])){
        if($fields['datos_lugar_y_horarios']['lugar']['es_otro_lugar']){
          $activity['place']['name'] = $fields['datos_lugar_y_horarios']['lugar']['otro_lugar_text'];
          $activity['place']['addres'] = $fields['datos_lugar_y_horarios']['lugar']['ubicacion']['address'];
          $activity['place']['coordinates'] = array( 'lat' => $fields['datos_lugar_y_horarios']['lugar']['ubicacion']['lat'], 'lng' => $fields['datos_lugar_y_horarios']['lugar']['ubicacion']['lng']);
          $activity['place']['detail'] = $fields['datos_lugar_y_horarios']['lugar']['detalle_de_lugar'];
        }else{
          if(!empty($fields['datos_lugar_y_horarios']['lugar']['lugar'])){
            $ubicacion = get_field('ubicacion',$fields['datos_lugar_y_horarios']['lugar']['lugar']);
            $activity['place']['name'] = $fields['datos_lugar_y_horarios']['lugar']['lugar']->name;
            if($ubicacion){
              $activity['place']['addres'] = $ubicacion['address'];
              $activity['place']['coordinates'] = array( 'lat' => $ubicacion['lat'], 'lng' => $ubicacion['lng']);
            }
            $activity['place']['detail'] = $fields['datos_lugar_y_horarios']['lugar']['detalle_de_lugar'];
            
          }
        }
      }
      
      $activity['dates'] = array();
      
      if(!empty($fields['datos_lugar_y_horarios']['horario'])){
        if($fields['datos_lugar_y_horarios']['horario']['un_dia_o_varios'] == 1){
          $activity['dates'][] = array('day'=>$fields['datos_lugar_y_horarios']['horario']['un_dia']['fecha_un_dia'], 'hours' => $fields['datos_lugar_y_horarios']['horario']['un_dia']['horas']);
        }else{
          if(!empty($fields['datos_lugar_y_horarios']['horario']['varios_dias']['fechas'])){
            foreach ($fields['datos_lugar_y_horarios']['horario']['varios_dias']['fechas'] as $key_fecha => $fecha) {
              $activity['dates'][] = array('day'=>$fecha['dia'], 'hours' => $fecha['horas']);
            }
            
          }
        }
      }
      
      
      return new JsonResponse(['success' => true, 'activity' => $activity], 200);
    }

}
