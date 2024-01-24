<?php

namespace App\Http\Middleware;

use Closure;

class ProtectedResource
{
    public function handle($request, Closure $next)
    {
        $authorizationHeader = $request->header('Authorization');

        if ($authorizationHeader) {
            $jwtToken = explode(' ', $authorizationHeader)[1] ?? null;

            if ($jwtToken) {
                $score = $request->input('score');
                $payload = $this->validateAndDecodeToken($jwtToken);

                if ($payload) {
                    $payload['score'] = $score;

                    // Add the decoded data to the request
                    $request->merge(['data' => $payload]);

                    return $next($request);
                }
            }
        }

        // Return a proper JSON response with a 401 status code if token is not valid
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    protected function validateAndDecodeToken($token)
    {
        try {
            $tokenParts = explode('.', $token);

            if (count($tokenParts) === 3) {
                list($encodedHeader, $encodedPayload, $encodedSignature) = $tokenParts;
                $decodedPayload = json_decode(base64_decode($encodedPayload), true);

                return $decodedPayload;
            }
        } catch (\Exception $e) {
            // Log the exception if needed
        }

        return false;
    }
}
