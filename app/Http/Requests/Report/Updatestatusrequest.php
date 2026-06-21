<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Sesuai konsep UI Admin: hanya admin yang boleh mengubah status laporan.
     * Admin TIDAK BOLEH mengedit teks/data laporan warga, hanya status alur kerja.
     */
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * Sesuai Panel Aksi Validasi di konsep UI Admin:
     * - status "menunggu" -> boleh diubah ke "diproses"
     * - status "diproses" -> boleh diubah ke "selesai"
     * - admin juga bisa menolak (ditolak) untuk aduan palsu/spam
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:diproses,selesai,ditolak'],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status baru wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ];
    }
}