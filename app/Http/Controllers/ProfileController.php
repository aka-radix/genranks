<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function me()
    {
        return redirect()->route('profile.show', ['user' => Auth::user()]);
    }

    public function show(User $user)
    {
        return view('profile.show', ['user' => $user]);
    }
}
