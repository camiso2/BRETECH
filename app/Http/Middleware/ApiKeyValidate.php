<?php

namespace App\Http\Middleware;

use Closure;
use App\Custom\Authenticate;

class ApiKeyValidate
{
  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    if (!$request->has("authenticate")) {
      return response()->json([
        'status'  => 401,
        'message' => 'Acceso no autorizado',
      ], 401);
    }

    if ($request->has("authenticate")) {
      $apiKey = Authenticate::encryption(255);

     // dd($apiKey);
     // $api_key = "key_cur_prod_fnPqT5xQEi5Vcb9wKwbCf65c3BjVGyBB";
      if ($request->input("authenticate") != $apiKey) {
        return response()->json([
          'status'  => 401,
          'message' => 'Acceso no autorizado',
        ], 401);
      }
    }

    return $next($request);
  }
}
