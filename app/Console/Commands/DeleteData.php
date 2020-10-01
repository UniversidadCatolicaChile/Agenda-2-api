<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \WP_Query;

class DeleteData extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'command:deleteData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all activities and attachments';

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
        define( 'WP_USE_THEMES', false );
        # Load WordPress Core
        // Assuming we're in a subdir: "~/wp-content/plugins/current_dir"
        require __DIR__.'/../../../vendor/autoload.php';

        $app = require_once __DIR__.'/../../../bootstrap/app.php';

        require web_path('cms/wp-load.php');
        require web_path('cms/wp-admin/includes/image.php' );
        require web_path('cms/wp-admin/includes/file.php' );
        require web_path('cms/wp-admin/includes/media.php' );
        $page = 1;
        $max_page = 1000;

        $posts = new WP_Query(
            array(
                    'post_type' => array('actividad','attachment'), 
                    'posts_per_page' => 100, 
                    'post_status' => array('publish','future','draft','pending','private','trash','auto-draft','Inherit'),
                    'paged' => $page
                )
        );

        $max_page = $posts->max_num_pages;
        echo "Max pages {$max_page} \n";
        for($i=1;$i<=$max_page; $i++){

            $posts = new WP_Query(
                array(
                        'post_type' => array('actividad','attachment'), 
                        'posts_per_page' => 100, 
                        'post_status' => array('publish','future','draft','pending','private','trash','auto-draft','Inherit'),
                    )
            );
                    
            while($posts->have_posts()){
                $posts->next_post();
                echo "Borrando post id {$posts->post->ID} tipo {$posts->post->post_type}\n";
                wp_delete_post($posts->post->ID, true);
            }
        }

    }
}
