<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Komentar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function index($id)
    {
        $foto = Foto::find($id);
        $komentar = $foto->komentar()->get();

        return view('komentar', compact('komentar', 'foto'));
    }

    public function store(Request $request, $id)
{
    $foto = Foto::find($id);

    $komentar = new Komentar();
    $komentar->NamaKomentar = Auth::user()->name;
    $komentar->komentar = $request->komentar;
    $komentar->foto_id = $foto->id;
    $komentar->user_id = Auth::id();
    $komentar->tanggalKomentar = Carbon::now()->format('Y-m-d');
    $komentar->save();

    return redirect()->back();
}

}
