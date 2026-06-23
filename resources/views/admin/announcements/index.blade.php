{{--
    Kelola Pengumuman Admin. Variabel dari AdminAnnouncementController@index:
    - $announcements (Paginator of Announcement, with user)

    REVISI: kolom Tipe dan field input Tipe dihapus sesuai konsep UI final.
    Sesuai konsep UI Admin: Full CRUD via Modal, tanpa field Tipe.
    Tabel: No | Judul Pengumuman | Tanggal Dibuat | Aksi
    Modal Create & Edit: Input Judul + Textarea Isi saja.
--}}
@extends('layouts.admin')
@section('title', 'Kelola Pengumuman - BISA')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 pb-12">

    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-black text-slate-900">Kelola Pengumuman</h2>
            <p class="text-gray-500 text-sm mt-1">Kelola pengumuman kompleks untuk warga</p>
        </div>
        <button type="button" id="btn-open-create"
            class="bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-sm transition text-sm">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Pengumuman Baru
        </button>
    </div>

    {{-- Tabel Pengumuman --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider">No</th>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Judul Pengumuman</th>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Tanggal Dibuat</th>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($announcements as $index => $announcement)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-6 py-4 text-slate-500">{{ $announcements->firstItem() + $index }}</td>
                        <td class="px-6 py-4 font-bold text-slate-900">{{ $announcement->judul }}</td>
                        <td class="px-6 py-4 text-slate-400 text-xs font-medium">{{ $announcement->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-4">
                                <button type="button"
                                    class="btn-open-edit text-indigo-600 hover:text-indigo-800 font-bold text-xs hover:underline"
                                    data-id="{{ $announcement->id }}"
                                    data-judul="{{ $announcement->judul }}"
                                    data-isi="{{ $announcement->isi }}">
                                    Edit
                                </button>
                                <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus pengumuman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-700 font-bold text-xs hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-400">Belum ada pengumuman. Klik "Tambah Pengumuman Baru" untuk memulai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $announcements->links() }}

</div>

{{-- ============================================================
     MODAL CREATE — Tambah Pengumuman Baru
     ============================================================ --}}
<div id="modal-create" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" id="backdrop-create"></div>
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-lg font-black text-slate-900">Tambah Pengumuman Baru</h3>
            <button type="button" id="btn-close-create" class="text-slate-400 hover:text-slate-600 transition text-xl leading-none">&times;</button>
        </div>
        <form action="{{ route('admin.announcements.store') }}" method="POST" class="p-6 space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="judul" required value="{{ old('judul') }}"
                    class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 text-sm focus:border-[#1a8e5f] focus:ring-2">
                @error('judul')
                    <p class="text-rose-600 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Isi Pengumuman <span class="text-red-500">*</span></label>
                <textarea name="isi" rows="5" required
                    class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 text-sm focus:border-[#1a8e5f] focus:ring-2">{{ old('isi') }}</textarea>
                @error('isi')
                    <p class="text-rose-600 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" id="btn-cancel-create"
                    class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 rounded-xl transition">Batal</button>
                <button type="submit"
                    class="flex-1 bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3 rounded-xl shadow-sm transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- ============================================================
     MODAL EDIT — Edit Pengumuman (terisi data lama via JS)
     ============================================================ --}}
<div id="modal-edit" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" id="backdrop-edit"></div>
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-lg font-black text-slate-900">Edit Pengumuman</h3>
            <button type="button" id="btn-close-edit" class="text-slate-400 hover:text-slate-600 transition text-xl leading-none">&times;</button>
        </div>
        <form id="form-edit" action="" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="judul" id="edit-judul" required
                    class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 text-sm focus:border-[#1a8e5f] focus:ring-2">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Isi Pengumuman <span class="text-red-500">*</span></label>
                <textarea name="isi" id="edit-isi" rows="5" required
                    class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 text-sm focus:border-[#1a8e5f] focus:ring-2"></textarea>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" id="btn-cancel-edit"
                    class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 rounded-xl transition">Batal</button>
                <button type="submit"
                    class="flex-1 bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3 rounded-xl shadow-sm transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
    function closeModal(id) { document.getElementById(id).classList.add('hidden'); }

    // Modal Create
    document.getElementById('btn-open-create').addEventListener('click', function () { openModal('modal-create'); });
    document.getElementById('btn-close-create').addEventListener('click', function () { closeModal('modal-create'); });
    document.getElementById('btn-cancel-create').addEventListener('click', function () { closeModal('modal-create'); });
    document.getElementById('backdrop-create').addEventListener('click', function () { closeModal('modal-create'); });

    // Modal Edit
    document.querySelectorAll('.btn-open-edit').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('form-edit').action = '/admin/pengumuman/' + this.dataset.id;
            document.getElementById('edit-judul').value  = this.dataset.judul;
            document.getElementById('edit-isi').value    = this.dataset.isi;
            openModal('modal-edit');
        });
    });
    document.getElementById('btn-close-edit').addEventListener('click', function () { closeModal('modal-edit'); });
    document.getElementById('btn-cancel-edit').addEventListener('click', function () { closeModal('modal-edit'); });
    document.getElementById('backdrop-edit').addEventListener('click', function () { closeModal('modal-edit'); });
</script>
@endsection