<?php

namespace App\Http\Middleware;

use Closure;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ProtectedResource
{
    public function handle($request, Closure $next)
    {
        $secretKey = env('JWT_SECRET');
        $jwtToken = $this->generateJwtToken($secretKey);
        //Set Headers
        $request->headers->set('Authorization', 'Bearer ' . $jwtToken);
        $request->headers->set('accept', 'application/json');
        $request->headers->set('Content-Type', 'application/json');
        //dump($request->headers->all());
        $decodedData = $this->validateAndDecodeToken($jwtToken, $secretKey);

        if ($decodedData) {
            $decodedData->score = $request->input('score');
            $request->attributes->add(['jwtData' => $decodedData]);

            return $next($request);
        }

        // Return 401 error if token is not valid
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    protected function generateJwtToken($secretKey)
    {
        $tokenData = [
            'sub' => '1234567890',
            'name' => 'Deni',
            'iat' => time(),
        ];

        // Generate the token
        $token = JWT::encode($tokenData, $secretKey, 'HS256');

        return $token;
    }

    protected function validateAndDecodeToken($token, $secretKey)
    {
        try {
            // Decode the token
            $decodedData = JWT::decode($token, new Key($secretKey, 'HS256'));

            return $decodedData;
        } catch (\Exception $e) {
            return false;
        }
    }
}
