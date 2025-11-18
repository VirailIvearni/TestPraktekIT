<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfilController extends Controller  
{
    public function __construct()
    {
        $this->middleware('auth');  
    }

    public function index()
    {
        $user = Auth::user();
        return view('profil.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        $user->name = $request->name;
        $user->posisi = $request->posisi;
        $user->email = $request->email;

        if ($request->hasFile('foto')) {
            if ($user->foto && file_exists(public_path('assets/image/' . $user->foto))) {
                unlink(public_path('assets/image/' . $user->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/image'), $filename);
            $user->foto = $filename;
        }

        $user->save();

        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui!');
    }
}
