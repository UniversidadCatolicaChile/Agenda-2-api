<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use \WP_Query;

class TypesController extends Controller
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
                                'taxonomy' => 'tipo',
                                'hide_empty' => false
                          ) 
       );
       
       return new JsonResponse(['types_of_activities' => $terms, 'success' => true], 200);
    }

}
