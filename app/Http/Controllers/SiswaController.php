<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\Response;

class SiswaController extends Controller
{
    // Tampilkan list semua siswa beserta nama lembaga terkait
    public function index(Request $request)
    {
        $query = Siswa::with('lembaga');
        
        // Filter berdasarkan lembaga_id jika ada
        if ($request->has('lembaga_id') && $request->lembaga_id != '') {
            $query->where('lembaga_id', $request->lembaga_id);
        }
        
        $siswa = $query->get();
        $lembaga = Lembaga::all();

        return view('siswa.index', compact('siswa', 'lembaga'));
    }

    // Tampilkan form tambah siswa baru
    public function create()
    {
        $lembaga = Lembaga::all();
        return view('siswa.create', compact('lembaga'));
    }

    // Simpan data siswa baru ke database
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'lembaga_id' => 'required|exists:lembaga,id',
            'nis' => 'required|numeric|unique:siswa,nis',
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpg,png|max:100',
        ]);

        // Ambil data yang valid dari request
        $data = $request->only(['lembaga_id', 'nis', 'nama', 'email']);

        // Jika ada file image, proses upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Pastikan folder ada
            if (!file_exists(public_path('assets/images'))) {
                mkdir(public_path('assets/images'), 0777, true);
            }

            $file->move(public_path('assets/images'), $filename);
            $data['image'] = $filename;
        }

        // Simpan data siswa baru
        Siswa::create($data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function show($id)
    {
        $siswa = Siswa::with('lembaga')->findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    // Tampilkan form edit data siswa
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $lembaga = Lembaga::all();

        return view('siswa.edit', compact('siswa', 'lembaga'));
    }

    // Update data siswa di database
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        // Validasi inputan update
        $request->validate([
            'lembaga_id' => 'required|exists:lembaga,id',
            'nis' => ['required', 'numeric', Rule::unique('siswa', 'nis')->ignore($siswa->id)],
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpg,png|max:100',
        ]);

        $data = $request->only(['lembaga_id', 'nis', 'nama', 'email']);

        if ($request->hasFile('image')) {
            if ($siswa->image && file_exists(public_path('assets/images/' . $siswa->image))) {
                unlink(public_path('assets/images/' . $siswa->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('assets/images'), $filename);
            $data['image'] = $filename;
        }

        // Update data siswa
        $siswa->update($data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diupdate');
    }

    // Hapus data siswa
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        // Hapus file image jika ada
        if ($siswa->image && file_exists(public_path('assets/images/' . $siswa->image))) {
            unlink(public_path('assets/images/' . $siswa->image));
        }

        // Hapus data siswa
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }

    /**
     * Export data siswa ke CSV dengan filter
     */
    public function export(Request $request)
    {
        $query = Siswa::with('lembaga');
        
        // Filter berdasarkan lembaga_id jika ada
        if ($request->has('lembaga_id') && $request->lembaga_id != '') {
            $query->where('lembaga_id', $request->lembaga_id);
            $lembaga = Lembaga::find($request->lembaga_id);
            $lembagaName = $lembaga ? $lembaga->nama_lembaga : 'Semua';
        } else {
            $lembagaName = 'Semua';
        }
        
        $siswas = $query->get();
        
        $filename = 'data-siswa-' . str_replace(' ', '-', $lembagaName) . '-' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($siswas, $lembagaName) {
            $file = fopen('php://output', 'w');
            
            // UTF-8 BOM untuk Excel
            fwrite($file, "\xEF\xBB\xBF");
            
            // Header dengan informasi filter
            fputcsv($file, ['Lembaga:', $lembagaName]);
            fputcsv($file, ['Tanggal Export:', date('d-m-Y H:i')]);
            fputcsv($file, ['Total Data:', count($siswas)]);
            fputcsv($file, []); // Baris kosong
            
            // Header tabel
            fputcsv($file, [
                'No', 'Nama Lembaga', 'NIS', 'Nama Siswa', 
                'Email', 'Foto', 'Tanggal Dibuat', 'Tanggal Diupdate'
            ]);

            // Data
            $counter = 1;
            foreach ($siswas as $siswa) {
                fputcsv($file, [
                    $counter++,
                    $siswa->lembaga->nama_lembaga ?? '-',
                    $siswa->nis,
                    $siswa->nama,
                    $siswa->email,
                    $siswa->image ? 'Ada' : 'Tidak Ada',
                    $siswa->created_at ? $siswa->created_at->format('d-m-Y H:i') : '-',
                    $siswa->updated_at ? $siswa->updated_at->format('d-m-Y H:i') : '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}