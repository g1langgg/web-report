<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\LaporanComment;
use Illuminate\Http\Request;

class LaporanCommentController extends Controller
{
    public function store(Request $request, Laporan $laporan)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $laporan->comments()->create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
