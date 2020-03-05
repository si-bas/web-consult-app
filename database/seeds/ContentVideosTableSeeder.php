<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

# Models
use App\Models\Content\Video;

class ContentVideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path('videos');

        $files_in_folder = File::files($path);        

        foreach($files_in_folder as $key => $file_object) { 
            $file = pathinfo($file_object);
            
            Video::create([
                "code" => $key+1,
                "title" => 'Video Inspirasi #'.($key+1),
                "path" => 'videos/',
                "filename" => $file['basename'],
                "is_required" => true,
            ]);
        } 
    }
}
