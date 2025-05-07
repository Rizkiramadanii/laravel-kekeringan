<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilPrediksi;

class HasilController extends Controller
{
    // Simpan hasil prediksi ke database
    public function simpan(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_stasiun' => 'required|string|max:100',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer',
            'predictions' => 'required|json',
            'probabilities' => 'required|json',
        ]);

        // Ambil prediksi_id dari session
        $prediksi_id = session('prediksi_id');
        if (!$prediksi_id) {
            return redirect()->back()->with('error', 'ID prediksi tidak ditemukan.');
        }

        // Decode JSON input
        $predictions = json_decode($validated['predictions'], true);
        $probabilities = json_decode($validated['probabilities'], true);

        // Ambil hasil dari Voting Ensemble
        $ensemble = $predictions['Voting Ensemble'];
        $ensemble_probs = $probabilities['Voting Ensemble'];

        // Simpan ke database
        $data = new HasilPrediksi();
        $data->prediksi_id = $prediksi_id;
        $data->nama_stasiun = $validated['nama_stasiun'];
        $data->bulan = $validated['bulan'];
        $data->tahun = $validated['tahun'];
        $data->label = $ensemble['label'];
        $data->confidence = $ensemble['confidence'];
        $data->kering = $ensemble_probs['Kering'];
        $data->normal = $ensemble_probs['Normal'];
        $data->basah = $ensemble_probs['Basah'];
        $data->predictions = json_encode($predictions);
        $data->probabilities = json_encode($probabilities);
        $data->created_at = now();
        $data->updated_at = now();
        $data->save();

        return redirect()->route('hasil.index')->with('success', 'Hasil prediksi berhasil disimpan!');
    }

    // Tampilkan histori hasil prediksi dengan filter bulan & tahun
    public function index(Request $request)
    {
        $query = HasilPrediksi::with('prediksi');

        // Filter jika request tersedia
        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $hasilPrediksi = $query->orderByDesc('tahun')->orderByDesc('bulan')->get();

        return view('hasil.index', compact('hasilPrediksi'));
    }

    // Tampilkan detail hasil prediksi tertentu
    public function show($id)
    {
        $hasil = HasilPrediksi::with('prediksi')->findOrFail($id);
        $predictions = json_decode($hasil->predictions, true);
        $probabilities = json_decode($hasil->probabilities, true);

        return view('hasil.show', compact('hasil', 'predictions', 'probabilities'));
    }
    // app/Http/Controllers/HasilPrediksiController.php

public function destroy($id)
{
    // Cari data hasil prediksi yang akan dihapus
    $hasilPrediksi = HasilPrediksi::findOrFail($id);

    // Menghapus data di tabel prediksi terkait
    if ($hasilPrediksi->prediksi) {
        $hasilPrediksi->prediksi->delete(); // Menghapus data di tabel prediksi
    }

    // Hapus data di tabel hasilprediksi
    $hasilPrediksi->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('hasil.index')->with('success', 'Data berhasil dihapus');
}


public function getHasilByBulanTahun(Request $request)
{
    $tahun = $request->input('tahun');
    $bulan = $request->input('bulan');

    $hasil = HasilPrediksi::where('tahun', $tahun)
                ->where('bulan', $bulan)
                ->get();

    return response()->json($hasil);
}

}
