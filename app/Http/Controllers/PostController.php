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
use Spatie\Geocoder\Facades\Geocoder;

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
////////// below funciton is a redundant function /// can be removed later on
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
            
            
        ],
        'borderColor' => [
            
            
        ]]);
        $chart->displayAxes(true);
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
        $chart2->dataset('Total Incidents by Incident Types', 'bar', $data2->values())->options(['backgroundColor' => [
            
        ],
        'borderColor' => [
            
        ]]);
        $chart2->displayAxes(true);
       
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
        ],
    ]);
        $chart3->title("Total % of Victim Types");
        $chart3->displayAxes(false,false);

        return view('posts.reports',compact('chart','chart2','chart3'));

        
    }
/////////////////////////////  all reports start /////////////
    public function reportsIncidentByDistrict() {
        $districts = District::withCount(['posts'])->get()->toArray();
        //dd($districts);
        $data1 = collect([]);
        foreach($districts as $key => $district){
            
            $data1->put($district['name'] , $district['posts_count']);
        }
        //dd($data->values());
        $chart = new ReportChart;
        $chart->labels($data1->keys());
        $chart->dataset('Total Incidents in a District', 'bar', $data1->values())->options([
            'plugins' => [
                'colorschemes' => ['scheme' => 'tableau.Tableau10']
            ],
        ]);
        $chart->displayAxes(true);
        

        return view('posts.reports-incident-district',compact('chart'));

    }

    public function reportsIncidentByType() {
       
        $incidentByType = PostType::withCount(['posts'])->get()->toArray();
        //dd($incidentByType);
        $data2 = collect([]);
        foreach($incidentByType as $key => $incidentType){
            
            $data2->put($incidentType['name'] , $incidentType['posts_count']);
        }
        //dd($data->values());
        $chart2 = new ReportChart;
        $chart2->labels($data2->keys());
        $chart2->dataset('Total Incidents by Incident Types', 'bar', $data2->values())->options([
            'plugins' => [
                'colorschemes' => ['scheme' => 'tableau.Tableau10']
            ],
        ]);
        $chart2->displayAxes(true);

        return view('posts.reports-incident-type',compact('chart2'));
    }

    public function reportsIncidentVictims() {
        // Pie Chart
        $victims = Post::select('victims', DB::raw('count(*) as posts_count'))
        ->where('victims','!=','')->groupBy('victims')
        ->get()->toArray();
        //dd($victims);
        $data3 = collect([]);
        foreach($victims as $key => $victim){
            
            $data3->put($victim['victims'] , $victim['posts_count']);
        }
        //dd($data3->values());
        $chart3 = new ReportChart;
        $chart3->labels($data3->keys());
        $chart3->dataset('Total % of Incidents by Incident Types', 'pie', $data3->values())->options([
            'plugins' => [
                'colorschemes' => ['scheme' => 'brewer.Set1-9']
            ],
        ]);
        $chart3->title("Total % of Victim Types");
        $chart3->displayAxes(false,false);
        return view('posts.reports-incident-victims',compact('chart3'));
    }

    public function reportsVictimsGender() {
        // Pie Chart
        $maleVictims = Post::sum('male_victims');
        $femaleVictims = Post::sum('female_victims');
       
        $chart3 = new ReportChart;
        $chart3->labels(['Male','Female']);
        $chart3->dataset('Victims By Gender', 'pie', [intval($maleVictims), intval($femaleVictims)])->options([
            'plugins' => [
                'colorschemes' => ['scheme' => 'tableau.Tableau10']
            ],
        ]);
        $chart3->displayAxes(false,false);
        return view('posts.reports-victim-by-gender',compact('chart3'));
    }

    public function reportsPerpetratorsGender() {
        $districts = District::get()->toArray();
        //dd($districts);
        $data1 = collect([]);
        $data2 = collect([]);
        $labels = collect([]);
        $perpetrators = array();
        foreach($districts as $key => $district){
            //dd($district);
            $posts = Post::where('district_id',$district['id'])->get();
            
            $malePerpetrators = @$posts->sum('male_perpetrators') ?? 0;
            $femalePerpetrators = @$posts->sum('female_perpetrators') ?? 0;
            //dd(intval($malePerpetrators));
            $labels->put($district['name'],$district['name']);
            $data1->put($district['name'],$malePerpetrators);
            $data2->put($district['name'],$femalePerpetrators);
            //dd($data1);
        }
        //dd($data2->all());
        $chart = new ReportChart;
        $chart->labels($labels->values());
        $chart->dataset('Male', 'bar', $data1->values())->options([
            'plugins' => [
                'colorschemes' => ['scheme' => 'tableau.Tableau10']
            ],
        ]);
        //$chart->labels(['District']);
        $chart->dataset('Female', 'bar', $data2->values())->options([
            'plugins' => [
                'colorschemes' => ['scheme' => 'tableau.Tableau10']
            ],
        ]);
        
        /* $chart->labels($data1->keys());
        $chart->dataset('Perpetrators by Gender', 'bar', $data1->values())->options([
            'plugins' => [
                'colorschemes' => ['scheme' => 'tableau.Tableau10']
            ],
        ]); */
        $chart->displayAxes(true);
        

        return view('posts.reports-perpetrators-gender',compact('chart'));

    }

    public function reportsPerpetratorsIncidents() {
        //$districts = District::withCount(['posts'])->get()->toArray();
        $districts = Post::select('responsible', DB::raw('count(*) as posts_count'))
        ->where('responsible','!=','')->groupBy('responsible')
        ->get()->toArray();
        //dd($districts);
        $data1 = collect([]);
        foreach($districts as $key => $district){
            
            $data1->put($district['responsible'] , $district['posts_count']);
        }
        //dd($data->values());
        $chart = new ReportChart;
        //$chart->labels(['Political Party Supporters','Candidates']);
        /*$chart->dataset('Perpetrators', 'bar', [34, 43])->options([
            'plugins' => [
                'colorschemes' => ['scheme' => 'tableau.Tableau10']
            ],
        ]); */
        //$chart->labels(['District']);
        
        
        $chart->labels($data1->keys());
        $chart->dataset('Perpetrators of Incidents', 'bar', $data1->values())->options([
            'plugins' => [
                'colorschemes' => ['scheme' => 'tableau.Tableau10']
            ],
        ]);
        $chart->displayAxes(true);
        

        return view('posts.reports-perpetrators-incidents',compact('chart'));

    }

    public function reportsImpactIncidents() {
        // Pie Chart
        $victims = Post::select('impact', DB::raw('count(*) as posts_count'))
        ->where('impact','!=','')->groupBy('impact')
        ->get()->toArray();
        //dd($victims);
        $data3 = collect([]);
        foreach($victims as $key => $victim){
            
            $data3->put($victim['impact'] , $victim['posts_count']);
        }
        //dd($data3->values());
        $chart3 = new ReportChart;
        //$chart3->labels(['Campain Rally Disrupted', 'Voting Cancelled']);
        /*$chart3->dataset('Incidents Impact', 'pie', [1, 24])->options([
            'plugins' => [
                'colorschemes' => ['scheme' => 'tableau.Tableau10']
            ],
        ]);*/
      $chart3->labels($data3->keys());
        $chart3->dataset('Incidents Impact', 'pie', $data3->values())->options([
            'plugins' => [
                'colorschemes' => ['scheme' => 'tableau.Tableau10']
            ],
        ]); 
        $chart3->title("Impact of Incidents");
        $chart3->displayAxes(false,false);
        return view('posts.reports-impact-incidents',compact('chart3'));
    }

    public function reportsIncidentsDays() {
        $districts = Post::select('post_date', DB::raw('count(*) as posts_count'))
        ->where('post_date','!=','')->groupBy('post_date')->orderBy('post_date')
        ->get()->toArray();
        $data1 = collect([]);
        foreach($districts as $key => $district){
            
            $data1->put($district['post_date'] , $district['posts_count']);
        }
        $chart = new ReportChart;

        $chart->labels($data1->keys());
        $chart->dataset('Incidents', 'line', $data1->values())->options([
            'plugins' => [
                'colorschemes' => ['scheme' => 'tableau.Tableau10']
            ],
        ]); 
        
        $chart->displayAxes(true);
        

        return view('posts.reports-incident-over-days',compact('chart'));

    }

    public function reportsLocationOfIncidents() {
        $districts = Post::select('where_happened', DB::raw('count(*) as posts_count'))
        ->where('where_happened','!=','')->groupBy('where_happened')
        ->get()->toArray();
        //dd($districts);
        $data1 = collect([]);
        foreach($districts as $key => $district){
            
            $data1->put($district['where_happened'] , $district['posts_count']);
        }
        //dd($data->values());
        $chart = new ReportChart;        
        $chart->labels($data1->keys());
        $chart->dataset('Location of Incidents', 'bar', $data1->values())->options([
            'plugins' => [
                'colorschemes' => ['scheme' => 'tableau.Tableau10']
            ],
        ]);
        $chart->displayAxes(true);
        

        return view('posts.reports-incidents-locations',compact('chart'));

    }

    public function reportsResponsesTaken() {
        $districts = Post::select('nature_of_response', DB::raw('count(*) as posts_count'))
        ->where('nature_of_response','!=','')->groupBy('nature_of_response')
        ->get()->toArray();
        $data1 = collect([]);
        foreach($districts as $key => $district){
            
            $data1->put($district['nature_of_response'] , $district['posts_count']);
        }
        //dd($data->values());
        $chart = new ReportChart;
        
        $chart->labels($data1->keys());
        $chart->dataset('Nature of Responses Taken', 'bar', $data1->values())->options([
            'plugins' => [
                'colorschemes' => ['scheme' => 'tableau.Tableau10']
            ],
        ]); 
        $chart->displayAxes(true);
        

        return view('posts.reports-responses-taken', compact('chart'));

    }

    public function mapsData () {

        $client = new \GuzzleHttp\Client();

        $geocoder = new \Spatie\Geocoder\Geocoder($client);

        $geocoder->setApiKey(config('geocoder.key'));

        $posts = Post::with('postType','district')->orderBy('post_date', 'DESC')->orderBy('location')->get();
        //dd($posts);
        $cords = array();
        foreach($posts as $key => $post) {
            if(isset($post->location)) {
                $latlong = $geocoder->getCoordinatesForAddress($post->location);
                $cords[$key][] = $latlong["lat"];
                $cords[$key][] = $latlong["lng"];
                $cords[$key][] = "<h5><a href='".route('posts.show',$post->id)."'>" . $post->postType->name . "</a></h5><p>$post->location</p>";
            }
        }
        return json_encode($cords);

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
        return redirect()->to('posts/data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
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
