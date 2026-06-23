<?php

namespace App\Http\Requests\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnnouncementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'isi'   => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul pengumuman wajib diisi.',
            'isi.required'   => 'Isi pengumuman wajib diisi.',
            'isi.min'        => 'Isi pengumuman minimal 10 karakter.',
        ];
    }
}