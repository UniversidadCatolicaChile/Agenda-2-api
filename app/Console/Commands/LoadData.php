<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LoadData extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'command:loadData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load data from UC wordpress old';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit', -1);
        define( 'WP_USE_THEMES', false );
        # Load WordPress Core
        // Assuming we're in a subdir: "~/wp-content/plugins/current_dir"
        require __DIR__.'/../../../vendor/autoload.php';

        $app = require_once __DIR__.'/../../../bootstrap/app.php';

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
        
        
        

        foreach($posts_new_json->posts as $key_post => $value_post) {
            //print_r($value_post);
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
                if(!is_wp_error($user)){
                    $postarr['post_author'] = $user;
                }else{
                    $user = get_user_by('login', $value_post->autor->data->user_login );
                    if(!$user){
                         $postarr['post_author'] = $user->data->ID;
                    }else{
                        $postarr['post_author'] = 1;
                    }
                }
            }else{
                $postarr['post_author'] = $user->data->ID;
            }

            $tipos = [];

            if(!empty($value_post->tipo)){
                foreach ($value_post->tipo as $key_tipo => $tipo) {
                $term = get_term_by( 'slug', $tipo->slug, 'tipo');
                if(!$term){
                    $term = wp_insert_term($tipo->name, 'tipo', array('slug' => $tipo->slug));
                    //print_r($term);
                    $tipos[] = $term['term_id'];
                }else{
                    //print_r($term);
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
            $found_post = false;
            if ( $posts_test = get_posts( array( 
                'name' => $postarr['post_name'], 
                'post_type' => 'actividad',
                'post_status' => 'publish',
                'posts_per_page' => 1
            ) ) ) {
                $found_post = $posts_test[0];
            }

            if (!$found_post){
                echo "\n\n----- POST DATA -----\n";
                print_r($postarr);
                echo "\n----- END POST DATA -----";
                $post_id = wp_insert_post( $postarr );
            }
            else{   
                echo "\n\n----- POST DATA FOUND -----\n";
                print_r($found_post);
                echo "\n----- END POST DATA FOUND -----";
                $post_id = false;
            }
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


                $begin = new \DateTime($value_post->post->post_date);
                if($value_post->post->post_date_until){
                $end = new \DateTime($value_post->post->post_date_until);
                }else{
                $end = new \DateTime($value_post->post->post_date);
                }

                $lugar_horarios = array(); 

                if($begin->format('Y-m-d') == $end->format('Y-m-d')){
                $lugar_horarios['field_5e15d045c4858']['field_5e1dfda0d9986'] = 1;
                $lugar_horarios['field_5e15d045c4858']['field_5e1dfe75c250a']['field_5e1dfe8fc250b'] = $begin->format('Ymd');
                $lugar_horarios['field_5e15d045c4858']['field_5e1dfe75c250a']['field_5e1dfed9c250c'] = array(array('field_5e1dfeeac250d' => $begin->format('H:i:s'), 'field_5e1dfeffc250e' => $end->format('H:i:s')));
                }else{
                $lugar_horarios['field_5e15d045c4858']['field_5e1dfda0d9986'] = 2;

                $interval = \DateInterval::createFromDateString('1 day');
                $period = new \DatePeriod($begin, $interval, $end);
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
                    if($attach_id){
                        update_field('field_5e2994efaff26',$attach_id,$post_id);
                    }
                }

            }

        }
        
        }
         echo "\n\n----- PROCESO FINALIZADO -----\n";
        echo "</pre>";
    }
}
