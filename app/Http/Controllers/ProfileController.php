<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $roles = Role::all();
        return view('profile.edit', ['user' => $request->user(), 'roles' => $roles]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'no_hp' => ['nullable', 'string', 'max:255'],
            'nim' => ['nullable', 'string', 'max:9'],
            'prodi' => ['nullable', 'string', 'max:255'],
            'angkatan' => ['nullable', 'string', 'max:4'],
        ]);

        $request->user()->update($request->all());

        // img
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $file_name = $request->user()->name . '_' . time() . '.' . $img->getClientOriginalExtension();
            $request->user()->img = $file_name;
            $request->user()->update();
            $img->storeAs('public', $file_name);
        }
        
        return redirect()->route('profile.edit')->with('message', 'profile updated successfully');
    }
}
