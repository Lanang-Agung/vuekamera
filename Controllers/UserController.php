<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function getProfil()
    {
        $user = \Auth::user();
        return view('profil', compact('user'));
    }

    public function setProfil (Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->no_wa = $request->no_wa;
        $user->save();
        return redirect()->back()->with('status','Porfil berhasil diedit');
    }
}
