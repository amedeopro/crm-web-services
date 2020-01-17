<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class MeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function  __invoke(Request $request)
    {
        $user = $request->user();
        $immagine = Auth::user()->getFirstMediaUrl('avatars', 'thumb');
        
        return response()->json([
           'email' => $user->email,
           'name' => $user->name,
            'media' => $immagine
       ]);
    }
}
