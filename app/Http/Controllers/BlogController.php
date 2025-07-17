<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'headline' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'author_id' => 'required|numeric',
            'thumbnail' => 'nullable|image|max:2048',
            'image_caption' => 'required|string|max:255',
            'image_credit' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Generate unique slug
        $slug = Str::slug($validated['headline']);
        $count = Blog::where('slug', 'like', "{$slug}%")->count();
        $validated['slug'] = $count ? "{$slug}-{$count}" : $slug;

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $validated['thumbnail'] = $path;
        }

        Blog::create($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created successfully!');
    }


     public function show(Blog $blog) {
      // route --> /ninjas/{id}
      return view('admin.blog.show', ['blog' => $blog]);
    }

    
    public function edit(Blog $blog)
    {
      return view('admin.blog.edit', ['blog' => $blog]);
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'headline' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'author_id' => 'required|numeric',
            'thumbnail' => 'nullable|image|max:2048',
            'image_caption' => 'required|string|max:255',
            'image_credit' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        
        if ($request->hasFile('thumbnail')) {
            if (!empty($player->image_path) && Storage::disk('public')->exists($blog->thumbnail)) {
                Storage::disk('public')->delete($blog->thumbnail);
            }

            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
    

        $blog->update($validated);

        return redirect()->route('admin.blog.show', ['blog' => $blog])->with('success', 'Article updated successfully.');
    }

    
    public function destroy(Blog $blog)
    {
        if (!empty($blog->thumbnail) && Storage::disk('public')->exists($blog->thumbnail)) {
            Storage::disk('public')->delete($blog->thumbnail);
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Article has been deleted!');
    }
}
