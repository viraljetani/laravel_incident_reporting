<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Excel;
use App\Imports\PostsImport;
use App\Charts\ReportChart;
use App\District;
use App\PostType;
use Illuminate\Support\Facades\DB;

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
        $data1 = collect([]);
        foreach($districts as $key => $district){
            
            $data1->put($district['name'] , $district['posts_count']);
        }
        //dd($data->values());
        $chart = new ReportChart;
        $chart->labels($data1->keys());
        $chart->dataset('Total Incidents in a District', 'bar', $data1->values())->options(['backgroundColor' => [
            'rgba(255, 99, 132, 0.9)',
            'rgba(54, 162, 235, 0.9)',
            'rgba(255, 206, 86, 0.9)',
            'rgba(75, 192, 192, 0.9)',
            'rgba(153, 102, 255, 0.9)',
            'rgba(255, 99, 132, 0.9)',
            'rgba(54, 162, 235, 0.9)',
            'rgba(255, 206, 86, 0.9)',
            'rgba(75, 192, 192, 0.9)',
            'rgba(153, 102, 255, 0.9)',
            'rgba(255, 159, 64, 0.9)'
        ],
        'borderColor' => [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ]]);
        //dd($chart);
        $incidentByType = PostType::withCount(['posts'])->get()->toArray();
        //dd($incidentByType);
        $data2 = collect([]);
        foreach($incidentByType as $key => $incidentType){
            
            $data2->put($incidentType['name'] , $incidentType['posts_count']);
        }
        //dd($data->values());
        $chart2 = new ReportChart;
        $chart2->labels($data2->keys());
        $chart2->dataset('Total Incidents by Incident Types', 'horizontalBar', $data2->values())->options(['backgroundColor' => [
            'rgba(255, 99, 132, 0.9)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ],
        'borderColor' => [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ]]);
       
        // Pie Chart
        $victims = Post::select('victims', DB::raw('count(*) as posts_count'))
        ->groupBy('victims')
        ->get()->toArray();;
        //dd($victims);
        $data3 = collect([]);
        foreach($victims as $key => $victim){
            
            $data3->put($victim['victims'] , $victim['posts_count']);
        }
        //dd($data3->values());
        $chart3 = new ReportChart;
        $chart3->labels($data3->keys());
        $chart3->dataset('Total % of Incidents by Incident Types', 'pie', $data3->values())->options(['backgroundColor' => [
            'rgba(255, 99, 132, 0.9)',
            'rgba(54, 162, 235, 0.9)',
            'rgba(255, 206, 86, 0.9)',
            'rgba(75, 192, 192, 0.9)',
            'rgba(153, 102, 255, 0.9)',
            'rgba(255, 99, 132, 0.9)',
            'rgba(54, 162, 235, 0.9)',
            'rgba(255, 206, 86, 0.9)',
            'rgba(75, 192, 192, 0.9)',
            'rgba(153, 102, 255, 0.9)',
            'rgba(255, 159, 64, 0.9)'
        ],
        'borderColor' => [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ]]);
        $chart3->title("Total % of Victim Types");

        return view('posts.reports',compact('chart','chart2','chart3'));

        
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
