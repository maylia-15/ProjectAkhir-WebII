<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Hanya warga yang sudah login yang boleh membuat laporan.
     */
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->isWarga();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * Sesuai Form Buat Laporan di konsep UI User:
     * Judul Aduan, Deskripsi Lengkap, Dropdown Kategori Sampah, Alamat/Lokasi.
     * (Tanggal otomatis diatur sistem -> tidak perlu input)
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string', 'min:10', 'max:2000'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'lokasi' => ['required', 'string', 'max:255'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul aduan wajib diisi.',
            'deskripsi.required' => 'Deskripsi lengkap wajib diisi.',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter, jelaskan lebih detail.',
            'category_id.required' => 'Kategori sampah wajib dipilih.',
            'category_id.exists' => 'Kategori sampah tidak valid.',
            'lokasi.required' => 'Alamat/lokasi spesifik wajib diisi.',
            'tags.*.exists' => 'Salah satu tag yang dipilih tidak valid.',
        ];
    }
}