<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Excel;
use App\Imports\PostsImport;
use App\Charts\ReportChart;
use App\Models\User;
use App\District;

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

        /* $districts = District::with('posts')
            ->get()
            ->map(function ($district) {
                // Return the number of posts with that district
                
                return count($district->posts);
        }); */

        $districts = District::withCount(['posts'])->get()->toArray();
        //dd($districts);
        $data = collect([]);
        foreach($districts as $key => $district){
            
            $data->put($district['name'] , $district['posts_count']);
        }
        //dd($data->values());
        $chart = new ReportChart;
        $chart->labels($data->keys());
        $chart->dataset('Total Incidents in a District', 'bar', $data->values());

        return view('posts.reports',compact('chart'));

        
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
