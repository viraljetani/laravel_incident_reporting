<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Post;
use App\PostType;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\District;

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
        $header = [];
        foreach($collection as $row)
        {
            if($count==1) {
                $header = $row->toArray();
                $count=0;
            }
            else{
                $post[]=array_combine($header, $row->toArray());
                //dd($post[0]);
                $p = Post::withTrashed()->firstOrNew(['unique_record_number'=> $post[0]['Unique Record Number (URN)']]);
                $p->cso_name = $post[0]['CSO Name']; 
                $p->location = $post[0]['Location'];
                $date =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($post[0]['Date']);
                //dd();
                $p->post_date = $date->format('Y-m-d');
                $time = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($post[0]['Time']);
                //$time = $time->format('H:i');

               // dd();
                $p->post_time = $time->format('H:i');
                $p->details = $post[0]['Details of Incident'];
                $p->response_actions = $post[0]['Response Actions'];
                $p->responder_name = $post[0]['Responder Name'];
                $p->feedback_on_response = $post[0]['Feedback On Response'];
                $p->additional_follow_up = $post[0]['Additional Follow Up'];
                
                $d = District::firstOrNew(['name' => ucwords($post[0]['District'])]);
                $d->save();
                $p->district_id = $d->id;

                $pt = PostType::firstOrNew(['name' => ucwords($post[0]['Incident Type'])]);
                $pt->save();
                $p->post_type_id = $pt->id;

                $p->save();

                if ($p->trashed()) {
                    $p->restore();
                }

            }
            
           
        }
        //dd($data);
        
    }
}
