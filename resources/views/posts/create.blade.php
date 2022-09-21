<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Create') }}
        </h2>  
    </x-slot>   
    <div class="py-10">        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">  
                   
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(count($errors) > 0)
                        @include('errors.index')
                    @endif
                    <x:post-form :action="route('posts.store')" :tags="$tags">
                        <input class="form-control mb-4" name="image" type="file" id="image" />
                        <label>Tag</label>
                        <select class="form-control" multiple name="tags[]">
                            @foreach ($tags as $tag )
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach                                   
                        </select>
                        <br/><br/>
                        <input type="hidden" value="App\Models\Post" name="model"/>
                        <button type="submit" class="btn btn-success">Save</button>
                    </x:post-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>