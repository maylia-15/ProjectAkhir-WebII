<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Tampilkan Halaman Profil (R - Read, halaman lihat saja).
     *
     * Sesuai konsep UI User (revisi final): Halaman Profil dan Halaman Edit Profil
     * dipisah menjadi 2 halaman berbeda (sebelumnya digabung jadi satu).
     */
    public function show(): View
    {
        return view('profile.show', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Tampilkan Halaman Edit Profil (form untuk Update).
     *
     * Sesuai konsep UI: Form data akun warga (Nama, No HP, Unit/Blok Rumah).
     * Controller ini dipakai bersama oleh User maupun Admin (sama-sama punya profil).
     */
    public function edit(): View
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update data akun (Tombol Perbarui Data Akun).
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->name = $validated['name'];
        $user->no_hp = $validated['no_hp'];
        $user->blok_rumah = $validated['blok_rumah'];

        // Password bersifat opsional, hanya diupdate kalau diisi
        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Data akun berhasil diperbarui.');
    }
}