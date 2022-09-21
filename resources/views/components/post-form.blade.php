<form method="POST" action="{{ $attributes->get('action')}}" enctype="multipart/form-data">
        @if(isset($post))         
            @csrf
            @method('PATCH')
        @else   
            @csrf           
        @endif
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        @if(isset($post))         
            <input value="{{$post ? $post->title : ''}}" name="title" type="text" class="form-control" id="title" aria-describedby="title"/>
        @else       
       
            <input name="title" type="text" class="form-control" id="title" aria-describedby="title" placeholder="Plese enter name" />
        @endif
    </div>
   
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        @if(isset($post))         
        <textarea type="text" name="body" class="form-control" id="" placeholder="Do you have any previous publishing experience? (100 words)">{{$post ? $post->title : ''}} </textarea>
        @else       
       
        <textarea type="text" name="body" class="form-control" id="" placeholder="Do you have any previous publishing experience? (100 words)"></textarea>
        @endif
    </div>
    
    @if(isset($post->tags))

        <label>Selected Tags:</label>
        @foreach ($post->tags as $tag )
            <span class="badge bg-success">{{$tag->name}}</span>
        @endforeach 
   
  
    <select class="form-control" multiple name="tags[]">
            
        <option>--Please Choose Another Tag--</option>
        @foreach ($tags as $tag )
            <option value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach      
    </select><br/><br/>
    @endif
{{ $slot }}   
</form>
