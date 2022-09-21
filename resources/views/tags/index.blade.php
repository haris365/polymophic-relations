<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Polymorphic Relationships Many To Many (Posts , Videos , Tags & Comments)') }}
            <a href="{{ route('tags.create') }}" class="btn btn-success float-right">+ Tag</a>
        </h2>  
    </x-slot>   
  

    <div class="py-10">        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">           
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                       @foreach ($tags as $tag) 
                                     
                        <div class="p-2 m-2">
                            <li><strong>Tag:</strong>{{$tag->name}}</li>

                           

                            <a class="btn btn-sm btn-warning" href="{{route('tags.edit',[$tag->id])}}">
                                    <i class="fa fa-trash"></i>&nbsp;Edit
                                </a>
                                <a onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger" href="{{route('tags.delete',[$tag->id])}}">
                                    <i class="fa fa-trash"></i>&nbsp;Delete
                                </a>      
                         
                                                        
                            <hr>
                        </div>
                         
                       @endforeach

                       {{ $tags->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>