<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {



        try {

            $user = JWTAuth::parseToken()->authenticate();

            $authenticatedUser = auth()->user();

            if ($user && $user->id != $authenticatedUser->id) {
                return response()->json(['status' => 'invalid user for token'], 401);
            }

            $request->merge(['user' => $user]);


            
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'invalid token'], 401);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'expired token'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'token not provided'], 401);
        }

        return $next($request);
    }
}
