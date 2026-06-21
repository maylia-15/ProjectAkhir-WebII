<?php

namespace App\Http\Requests\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnnouncementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Hanya admin yang boleh mengedit pengumuman (modal yang sama dengan Create,
     * sesuai konsep UI: "Logika CRUD Efektif").
     */
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'tipe' => ['required', 'string', 'in:jadwal_kerja_bakti,jadwal_truk_sampah,himbauan'],
            'isi' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul pengumuman wajib diisi.',
            'tipe.required' => 'Tipe pengumuman wajib dipilih.',
            'tipe.in' => 'Tipe pengumuman tidak valid.',
            'isi.required' => 'Isi pengumuman wajib diisi.',
            'isi.min' => 'Isi pengumuman minimal 10 karakter.',
        ];
    }
}