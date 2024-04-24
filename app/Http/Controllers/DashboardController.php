<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Models\Komentar;
use App\Models\Like;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class DashboardController extends Controller
{
    public function index()
    {
        $fotos = Foto::where('user_id', auth()->id())->get();
        $albums = Album::where('user_id', auth()->id())->get();
        $likeCount = [];

        foreach ($fotos as $foto) {
            $likeCount[$foto->id] = Like::where('foto_id', $foto->id)->count();
        }

        return view('dashboard',compact('fotos', 'albums', 'likeCount'));
    }

    public function sort($album_id)
    {
        $fotos = Foto::where('user_id', auth()->id())
            ->where('album_id', $album_id)
            ->get();

        $albums = Album::where('user_id', auth()->id())->get();
        $likeCount = [];
        $komentarCount = [];

        foreach ($fotos as $photo) {
            $likeCount[$photo->id] = Like::where('foto_id', $photo->id)->count();
            $komentarCount[$photo->id] = Komentar::where('foto_id', $photo->id)->count();
        }

        return view('dashboard', ['fotos' => $fotos, 'likeCount' => $likeCount, 'albums' => $albums, 'komentarCount' => $komentarCount]);
    }

    public function albumview()
    {
        return view('album');
    }

    public function albumpost(Request $request)
    {
        $request->validate([
            'namaAlbum' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        Album::create([
            'namaAlbum' => $request->namaAlbum,
            'deskripsi' => $request->deskripsi,
            'user_id' => auth()->user()->id,
            'tanggalDibuat' => Carbon::now()->format('Y-m-d'),
        ]);

        return redirect('/dashboard');
    }

    public function fotoview()
    {
        $albums = Album::where('user_id', auth()->id())->get();
        return view('foto', compact('albums'));
    }

    public function fotopost(Request $request)
    {
        $validate = $request->validate([
            'judulFoto' => 'required|string',
            'deskripsi' => 'required|string',
            'lokasifile' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'album_id' => 'required|exists:albums,id',
        ]);

        $pathFoto = $request->file('lokasifile')->store('public/foto');

        $urlFoto = URL::to('/').Storage::url($pathFoto);

        $foto = new Foto([
            'judulFoto' => $validate['judulFoto'],
            'deskripsi' => $validate['deskripsi'],
            'lokasifile' => $urlFoto,
            'album_id' => $validate['album_id'],
            'user_id' => auth()->user()->id
        ]);

        $foto->save();

        return redirect('/dashboard');
    }

    public function delete($id)
    {
        $fotos = Foto::where('id', $id)->first();
        $fotos->delete();
        return redirect('/dashboard');
    }

    public function like($id)
    {
        $photo = Foto::find($id);
        if (!$photo) {
            return redirect()->back()->with('error', 'Foto tidak ada!');
        }

        $user_id = auth()->id();

        $existingLike = Like::where('user_id', $user_id)
                                ->where('foto_id', $photo->id)
                                ->first();

        if ($existingLike) {
            $existingLike->delete();
            session()->flash('success', 'Foto tidak disukai lagi.');
        } else {
        $like = new Like([
            'foto_id' => $photo->id,
            'user_id' => $user_id,
            'tanggallike' => Carbon::now()->format('Y-m-d'),
            'like' => auth()->user()->name,
            ]);
            $like->save();
            session()->flash('success', 'Foto disukai!');
        }
        return redirect()->back();
    }
}
