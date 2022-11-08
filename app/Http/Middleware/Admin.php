<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = Auth::user();
        if ($auth && $auth['role']=='ADMIN') {
            return $next($request);
        }
        $response = [
            'success' => false,
            'message' => 'Unauthorized',
        ];
        return response()->json($response, 401);
    }
}