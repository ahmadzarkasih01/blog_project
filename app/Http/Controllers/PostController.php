<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\Post;
use App\Mail\BlogPosted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check()) {
            return redirect('login');
        }

        $posts = Post::active() -> get();
        $view_data = [
            'posts' => $posts,
        ];

        return view('posts.index', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Auth::check()) {
            return redirect('login');
        }

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if(!Auth::check()) {
            return redirect('login');
        }

        $title = $request->input('title');
        $content = $request->input('content');

        // Validasi data
        if (is_null($title) || is_null($content)) {
            return redirect()->back()->withErrors(['error' => 'Title and content are required.']);
        }

        $post = Post::create([
            'title' => $title,
            'content' => $content,
        ]);

        Mail::to(Auth::user()->email)->send(new BlogPosted($post));

        $this->notify_telegram($post);

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!Auth::check()) {
            return redirect('login');
        }

        $post = Post::where('id', $id) ->first();

        if (!$post) {
            return redirect('posts')->with('error', 'Post not found');
        }

        $comments = $post->comments()->get();
        $tot_commnets = $post-> tot_comments();

        if (!$post) {
            return redirect('posts')->with('error', 'Post not found');
        }

        $view_data = [
            'post' => $post,
            'comments' => $comments,
            'tot_comments' => $tot_commnets,
        ];
        return view('posts.show', $view_data);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if(!Auth::check()) {
            return redirect('login');
        }

        $post = Post::where('id', '=', $id)->first();

        $view_data = [
            'post' => $post
            ];

        return view ('posts.edit', $view_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if(!Auth::check()) {
            return redirect('login');
        }

        $title = $request->input('title');
        $content = $request->input('content');

         // Validasi data
        if (is_null($title) || is_null($content)) {
            return redirect()->back()->withErrors(['error' => 'Title and content are required.']);
        }

       Post::where('id', '=', $id)
            ->update([
                'title' => $title,
                'content' => $content,
                'updated_at' => now(),
            ]);

        return redirect("posts/{$id}");
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!Auth::check()) {
            return redirect('login');
        }

        Post::where('id', $id)->delete();

        return redirect('posts');
    }

    private function notify_telegram($post)
        {
            $api_token = env('TELEGRAM_BOT_TOKEN'); // Pastikan token disimpan dalam variabel lingkungan
            $url = "https://api.telegram.org/bot{$api_token}/sendMessage";
            $chat_id = "-4289179351";
            $content = "Ada Postingan baru nih di Blog kamu dengan Judul: <strong> \"{$post->title}\" </strong>";
            $data = [
                'chat_id'       => $chat_id,
                'text'          => $content,
                'parse_mode'    => "HTML"
            ];

            Http::post($url, $data);
        }


}
