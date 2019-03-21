<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Excel;
use App\Imports\PostsImport;
use App\Charts\ReportChart;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('postType','district')->orderBy('post_date', 'DESC')->orderBy('location')->paginate(10);

        return view('posts.index', compact('posts'));

    }

    public function reports() {

        $posts = Post::with(['district' => function($query) {
            $query->select('messages.user_id');
            $query->groupBy('user_id');
        }])->get();
        $data = collect([]); // Could also be an array

        for ($days_backwards = 2; $days_backwards >= 0; $days_backwards--) {
            // Could also be an array_push if using an array rather than a collection.
            $data->push(User::whereDate('created_at', today()->subDays($days_backwards))->count());
        }

        $chart = new ReportChart;
        $chart->labels(['2 days ago', 'Yesterday', 'Today']);
        $chart->dataset('My dataset', 'line', $data);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);
        if($request->hasFile('import_file')) {
            //$file = base_path() . '/database/seeds/import/Chisankho Data.xlsx';
            $file = $request->import_file;
        Excel::import(new PostsImport, $file);

        }

        // Redirect
        $request->session()->flash('message', 'Data was Imported!');
        return redirect()->to('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
