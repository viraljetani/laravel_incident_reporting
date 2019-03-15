<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Common;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    public function event() {
        return $this->belongsTo(App\Event::class);
    }

    public function postType() {
        return $this->hasMany(App\PostType::class);
    }

    public static function ingest(Command $command)
    {

        // Get data
        $file = base_path() . '/database/seeds/import/Customer Master.CSV';
        
        //$tableColumns = ['customer_number', 'name', 'primary_contact_email', 'primary_contact_phone'];
        $posts = Common::getDataFromCSV($file);

        // Loop customer array
        foreach ($posts as $post) {

            // Update customer
            /* $p = Post::withTrashed()->firstOrNew(['customer_number' => $post['CustomerNo']]);
            $p->customer_number = $pustomer['CustomerNo'];
            $p->name = $pustomer['CustomerName'];
            $p->primary_contact_email = $pustomer['PrimaryContactEmail'];
            $p->primary_contact_phone = $pustomer['PrimaryContactPhone']; */
            $p->save();
            if ($p->trashed()) {
                $p->restore();
            }

        }

    }
}
