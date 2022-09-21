<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Polymorphic Relationships One To One (Posts , User & Images)') }}
            <a href="{{ route('posts.create') }}" class="btn btn-success float-right">+ Post</a>

        </h2>  
    </x-slot>   
    <div class="py-10">        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">           
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                       @foreach ($posts as $post )
                        <div class="p-2 m-2">
                            <li><strong>Id:</strong> {{$post->id}}</li>
                            <li><strong>Title:</strong> {{$post->title}}</li>
                            <li><strong>Description:</strong> {{$post->body}}</li>
                            @if($post->image)<li><strong>Image:</strong> <img  class="mb-2" width="50px" src="{{ asset($post->image->url) }}"></img>@endif
                            
                            <a class="btn btn-sm btn-warning" href="{{route('posts.edit',[$post->id])}}">
                                <i class="fa fa-trash"></i>&nbsp;Edit
                            </a>
                            <a onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger" href="{{route('posts.delete',[$post->id])}}">
                                <i class="fa fa-trash"></i>&nbsp;Delete
                            </a>
                            <ul>
                            <strong>Comments</strong>
                                @foreach ($post->comments as $comment )
                                    <li style="list-style: disc !important">{{$comment->body}}</li>
                                @endforeach
                               
                            </ul> 

                            <ul>
                            <strong>Tags</strong>
                                @foreach ($post->tags as $tag )
                                    <li style="list-style: disc !important">{{$tag->name}}</li>
                                @endforeach
                               
                            </ul> 
                            
                            <li>
                                <strong>Leave a comment:</strong> 
                                <form action="{{route('comments.store', $post->id)}}" method="post">
                                    @csrf

                                    <input type="text" placeholder="please enter text" class="form-control" name="comment">
                                    <input type="hidden" value="App\Models\Post" name="model">
                                    <input type="hidden" value="{{$post->id}}" name="model_id">

                                </form>

                               
                            </li>
                            <hr>
                        </div>
                         
                       @endforeach

                       {{ $posts->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>