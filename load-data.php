<?php
# No need for the template engine
define( 'WP_USE_THEMES', false );
# Load WordPress Core
// Assuming we're in a subdir: "~/wp-content/plugins/current_dir"
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

require web_path('cms/wp-load.php');
require web_path('cms/wp-admin/includes/image.php' );
require web_path('cms/wp-admin/includes/file.php' );
require web_path('cms/wp-admin/includes/media.php' );
/* Template Name: JSON Eventos */

$posts = file_get_contents("https://agenda.uc.cl/json-data/?passcode=g5g3yLqVsduQ6f8p");
$json_posts = json_decode($posts);

echo "<pre>";
for ($i=1; $i <= $json_posts->max_num_pages; $i++) {
    $posts_new = file_get_contents("https://agenda.uc.cl/json-data/?passcode=g5g3yLqVsduQ6f8p&page={$i}");
    $posts_new_json = json_decode($posts_new);

    /*
	{
			"post": {
				"ID": 113673,
				"post_author": "142",
				"post_date": "2020-03-10 00:01:48",
				"post_date_gmt": "2020-03-10 04:01:48",
				"post_date_until": "2020-03-12 13:00:48",
				"post_date_runtil": "2020-03-12 13:00:48",
				"rrule": "",
				"alldaylong": "0",
				"post_content": "<p>Los postulantes nuevos convocados podr\u00e1n realizar su matr\u00edcula entre el 10 y el 12 de marzo. Seleccionados(as) v\u00eda admisi\u00f3n especial y equidad lo har\u00e1n s\u00f3lo de manera presencial en Casa Central.\u00a0 Para v\u00eda admisi\u00f3n PSU, ser\u00e1 en dos etapas: primero online, luego presencial para formalizar su ingreso, en el campus y fecha que le corresponda (revisar esta informaci\u00f3n en <a href=\"https:\/\/futuronovato.uc.cl\/\" target=\"_blank\">admision.uc.cl<\/a>).\u00a0<\/p>",
				"post_title": "Proceso de matr\u00edcula 2020",
				"post_excerpt": "",
				"post_status": "publish",
				"comment_status": "open",
				"ping_status": "open",
				"post_password": "",
				"post_name": "proceso-de-matricula-2020",
				"to_ping": "",
				"pinged": "",
				"post_modified": "2020-03-12 11:07:42",
				"post_modified_gmt": "2020-03-12 15:07:42",
				"post_content_filtered": "",
				"post_parent": 0,
				"guid": "http:\/\/agenda.uc.cl\/?p=113673",
				"menu_order": 0,
				"post_type": "post",
				"post_mime_type": "",
				"comment_count": "0",
				"filter": "raw"
			},
			"fields": [],
			"lat": "",
			"long": "",
			"notas": "",
			"public_map": false,
			"public_geo": false,
			"tipo": [{
				"term_id": "4053",
				"name": "Matr\u00edcula",
				"slug": "matricula",
				"term_group": "0",
				"term_order": "0",
				"term_taxonomy_id": "4135",
				"taxonomy": "tipo",
				"description": "",
				"parent": "0",
				"count": "2"
			}],
			"dirigido": [{
				"term_id": "4041",
				"name": "Estudiante novato",
				"slug": "estudiante-novato",
				"term_group": "0",
				"term_order": "0",
				"term_taxonomy_id": "4121",
				"taxonomy": "dirigido",
				"description": "",
				"parent": "38",
				"count": "1"
			}, {
				"term_id": "368",
				"name": "Futuros estudiantes",
				"slug": "futuros-estudiantes",
				"term_group": "0",
				"term_order": "0",
				"term_taxonomy_id": "378",
				"taxonomy": "dirigido",
				"description": "",
				"parent": "0",
				"count": "28"
			}],
			"lugares": [{
				"term_id": "778",
				"name": "Todos los campus UC",
				"slug": "todos-los-campus-uc",
				"term_group": "0",
				"term_order": "1",
				"term_taxonomy_id": "796",
				"taxonomy": "lugares",
				"description": "",
				"parent": "0",
				"count": "30"
			}],
			"organizador": [{
				"term_id": "72",
				"name": "Vicerrector\u00eda Acad\u00e9mica",
				"slug": "vicerrectoria-academica",
				"term_group": "0",
				"term_order": "162",
				"term_taxonomy_id": "72",
				"taxonomy": "category",
				"description": "",
				"parent": "0",
				"count": "9"
			}],
			"post_days": null,
			"rrule": "",
			"alldaylong": "0",
			"fono": null,
			"url": null,
			"email": null,
			"valor": null,
			"autor": {
				"data": {
					"ID": "142",
					"user_login": "vrauc",
					"user_pass": "$P$Bi.UmFUlkqDBG5Z296cJOSXypIcyWK0",
					"user_nicename": "vrauc",
					"user_email": "mroa@uc.cl",
					"user_url": "",
					"user_registered": "2012-12-11 14:46:48",
					"user_activation_key": "",
					"user_status": "0",
					"display_name": "vrauc"
				},
				"ID": 142,
				"caps": {
					"author": "1"
				},
				"cap_key": "aguc_capabilities",
				"roles": ["author"],
				"allcaps": {
					"upload_files": true,
					"edit_posts": true,
					"edit_published_posts": true,
					"publish_posts": true,
					"read": true,
					"level_2": true,
					"level_1": true,
					"level_0": true,
					"delete_posts": true,
					"delete_published_posts": true,
					"author": "1"
				},
				"filter": null
			},
			"thumb": ["src=\"https:\/\/agenda.uc.cl\/wp-content\/uploads\/2020\/03\/PUC_1385.jpg\"", "\"", "https:\/\/agenda.uc.cl\/wp-content\/uploads\/2020\/03\/PUC_1385.jpg", "\""]
		}
	*/

    foreach($posts_new_json->posts as $key_post => $value_post) {
        print_r($value_post);
        $postarr = [];
        $postarr['post_title'] =  $value_post->post->post_title;
        $postarr['post_date'] =  $value_post->post->post_date;
        $postarr['post_date_gmt'] =  $value_post->post->post_date_gmt;
        //$postarr['post_content'] =  $value_post->post->post_content;
        $postarr['post_status'] =  $value_post->post->post_status;
        $postarr['post_modified'] =  $value_post->post->post_modified;
        $postarr['post_modified_gmt'] =  $value_post->post->post_modified_gmt;
        $postarr['post_name'] =  $value_post->post->post_name;

        $user = get_user_by('email', $value_post->autor->data->user_email );
        if(!$user){
            $userdata = array(
                'user_login' => $value_post->autor->data->user_login,
                'user_nicename' => $value_post->autor->data->user_nicename,
                'user_email' => $value_post->autor->data->user_email,
                'user_url' => $value_post->autor->data->user_url,
                'user_status' => $value_post->autor->data->user_status,
                'display_name' => $value_post->autor->data->display_name,
                'user_pass' => 'passProvUC2020',
                'role' => 'author'
            );

            $user = wp_insert_user($userdata);

            $postarr['post_author'] = $user;
        }else{
            $postarr['post_author'] = $user->data->ID;
        }

        $tipos = [];

        if(!empty($value_post->tipo)){
            foreach ($value_post->tipo as $key_tipo => $tipo) {
                $term = get_term_by( 'slug', $tipo->slug, 'tipo');
                if(!$term){
                    $term = wp_insert_term($tipo->name, 'tipo', array('slug' => $tipo->slug));
                    print_r($term);
                    $tipos[] = $term['term_id'];
                }else{
                    print_r($term);
                    $tipos[] = $term->term_id;

                }

            }
        }

        $dirigidos = [];

        if(!empty($value_post->dirigido)){
            foreach ($value_post->dirigido as $key_dirigido => $dirigido) {
                $term = get_term_by( 'slug', $dirigido->slug, 'publico');
                if(!$term){
                    $term = wp_insert_term($dirigido->name, 'publico', array('slug' => $dirigido->slug));
                    $dirigidos[] = $term['term_id'];
                }else{
                    $dirigidos[] = $term->term_id;

                }

            }
        }

        $lugares = [];

        if(!empty($value_post->lugares)){
            foreach ($value_post->lugares as $key_lugar => $lugar) {
                $term = get_term_by( 'slug', $lugar->slug, 'lugar');
                if(!$term){
                    $term = wp_insert_term($lugar->name, 'lugar', array('slug' => $lugar->slug));
                    $lugares[] = $term['term_id'];
                }else{
                    $lugares[] = $term->term_id;

                }

            }
        }

        $organizadores = [];

        if(!empty($value_post->organizador)){
            foreach ($value_post->organizador as $key_organizador => $organizador) {
                $term = get_term_by( 'slug', $organizador->slug, 'organizador');
                if(!$term){
                    $term = wp_insert_term($organizador->name, 'organizador', array('slug' => $organizador->slug));
                    $organizadores[] = $term['term_id'];
                }else{
                    $organizadores[] = $term->term_id;

                }

            }
        }




        $postarr['post_type'] = 'actividad';



        echo "\n\n----- POST DATA -----\n";
        print_r($postarr);
        echo "\n----- END POST DATA -----";
        $post_id = wp_insert_post( $postarr );
        //$post_id = false;
        if($post_id){
            if(!empty($tipos)){
                wp_set_post_terms( $post_id, $tipos, 'tipo');
            }

            if(!empty($dirigidos)){
                wp_set_post_terms( $post_id, $dirigidos, 'publico');
            }

            if(!empty($lugares)){
                wp_set_post_terms( $post_id, $lugares, 'lugar');
            }

            if(!empty($organizadores)){
                wp_set_post_terms( $post_id, $organizadores, 'organizador');
            }

            update_field('field_5e15c9d8f246c', $value_post->post->post_content, $post_id);
            /*
				"fono": null,
			  "url": null,
			  "email": null,
			  "valor": null,
			*/

            if($value_post->valor){
                if(strpos(strtolower($value_post->valor),'liberada') !== false){
                    update_field('field_5defeadc2cf97', 0, $post_id);

                    if($value_post->url){
                        $group = array('field_5e15d4cbc4f51' => $value_post->url);
                        update_field('field_5defeb115b6ea',$group,$post_id);
                    }

                }else{

                    update_field('field_5defeadc2cf97', 1, $post_id);
                    $group = array();
                    if($value_post->url){
                        $group['field_5e15d4cbc4f51'] = $value_post->url;
                    }

                    if($value_post->valor){
                        $group['field_5e15cb63dd69d'] = $value_post->valor;
                        $group['field_5e15cb5add69c'] = $value_post->valor;
                    }

                    update_field('field_5defeb115b6ea',$group,$post_id);
                }

            }else{
                update_field('field_5defeadc2cf97', 0, $post_id);

                if($value_post->url){
                    $url = $value_post->url;
                    if(substr( $value_post->url, 0, 4 ) !== "http"){
                        $url = "http://".$value_post->url;
                    }
                    $group = array('field_5e15d4cbc4f51' => $value_post->url);
                    update_field('field_5defeb115b6ea',$group,$post_id);
                }
            }

            if($value_post->email || $value_post->fono){
                $informacion_de_contacto = array();

                if($value_post->email){
                    $informacion_de_contacto['field_5e15ca4ff246e'] = array(array('field_5e15d563ff040' => $value_post->email));
                }

                if($value_post->fono){
                    if(substr( $value_post->fono, 0, 3 ) !== "+56"){
                        $informacion_de_contacto['field_5e15ca63f246f'] = array(array('field_5e15d582ff041' => filter_var($value_post->fono, FILTER_SANITIZE_NUMBER_INT)));
                    }else{
                        $informacion_de_contacto['field_5e15ca63f246f'] = array(array('field_5e15d582ff041' => filter_var(str_replace('+56','',$value_post->fono), FILTER_SANITIZE_NUMBER_INT)));
                    }

                }

                if(!empty($informacion_de_contacto)){
                    update_field('field_5e15ca3ff246d',$informacion_de_contacto,$post_id);
                }
            }


            $begin = new DateTime($value_post->post->post_date);
            if($value_post->post->post_date_until){
                $end = new DateTime($value_post->post->post_date_until);
            }else{
                $end = new DateTime($value_post->post->post_date);
            }

            $lugar_horarios = array();

            if($begin->format('Y-m-d') == $end->format('Y-m-d')){
                $lugar_horarios['field_5e15d045c4858']['field_5e1dfda0d9986'] = 1;
                $lugar_horarios['field_5e15d045c4858']['field_5e1dfe75c250a']['field_5e1dfe8fc250b'] = $begin->format('Ymd');
                $lugar_horarios['field_5e15d045c4858']['field_5e1dfe75c250a']['field_5e1dfed9c250c'] = array(array('field_5e1dfeeac250d' => $begin->format('H:i:s'), 'field_5e1dfeffc250e' => $end->format('H:i:s')));
            }else{
                $lugar_horarios['field_5e15d045c4858']['field_5e1dfda0d9986'] = 2;

                $interval = DateInterval::createFromDateString('1 day');
                $period = new DatePeriod($begin, $interval, $end);
                $lugar_horarios['field_5e15d045c4858']['field_5e1dfe3cc2508'] = array();
                foreach ($period as $dt) {
                    $lugar_horarios['field_5e15d045c4858']['field_5e1dfe3cc2508']['field_5e1e10a907d2c'][] = array(
                        'field_5e1e129707d2d' => $dt->format('Ymd'),
                        'field_5e1e12a807d2e' => array(
                            array(
                                'field_5e1e12b207d2f' => $begin->format('H:i:s'),
                                'field_5e1e136e21f83' => $end->format('H:i:s')
                            )
                        )

                    );
                }

            }


            if(!empty($lugar_horarios)){
                update_field('field_5e15cff39b597',$lugar_horarios,$post_id);
            }

            $url_thumb = '';

            if($value_post->thumb){
                if(!empty($value_post->thumb)){
                    foreach ($value_post->thumb as $key_thumb => $thumb) {
                        if(substr( $thumb, 0, 4 ) === "http"){
                            $url_thumb  = array('name' => basename($thumb), 'url' => $thumb);
                        }
                    }
                }
            }

            if(!empty($url_thumb)){
                $attach_id = upload_field_cust($url_thumb, $post_id);
                update_field('field_5e2994efaff26',$attach_id,$post_id);
            }

        }

    }

    break;
}
echo "</pre>";
