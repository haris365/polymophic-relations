<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Video Create') }}

        </h2>  
    </x-slot>   
    <div class="py-10">        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">           
                <div class="p-6 bg-white border-b border-gray-200">                 

                    <form method="POST" action="{{ route('tags.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Tag Title</label>
                            <input name="tag" type="text" class="form-control" id="title" aria-describedby="title" placeholder="Plese enter tag name" />
                        </div>
                        

                        <button type="submit" class="btn btn-success">Upload</button>
                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>