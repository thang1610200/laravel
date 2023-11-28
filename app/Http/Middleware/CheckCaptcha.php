<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CheckCaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $client = new Client([
            'base_uri' => 'https://google.com/recaptcha/api/'
        ]);
        
        // Gửi dữ liệu cho recaptcha
        $response = $client->post('siteverify', [
            'query' => [
                'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
                'response' => $request->input('recaptcha-response')
                ]
        ]);
        
        $result = json_decode($response->getBody())->success; // kết quả

        if(!$result){
            return response()->json([
                'test' => $result
            ], 400);
        }

       return $next($request);
    }
}
