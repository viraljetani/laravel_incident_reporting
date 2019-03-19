<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Post;
use App\PostType;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\District;
use Illuminate\Support\Facades\Log;

class PostsImport implements ToCollection
{
    use SoftDeletes;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

        
        $post = [];
        $count = 1;
        //$recordCount = 0;
        $header = [];
        foreach($collection as $key => $row)
        { 

            if($count==1) {
                $header = $row->toArray();
                $count=0;
            }
            else{
                $post[] = array_combine($header, $row->toArray());
                //var_dump($post);
                //print_r($post[$key-1]); echo "<br><br>"; 
                if($post[$key-1]['Unique Record Number (URN)']) {
                    $p = Post::withTrashed()->firstOrNew(['unique_record_number' => intval($post[$key-1]['Unique Record Number (URN)'])]);
                    $p->cso_name = $post[$key-1]['CSO Name']; 
                    $p->location = $post[$key-1]['Location'];
                    
                    $date =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($post[$key-1]['Date']);
                    $p->post_date = $date->format('Y-m-d');
                    
                    $time = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($post[$key-1]['Time']);
                    $p->post_time = $time->format('H:i');

                    $p->details = $post[$key-1]['Details of Incident'];
                    $p->response_actions = $post[$key-1]['Response Actions'];
                    $p->responder_name = $post[$key-1]['Responder Name'];
                    $p->feedback_on_response = $post[$key-1]['Feedback On Response'];
                    $p->additional_follow_up = $post[$key-1]['Additional Follow Up'];
                    
                    $d = District::firstOrNew(['name' => ucwords($post[$key-1]['District'])]);
                    $d->save();
                    $p->district_id = $d->id;

                    $pt = PostType::firstOrNew(['name' => ucwords($post[$key-1]['Incident Type'])]);
                    $pt->save();
                    $p->post_type_id = $pt->id;

                    $p->save();

                    if ($p->trashed()) {
                        $p->restore();
                    }
                    // $recordCount++;
                }

            }
            
           
        }
        //dd($data);
        
    }
}
