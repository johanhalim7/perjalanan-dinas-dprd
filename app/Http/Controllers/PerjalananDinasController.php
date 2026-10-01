<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerjalananDinas;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PerjalananDinasController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    | Admin  : lihat semua data
    | Pegawai: lihat perjalanan yang dia ikuti
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        // QUERY DATA
        $dataQuery = PerjalananDinas::with(['pegawai', 'detailPerjalanan']);

        // QUERY TOTAL (DUPLIKAT TAPI TERPISAH)
        $totalQuery = PerjalananDinas::query();

        if (auth()->user()->role === 'pegawai') {
            $dataQuery->whereHas('pegawai', function ($q) {
                $q->where('users.id', auth()->id());
            });

            $totalQuery->whereHas('pegawai', function ($q) {
                $q->where('users.id', auth()->id());
            });
        }

        if ($request->filled('bulan')) {
            $dataQuery->whereMonth('tanggal_berangkat', $request->bulan);
            $totalQuery->whereMonth('tanggal_berangkat', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $dataQuery->whereYear('tanggal_berangkat', $request->tahun);
            $totalQuery->whereYear('tanggal_berangkat', $request->tahun);
        }

        $data = $dataQuery->get();
        $totalAnggaran = $totalQuery->sum('anggaran');

        return view('perjalanan_dinas.index', compact('data', 'totalAnggaran'));
    }

    /*
    |--------------------------------------------------------------------------
    | PREVIEW PDF (ADMIN)
    |--------------------------------------------------------------------------
    */
    public function previewPdf(Request $request)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $query = PerjalananDinas::with('pegawai');

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_berangkat', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_berangkat', $request->tahun);
        }

        $data = $query->get();
        $totalAnggaran = $query->sum('anggaran');

        return Pdf::loadView(
            'perjalanan_dinas.pdf',
            compact('data', 'totalAnggaran')
        )->stream('preview_perjalanan_dinas.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT PDF (ADMIN)
    |--------------------------------------------------------------------------
    */
    public function exportPdf(Request $request)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $query = PerjalananDinas::with('pegawai');

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_berangkat', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_berangkat', $request->tahun);
        }

        $data = $query->get();
        $totalAnggaran = $query->sum('anggaran');

        return Pdf::loadView(
            'perjalanan_dinas.pdf',
            compact('data', 'totalAnggaran')
        )->download('laporan_perjalanan_dinas.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE (ADMIN)
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $pegawai = User::where('role', 'pegawai')->get();

        return view('perjalanan_dinas.create', compact('pegawai'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE (ADMIN + MULTI PEGAWAI)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $request->validate([
            'user_id'            => 'required|array|min:1',
            'user_id.*'          => 'exists:users,id',
            'tujuan'             => 'required',
            'tanggal_berangkat'  => 'required|date',
            'tanggal_pulang'     => 'required|date',
            'anggaran'           => 'required|numeric',
            'surat_tugas'        => 'nullable|file|mimes:pdf',
        ]);

        $suratTugas = null;
        if ($request->hasFile('surat_tugas')) {
            $file = $request->file('surat_tugas');
            $suratTugas = time().'_surat_tugas.'.$file->getClientOriginalExtension();
            $file->storeAs('public/perjalanan_dinas', $suratTugas);
        }

        $perjalanan = PerjalananDinas::create([
            'tujuan'            => $request->tujuan,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'tanggal_pulang'    => $request->tanggal_pulang,
            'anggaran'          => $request->anggaran,
            'surat_tugas'       => $suratTugas,
        ]);

        $perjalanan->pegawai()->attach($request->user_id);

        return redirect()
            ->route('perjalanan-dinas.index')
            ->with('success', 'Data perjalanan dinas berhasil disimpan');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT (ADMIN)
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $data = PerjalananDinas::with('pegawai')->findOrFail($id);
        $pegawai = User::where('role', 'pegawai')->get();

        return view('perjalanan_dinas.edit', compact('data', 'pegawai'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE (ADMIN + SYNC PEGAWAI)
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $data = PerjalananDinas::findOrFail($id);

        $request->validate([
            'user_id'            => 'required|array|min:1',
            'user_id.*'          => 'exists:users,id',
            'tujuan'             => 'required',
            'tanggal_berangkat'  => 'required|date',
            'tanggal_pulang'     => 'required|date',
            'anggaran'           => 'required|numeric',
            'surat_tugas'        => 'nullable|file|mimes:pdf',
        ]);

        if ($request->hasFile('surat_tugas')) {
            $file = $request->file('surat_tugas');
            $namaFile = time().'_surat_tugas.'.$file->getClientOriginalExtension();
            $file->storeAs('public/perjalanan_dinas', $namaFile);
            $data->surat_tugas = $namaFile;
        }

        $data->update($request->only([
            'tujuan',
            'tanggal_berangkat',
            'tanggal_pulang',
            'anggaran',
        ]));

        $data->pegawai()->sync($request->user_id);

        return redirect()
            ->route('perjalanan-dinas.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY (ADMIN)
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        PerjalananDinas::findOrFail($id)->delete();

        return redirect()
            ->route('perjalanan-dinas.index')
            ->with('success', 'Data berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | PREVIEW SURAT TUGAS
    |--------------------------------------------------------------------------
    */
    public function previewSuratTugas($id)
    {
        $data = PerjalananDinas::with('pegawai')->findOrFail($id);

        if (
            auth()->user()->role === 'pegawai' &&
            !$data->pegawai->contains(auth()->id())
        ) {
            abort(403);
        }

        abort_unless($data->surat_tugas, 404);

        $path = storage_path('app/public/perjalanan_dinas/'.$data->surat_tugas);
        abort_unless(file_exists($path), 404);

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD SURAT TUGAS
    |--------------------------------------------------------------------------
    */
    public function downloadSuratTugas($id)
    {
        $data = PerjalananDinas::with('pegawai')->findOrFail($id);

        if (
            auth()->user()->role === 'pegawai' &&
            !$data->pegawai->contains(auth()->id())
        ) {
            abort(403);
        }

        return Storage::download('public/perjalanan_dinas/'.$data->surat_tugas);
    }

    /*
    |--------------------------------------------------------------------------
    | UPLOAD LAPORAN (PEGAWAI)
    |--------------------------------------------------------------------------
    */
    public function uploadLaporan(Request $request, $id)
    {
        $data = PerjalananDinas::with('pegawai')->findOrFail($id);

        if (
            auth()->user()->role !== 'pegawai' ||
            !$data->pegawai->contains(auth()->id())
        ) {
            abort(403);
        }

        $request->validate([
            'laporan_perjalanan' => 'required|file|mimes:pdf'
        ]);

        $file = $request->file('laporan_perjalanan');
        $namaFile = time().'_laporan.'.$file->getClientOriginalExtension();
        $file->storeAs('public/perjalanan_dinas', $namaFile);

        $data->update([
            'laporan_perjalanan' => $namaFile
        ]);

        return back()->with('success', 'Laporan perjalanan berhasil diupload');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $perjalanan = PerjalananDinas::with(['pegawai', 'detailPerjalanan'])
            ->findOrFail($id);

        if (
            auth()->user()->role === 'pegawai' &&
            !$perjalanan->pegawai->contains(auth()->id())
        ) {
            abort(403);
        }

        return view('perjalanan_dinas.show', compact('perjalanan'));
    }
}
