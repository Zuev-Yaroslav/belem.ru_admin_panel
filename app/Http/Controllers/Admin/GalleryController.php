<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gallery\DeleteSelectedRequest;
use App\Http\Requests\Gallery\UpdateRequest;
use App\Models\Image;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class GalleryController extends Controller
{
    public function index() {
        $images = Image::orderBy('created_at', 'desc')->get();
        return view('admin.gallery.index', compact('images'));
    }
    public function store(Request $req) {
        $path = null;
        try {
            $image = $req->file('file');
            if (isset($image)) {
                $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $path = "gallery/files/" . $imageName;
                $pathExt = "gallery/files/" . $image->getClientOriginalName();
                $count = 1;
                if (Storage::disk('public')->exists($pathExt)) {
                    $count++;
                    while(true) {
                        if (Storage::disk('public')->exists($path . $count . '.' . $image->extension())) {
                            $count++;
                        }
                        else {
                            $path = $path . $count;
                            break;
                        }
                    }
                }
                $path = $path . '.' . $image->extension();
                $data['file_name'] = $image->getClientOriginalName();
                $data['title'] = $imageName;
                $data['alt'] = $imageName;
                $data['file_type'] = $image->extension();
                Storage::disk('public')->put($path, file_get_contents($image));
                $data['image_link'] = $path;
                $data['file_size'] = Storage::disk('public')->size($path);
                $images[0] = Image::create($data);
                $img = view('includes.admin.gallery.image', compact('images'))->render();
                return response()->json([
                    'image' => $img,
                ]);
            }
        } catch (Throwable $e) {
            if(Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            // report($e);
            // return false;
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
    public function update(Image $image, UpdateRequest $req) {
        $data = $req->validated();
        $image->update($data);
    }
    public function destroy_selected(DeleteSelectedRequest $req) {
        $data = $req->validated();
        foreach ($data['selected'] as $id) {
            $image = Image::find($id);
            Storage::disk('public')->delete($image->image_link);
            $image->delete();
        }
        return response()->json([
            'id' => $data['selected']
        ]);
    }
    public function destroy(Image $image) {
        Storage::disk('public')->delete($image->image_link);
        $image->delete();
    }
}
