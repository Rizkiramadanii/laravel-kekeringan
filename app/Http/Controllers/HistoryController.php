<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index()
    {
        $data = DB::table('prediksi')
            ->leftJoin('hasilprediksi', 'prediksi.id', '=', 'hasilprediksi.prediksi_id')
            ->select('prediksi.*', 'hasilprediksi.bulan', 'hasilprediksi.label')
            ->orderBy('prediksi.created_at', 'desc')
            ->get();

        return view('histori', compact('data'));
    }
}
