<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Polymorphic Relationships One To Many (Posts , Videos & Comments)') }}
            <a href="{{ route('videos.create') }}" class="btn btn-success float-right">+ Video</a>
        </h2>  
    </x-slot>   
  

    <div class="py-10">        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">           
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                       @foreach ($videos as $video) 
                                     
                        <div class="p-2 m-2">
                            <li><strong>Name:</strong>{{$video->title}}</li>

                            <video width="320" height="240" controls>
                                <source src="{{ asset($video->url) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video> 
                            <br> 

                            <a class="btn btn-sm btn-warning" href="{{route('videos.edit',[$video->id])}}">
                                <i class="fa fa-trash"></i>&nbsp;Edit
                            </a>
                            <a onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger" href="{{route('videos.delete',[$video->id])}}">
                                <i class="fa fa-trash"></i>&nbsp;Delete
                            </a>
                         
                            @if($video->comments->count() > 0)
                            <ul>
                                <strong>Comments</strong>
                                @foreach ($video->comments as $comment )
                                    
                                    <li style="list-style: disc !important">{{$comment->body}}</li>
                                @endforeach
                               
                            </ul> 
                            @endif
                            @if($video->tags->count() > 0)
                            <ul>
                            <strong>Tags</strong>
                                @foreach ($video->tags as $tag )
                                    <li style="list-style: disc !important">{{$tag->name}}</li>
                                @endforeach
                               
                            </ul> 
                            @endif
                            
                            <li>
                                <strong>Leave a comment:</strong> 
                                <form action="{{route('comments.store',$video->id)}}" method="post">
                                    @csrf

                                    <input type="text" placeholder="please enter text" class="form-control" name="comment">
                                    <input type="hidden" value="App\Models\Video" name="model">
                                    <input type="hidden" value="{{$video->id}}" name="model_id">


                                </form>
                            </li>
                            <hr>
                        </div>
                         
                       @endforeach

                       {{ $videos->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>