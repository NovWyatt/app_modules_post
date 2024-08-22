<?php

namespace Modules\Image\Controllers;

use App\Http\Controllers\Controller;
use Modules\Image\Providers\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $images = $this->imageService->getAll();
        return view('Image::index', compact('images'));
    }

    public function upload()
    {
        return view('Image::upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $image = $this->imageService->store($request->file('image'));
        return redirect()->route('image.index', compact('image'))->with('success', 'Image uploaded successfully');
    }

    public function destroy($id)
    {
        $this->imageService->delete($id);
        return redirect()->route('image.index')->with('success', 'Image deleted successfully');
    }

    public function select()
    {
        $images = $this->imageService->getAll();
        return view('Image::select', compact('images'));
    }
}