<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPerjalananDinas;


class DetailPerjalananDinasController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'perjalanan_dinas_id' => 'required|exists:perjalanan_dinas,id',
        'ringkasan_kegiatan' => 'required',
        'foto_kegiatan' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'laporan' => 'nullable|mimes:pdf|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('foto_kegiatan')) {
        $data['foto_kegiatan'] = $request->file('foto_kegiatan')
            ->store('foto-kegiatan', 'public');
    }

    if ($request->hasFile('laporan')) {
        $data['laporan'] = $request->file('laporan')
            ->store('laporan', 'public');
    }

    DetailPerjalananDinas::create($data);

    return back()->with('success', 'Detail kegiatan berhasil ditambahkan');
}

public function previewLaporan($id)
{
    $detail = DetailPerjalananDinas::with('perjalananDinas')
        ->findOrFail($id);

    // Pegawai hanya boleh lihat laporan miliknya
    if (
        auth()->user()->role === 'pegawai' &&
        $detail->perjalananDinas->user_id !== auth()->id()
    ) {
        abort(403);
    }

    if (!$detail->laporan) {
        abort(404);
    }

    $path = storage_path('app/public/' . $detail->laporan);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="'.basename($path).'"'
    ]);
}

public function updateStatus(Request $request, $id)
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $request->validate([
        'status' => 'required|in:belum_selesai,berjalan,selesai'
    ]);

    $detail = DetailPerjalananDinas::findOrFail($id);

    $detail->update([
        'status' => $request->status
    ]);

    return back()->with('success', 'Status kegiatan berhasil diperbarui');
}

public function destroy($id)
{
    $user = auth()->user();

    if ($user->role !== 'admin') {
        abort(403);
    }

    $detail = DetailPerjalananDinas::findOrFail($id);

    // Hapus file kalau ada
    if ($detail->foto_kegiatan) {
        \Storage::delete($detail->foto_kegiatan);
    }

    if ($detail->laporan) {
        \Storage::delete($detail->laporan);
    }

    $detail->delete();

    return back()->with('success', 'Detail kegiatan berhasil dihapus.');
}


}
