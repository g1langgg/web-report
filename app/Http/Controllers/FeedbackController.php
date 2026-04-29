<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request, Laporan $laporan)
    {
        if ($laporan->pelapor_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki akses');
        }

        if ($laporan->status !== 'done') {
            return back()->with('error', 'Laporan belum selesai');
        }

        if ($laporan->feedback) {
            return back()->with('error', 'Feedback sudah diberikan');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $teknisiId = $laporan->assignment?->teknisi_id;

        if (!$teknisiId) {
            return back()->with('error', 'Teknisi tidak ditemukan');
        }

        Feedback::create([
            'laporan_id' => $laporan->id,
            'pelapor_id' => Auth::id(),
            'teknisi_id' => $teknisiId,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Terima kasih atas feedback Anda!');
    }
}
