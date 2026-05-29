<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PosterController extends Controller
{
    public function adminView()
    {
        return view('admin.cms.poster_editor');
    }

    public function userView()
    {
        abort(404);
    }

    public function download(Request $request)
    {
        $request->validate([
            'image' => 'required|string',
        ]);

        $imgData = $request->input('image');
        if (preg_match('/^data:image\/(\w+);base64,/', $imgData, $type)) {
            $imgData = substr($imgData, strpos($imgData, ',') + 1);
            $type = strtolower($type[1]);

            if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
                return response()->json(['error' => 'Invalid format'], 400);
            }

            $imgData = base64_decode($imgData);
            if ($imgData === false) {
                return response()->json(['error' => 'Decode failed'], 400);
            }

            $filename = 'poster_' . time() . '_' . Str::random(5) . '.' . $type;
            
            // Return download response directly as binary
            return response($imgData)
                ->header('Content-Type', 'image/' . $type)
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
        }

        return response()->json(['error' => 'Invalid data'], 400);
    }
}
