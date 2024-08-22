<?php

namespace Modules\Post\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Category\Models\Category;
use Modules\Image\Providers\ImageService;
use Modules\Post\Models\Post;

class PostController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $posts = $query->with('category', 'user')->get();
        $categories = Category::all();

        return view('Post::index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Post::create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|string|max:255',
            'status' => 'required|string|in:draft,published',
        ]);
        if ($request->has('image_path')) {
            // Lấy đường dẫn của ảnh đã chọn từ ImageService
            $imagePath = $this->imageService->getPathById($request->image_path);

            // Xử lý để lưu đường dẫn hình ảnh chỉ là phần đường dẫn tương đối (ví dụ: 'images/filename')
            $relativePath = str_replace('public/', '', $imagePath); // Xóa 'public/' nếu có
            $validatedData['image_path'] = $relativePath;
        }
        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
            'image_path' => $request->$validatedData['image_path'],
            'status' => $request->input('status'),
            'user_id' => auth()->id(), // Lấy user_id từ người dùng hiện tại
        ]);

        return redirect()->route('post')
            ->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('Post::edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|string|max:255',
            'status' => 'required|string|in:draft,published',
        ]);

        $post = Post::findOrFail($id);
        if ($request->has('image_path')) {
            // Lấy đường dẫn của ảnh đã chọn từ ImageService
            $imagePath = $this->imageService->getPathById($request->image_path);

            // Xử lý để lưu đường dẫn hình ảnh chỉ là phần đường dẫn tương đối (ví dụ: 'images/filename')
            $relativePath = str_replace('public/', '', $imagePath); // Xóa 'public/' nếu có
            $validatedData['image_path'] = $relativePath;
        }
        $post->update($validatedData);

        return redirect()->route('post')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('post')
            ->with('success', 'Post deleted successfully.');
    }

    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'postIds' => 'required|array',
            'postIds.*' => 'exists:posts,id',
        ]);

        Post::whereIn('id', $request->postIds)->delete();

        return redirect()->route('post')
            ->with('success', 'Posts deleted successfully.');
    }

    public function show($id)
    {
        $post = Post::with('category', 'user')->findOrFail($id);
        return view('Post::show', compact('post'));
    }
}