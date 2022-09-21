<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

use App\Models\Image;
use App\Models\Tag;
use App\Models\Taggable;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['image','comments','tags'])->orderBy('id', 'DESC')->paginate(5);                 
        return view('posts.index', compact('posts'));
    }

    public function create()
    {         
        $tags = Tag::all();               
        return view('posts.create', compact('tags'));
    }

    public function store(PostRequest $request)
    {                
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,          
        ]);
        $postService = new ImageService($post);

        if($request->image)
        {
            //Method 1 => Passing with parameter
            // (new postService())->getImage($request->file('image'),$post);

             //Method 2 => Passing parameter into constructor
            $postService->getImage($request->file('image'));
        }
       
        if($request->tags)
        {
           foreach($request->tags as $tag)
           {           
            Taggable::create([
                'tag_id' => $tag,
                'taggable_type' => $request->model,
                'taggable_id' => $post->id,
            ]);
           }
           
        }        
        return redirect()->route('posts');
    }

    public function destroy(Post $post)
    {       
                 
        if($post->image)
        {
            $image  = Image::where('imageable_type','App\Models\Post')->where('imageable_id' , $post->id)->first();
            $imageable_url = basename($image->url);
            $path = public_path('storage/image/'.$imageable_url);
            
            if(storage_path($image->url)){                               
                unlink($path);                   
            }else{    
                dd('File does not exists.');    
            }           
            $post->image()->delete();
        }
            
        $post->delete();                          
        return redirect()->route('posts');
    }

    public function edit(Post $post)
    {                   
        $tags = Tag::all();
        return view('posts.edit', compact('post','tags'));
    }

    public function update(Post $post , PostRequest $request)
    {  
        // dd($request->all());                 
        // $post->update([
        //     'title' => $request->title,
        //     'body' => $request->body,          
        // ]);
        // $postService = new ImageService($post);

        // if($request->image)
        // {
        //     //Method 1 => Passing with parameter
        //     // (new postService())->getImage($request->file('image'),$post);

        //      //Method 2 => Passing parameter into constructor
        //     $postService->getImage($request->file('image'));
        // }
       
        if($request->tags)
        {               
            foreach($post->tags as $tag)
            {                                 
                $tabbable = Taggable::where('tag_id',$tag->id)->first();
                if($tabbable)
                {
                    $tabbable->delete();
                }
                
            }

           foreach($request->tags as $tag)
           {           
            Taggable::create([
                'tag_id' => $tag,
                'taggable_type' => $request->model,
                'taggable_id' => $post->id,
            ]);
           }
           
        }        
        return redirect()->route('posts');
    }

    
}


