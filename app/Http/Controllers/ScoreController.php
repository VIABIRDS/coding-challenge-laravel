<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class ScoreController extends Controller
{
    public function submitScore(Request $request)
    {

        $data = $request->data;
        $existingUser = User::where('name', $data['name'])->first();

        if ($existingUser) {
            return response()->json(['error' => 'Given user already has a score'], 409);
        }
    
        // Create a new user entry
        $newUser = User::create([
            'name' => $data['name'],
            'score' => $data['score'],
        ]);
    
        return response()->json($newUser, 200);
        
    }
    
}
