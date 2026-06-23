<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Setiap user yang sudah login boleh update profilnya sendiri.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * Sesuai Form Data Akun Warga di konsep UI: Nama, No HP, No Rumah.
     * Email tidak diubah di sini (dipakai untuk login, perubahan email
     * sebaiknya lewat alur terpisah demi keamanan).
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'blok_rumah' => ['required', 'string', 'max:50'],

            // Password bersifat opsional saat update profil (hanya diisi kalau mau ganti)
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Format nomor HP tidak valid.',
            'blok_rumah.required' => 'Nomor rumah/blok wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }
}