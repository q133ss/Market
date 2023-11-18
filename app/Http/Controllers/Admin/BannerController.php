<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\File;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function update(Request $request, int $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update([
            'title' => $request->title,
            'link' => $request->link,
            'text' => $request->text
        ]);

        if($request->img){
            File::where('fileable_type', 'App\Models\Banner')->where('fileable_id', $banner->id)->delete();
            $path = $request->img->store('banners', 'public');
            File::create([
                'src' => '/storage/'.$path,
                'category' => 'banner',
                'fileable_type' => 'App\Models\Banner',
                'fileable_id' => $banner->id
            ]);
        }

        return back();
    }
}
