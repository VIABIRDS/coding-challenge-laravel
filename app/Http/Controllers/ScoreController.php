<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use \Firebase\JWT\JWT;


class ScoreController extends Controller
{

    public function index()
    {
        return view('score');
    }

    public function submitScore(Request $request)
    {
        $decodedData = $request->attributes->get('jwtData');
        $existingUser = User::where('name', $decodedData->name)->first();

        // Check if a user with the given name already exists
        if ($existingUser) {
            return response()->json(['error' => 'Given user already has a score'], 409);
        }

        // Create a new user entry
        $newUser = User::create([
            'name' => $decodedData->name,
            'score' => $decodedData->score,
        ]);

        return response()->json($newUser, 200);
    }
}
