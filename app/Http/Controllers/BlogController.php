<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Blog;

class BlogController extends Controller
{

    public function list()
    {
        $blogs = Blog::all();
        return view('blogs.list', compact('blogs'));
    }
    public function index()
    {
        $blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (Gate::allows('create', Blog::class)) {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            $validatedData['user_id'] = auth()->id();
            Blog::create($validatedData);

            return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
        } else {
            return redirect()->route('blogs.index')->with('error', 'You are not authorized to create a blog.');
        }
    }

    public function edit(Blog $blog)
    {
        if (Gate::allows('update', $blog)) {
            return view('blogs.edit', compact('blog'));
        } else {
            return redirect()->route('blogs.index')->with('error', 'You are not authorized to edit this blog.');
        }
    }

    public function update(Request $request, Blog $blog)
    {
        if (Gate::allows('update', $blog)) {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            $blog->update($validatedData);

            return redirect()->route('blogs.edit', $blog)->with('success', 'Blog updated successfully.');
        } else {
            return redirect()->route('blogs.index')->with('error', 'You are not authorized to edit this blog.');
        }
    }

    public function destroy(Blog $blog)
    {
        if (Gate::allows('delete', $blog)) {
            $blog->delete();
            return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
        } else {
            return redirect()->route('blogs.index')->with('error', 'You are not authorized to delete this blog.');
        }
    }
}
