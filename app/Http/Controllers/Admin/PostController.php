<?php

namespace App\Http\Controllers\Admin;

use App\Function\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(8);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Category::all();
        return view('admin.posts.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
       $data = $request->all();
        $post = new Post();
       $post->slug = Helper::generateSlug($data['title'], Post::class);
       $post->added_at = date('d/m/Y');
       $post->fill($data);
       $post->save();

       return redirect()->route('admin.posts.show', compact('post'));



    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $data = $request->all();
        $post = Post::find($id);

        if($data['title'] !== $post->title){
            $data['slug'] = Helper::generateSlug($data['title'], Post::class);
        }

        $post->update($data);
        return redirect()->route('admin.posts.show', compact('post'))->with('status', 'Il post è stato modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Hai eliminato correttamente il post numero' . $post->id);
    }
}
