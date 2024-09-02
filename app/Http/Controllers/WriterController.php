<?php

namespace App\Http\Controllers;

use App\Models\Writer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WriterController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $writers = Writer::orderByDesc('id')->get();

        $writerStatus = null;

        if ($user->writer()->exists()) {
            $isWriterActive = $user->writer->is_active;

            $writerStatus = $isWriterActive ? 'active' : 'pending';
        }

        return view('dashboard.owner.writer.index', compact('writerStatus', 'writers'));
    }

    public function apply_writer()
    {
        $user = Auth::user();

        DB::transaction(function () use ($user) {

            $validated['user_id'] = $user->id;
            $validated['is_active'] = false;

            Writer::create($validated);

        });

        return redirect()->route('dashboard.writers.index');
    }

    public function update_status(Writer $writer)
    {
        $user = $writer->user;

        DB::transaction(function () use ($writer, $user) {

            $writer->update([
                'is_active' => true,
            ]);

            if (!$user->hasRole('writer')) {
                $user->assignRole('writer');
            }

        });

        return redirect()->route('dashboard.writers.index');
    }
}
