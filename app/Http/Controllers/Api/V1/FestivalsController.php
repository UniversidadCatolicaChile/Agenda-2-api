<?php
namespace App\Http\Controllers\Api\V1;

use App\Libraries\EOSOptimizer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use \WP_Query;

class FestivalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
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

            $meta_query_val[] = array(
                'key'     => 'datos_lugar_y_horarios_horario_desde_hasta_fecha_desde',
                'value'   => array($from, $to),
                'compare' => 'BETWEEN',
            );
            $meta_query_val[] = array(
                'key'     => 'datos_lugar_y_horarios_horario_desde_hasta_fecha_hasta',
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

            $meta_query_val[] = array(
                'key'     => 'datos_lugar_y_horarios_horario_desde_hasta_fecha_desde',
                'value'   => $from,
                'compare' => '>='
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

            $meta_query_val[] = array(
                'key'     => 'datos_lugar_y_horarios_horario_desde_hasta_fecha_hasta',
                'value'   => $to,
                'compare' => '<='
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

            $meta_query_val[] = array(
                'key'     => 'datos_lugar_y_horarios_horario_desde_hasta_fecha_desde',
                'value'   => $from,
                'compare' => '>='
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

        $tags = $request->get('tags');
        if(!empty($tags)){
            $tax_query[] = array(
                'taxonomy'     => 'post_tag',
                'field'   => 'term_id',
                'terms' => explode(',',$tags),
            );
        }

        $args_query = array('post_type' => 'actividad', 'post_status' => ['publish','future'], 'meta_query' => $meta_query,'fields' => 'ids');

        if(!empty($tax_query)){
            $args_query['tax_query']  = $tax_query;
        }
        EOSOptimizer::parseMetaQuery($args_query);
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

        $args_query = array(
            'post_type' => 'evento',
            'post_status' => ['publish','future'],
            'posts_per_page' => $limit,
            'page' => $page,
            'meta_query' => $meta_query_events,
            'fields' => 'ids'
        );
        EOSOptimizer::parseMetaQuery($args_query);
        $events = new WP_Query($args_query);


        $meta_query_festival = array('relation' => 'OR');
        if($events->have_posts()){
            while ($events->have_posts()) {
                $events->next_post();
                $meta_query_festival[] = array(
                    'key'     => 'eventos',
                    'value' => '"' . $events->post.'"',
                    'compare' => 'LIKE'
                );
            }
        }

        $args_query = array(
            'post_type' => 'festival',
            'post_status' => ['publish','future'],
            'posts_per_page' => $limit,
            'page' => $page,
            'meta_query' => $meta_query_festival
        );
        EOSOptimizer::parseMetaQuery($args_query);
        $festivals = new WP_Query($args_query);


        $festival_array = array();

        $activities_array = array();
        while($festivals->have_posts()){

            $festivals->next_post();
            $fields = get_fields($festivals->post);
            $events_array = array();
            $dates = array();
            foreach ($fields['eventos'] as $key => $event_obj) {
                $activities = get_field('actividades',$event_obj->ID);
                foreach ($activities as $key_activity => $activity_id) {
                    $fields = get_field('datos_lugar_y_horarios',$activity_id);

                    if($fields['horario']['un_dia_o_varios'] == 1){
                        if($fields['horario']['un_dia']['fecha_un_dia'] >= date_i18n('Ymd') ){
                            $dates[] = array('day'=>$fields['horario']['un_dia']['fecha_un_dia'], 'hours' => $fields['horario']['un_dia']['horas']);
                        }
                    }elseif($fields['horario']['un_dia_o_varios'] == 2){
                        if(!empty($fields['horario']['varios_dias']['fechas'])){
                            foreach ($fields['horario']['varios_dias']['fechas'] as $key_fecha => $fecha) {
                                if($fecha['dia'] >= date_i18n('Ymd') ){
                                    $dates[] = array('day'=>$fecha['dia'], 'hours' => $fecha['horas']);
                                }
                            }

                        }
                    }else{
                        if($fields['datos_lugar_y_horarios']['horario']['desde_hasta']['fecha_desde'] >= date_i18n('Ymd') or $fields['datos_lugar_y_horarios']['horario']['desde_hasta']['fecha_hasta'] <= date_i18n('Ymd') ){
                            $period = CarbonPeriod::create($fields['datos_lugar_y_horarios']['horario']['desde_hasta']['fecha_desde'], $fields['datos_lugar_y_horarios']['horario']['desde_hasta']['fecha_hasta']);
                            foreach($period as $date){
                                if($date->format("Ymd") >= date_i18n('Ymd') ){
                                    $activity['dates'][] = array('day' => $date->format("Ymd"), 'hours' => false);
                                }
                            }
                        }
                    }

                }


                $events_array[] = $event_obj->ID;
            }

            $dates = array_msort($dates, array('day'=>SORT_ASC));

            $festival = array(
                'id' => $festivals->post->ID,
                'title' => $festivals->post->post_title,
                'created_at' => $festivals->post->post_date,
                'status' => $festivals->post->post_status,
                'events' => $events_array,
                'dates' => $dates
            );

            $featured_image = get_field('imagen_principal',$festivals->post->ID);
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

                $festival['featured_image'] = $image_array;
            }

            $festival_array[] = $festival;
        }

        return new JsonResponse([
            'success' => true,
            'limit' => $limit,
            'page' => $page,
            'total_count' => $festivals->post_count,
            'max_num_pages' => $festivals->max_num_pages,
            'festivals' => $festival_array
        ],
            200);
    }

}
