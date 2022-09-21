<?php

namespace App\Http\Controllers;
use App\Models\Tag;

use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(5);
        return view('tags.index' , compact('tags'));
    }

    public function create()
    {       
        return view('tags.create');
    }

    public function store(Request $request)
    {       
       
        $request->validate([
            'tag' => ['required', 'string', 'max:255'],
        ]);

        $tag = Tag::create([
            'name' => $request->tag,
          
        ]);

        return redirect()->route('tags');
    }
}
