<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use \WP_Query;

class KeywordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fields_object = get_field_object('field_5eb45b8ec4d90');

        return new JsonResponse(['keywords' => $fields_object['choices'], 'success' => true], 200);
    }
}
