<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'banner' => 'required|image|mimes:jpeg,png|max:5120',
        ]);

        $imageName = time() . '.' . $request->banner->extension();
        $request->banner->move(public_path('uploads/banners'), $imageName);

        return response()->json([
            'message'      => 'Image Resized successfully!',
            'file'         => $imageName,
            'download_url' => url('uploads/banners/' . $imageName)
        ]);
    }


}
