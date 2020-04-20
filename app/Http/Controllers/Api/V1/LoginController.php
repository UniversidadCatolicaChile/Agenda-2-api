<?php
namespace App\Http\Controllers\Api\V1;

use App\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use \WP_Query;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
          $token = Str::random(80);
        
          $request->user()->forceFill([
              'api_token' => hash('sha256', $token),
          ])->save();
        
          return new JsonResponse(['success' => true, 'token' => $token],200);
        }else{
          return new JsonResponse(['success' => false],403);
        }
    }
    
    public function createUsers(Request $request)
    {
      $token = Str::random(80);
      $user = Customer::create([
          'name' => 'Ilogica Soporte',
          'email' => 'ariel.contreras@uc.cl',
          'password' => Hash::make('7i1u6W4ce&n'),
          'api_token' => hash('sha256', $token)
      ]);
      
      return new JsonResponse(['success' => true, 'user' => $user],200);
      
    }
}