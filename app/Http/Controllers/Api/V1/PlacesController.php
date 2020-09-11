<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use \WP_Query;

class PlacesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $terms = get_terms( 
                          array(
                                'taxonomy' => 'lugar',
                                'hide_empty' => false
                          ) 
       );

       foreach($terms as $key => $term){
        $terms[$key]->fields = get_fields($term);
       }
       
       return new JsonResponse(['places' => $terms, 'success' => true], 200);
    }
}
