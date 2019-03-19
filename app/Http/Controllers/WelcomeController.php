<?php

namespace App\Http\Controllers;

use App\Post;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $posts = Post::with('postType','district')->orderBy('post_date', 'DESC')->orderBy('location')->get();

        return view('welcome',compact('posts'));
    }
}
