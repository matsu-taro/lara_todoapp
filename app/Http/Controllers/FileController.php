<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request)
    {
    }

    public function destroy(string $id)
    {
        $file = File::findOrFail($id);

        if (Storage::exists($file->path)) {
            Storage::delete($file->path);
        }

        FIle::findOrFail($id)
            ->delete();

        return back();
    }
}
