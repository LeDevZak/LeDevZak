<?php

namespace App\Http\Controllers;

use App\Exports\PostExport;
use App\Imports\PostImport;
use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class AdminPostController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('admin')) {
                abort(403, 'Unauthorized');
            }

            return $next($request);
        });
    }

    public function index()
    {
        $routeImport = route('admin.posts.import'); 
        $routeExport = route('admin.posts.export'); 
        
        return view('admin.posts.index', [
            'posts' => Post::paginate(40), 
            'routeImport' => $routeImport, 
            'routeExport' => $routeExport
        ]);
    }
    
    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        $attributes = $this->validatePost();

        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create(array_merge($attributes, [
            'user_id' => request()->user()->id,
        ]));

        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);

        if (request()->hasFile('thumbnail')) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post Updated!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }

    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,txt'
        ]);
        
        Excel::import(new PostImport, $request->file('file'));
    
        return redirect()->back()->with('success', 'Posts imported successfully!');
    }
    
    public function export()
    {
        return Excel::download(new PostExport, 'posts.xlsx');
    }
    
    public function downloadPDF()
    {
    $posts = Post::all();

    $pdf = PDF::loadView('admin.posts.download-pdf', compact('posts'));

    return $pdf->download('posts.pdf');
    }

}
