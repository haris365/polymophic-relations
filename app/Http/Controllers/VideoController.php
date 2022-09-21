<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Taggable;
use App\Models\Video;
use Illuminate\Support\Facades\File; 

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
       
        $videos = Video::with('tags')->orderBy('id', 'DESC')->paginate(5);  
                 
        return view('videos.index', compact('videos'));
    }

    public function create()
    {   
        $tags = Tag::all();                            
        return view('videos.create' ,compact('tags'));
    }

    public function store(Request $request)
    {    
        $request->validate([
            'title' => ['required', 'string', 'max:255'],           
            'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
            'tags' => ['required'],
        ]);

        if($request->hasFile('video')){            
            $video_path = $request->file('video')->store('videos', 'public');          
            $video = Video::create([
                'title' => $request->title,
                'url' => $video_path,          
            ]);    
            
            if($request->tags)
            {
                foreach($request->tags as $tag)
                {           
                    Taggable::create([
                        'tag_id' => $tag,
                        'taggable_type' => $request->model,
                        'taggable_id' => $video->id,
                    ]);
                }            
            }
        }
    
        return redirect()->route('videos');
    }

    public function destroy(Video $video)
    {   
          
        if($video)
        {
        
            $video_base_name = basename($video->url); 
            
            $file_path = public_path().'/videos/'.$video_base_name;            
            dd(unlink($file_path));
            $path = storage_path('videos/'.$video_base_name);
            // dd($path);
         
            if(storage_path($video->url)){                               
                unlink($path);                   
            }else{    
                dd('File does not exists.');    
            }   
            dd('dddddd');        
          
          
           
            
        }
          dd('fs');  
        $post->delete();                          
        return redirect()->route('posts');
    }

    public function edit(Post $post)
    {    
        dd('5');                        
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post , Request $request)
    {    
        dd('6');
        dd($request->all());

        return redirect()->route('posts');
    }
}
