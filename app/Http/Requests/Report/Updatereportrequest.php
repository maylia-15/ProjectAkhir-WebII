<?php

namespace App\Http\Requests\Report;

use App\Models\Report;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Sesuai Logika CRUD di konsep UI: warga hanya boleh edit laporan miliknya
     * SENDIRI, dan HANYA jika status masih "menunggu" (belum diproses petugas).
     */
    public function authorize(): bool
    {
        /** @var Report $report */
        $report = $this->route('report');

        if ($this->user() === null || $report === null) {
            return false;
        }

        $pemilikLaporan = $report->user_id === $this->user()->id;

        return $pemilikLaporan && $report->bisaDiubahWarga();
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
        ];
    }
}