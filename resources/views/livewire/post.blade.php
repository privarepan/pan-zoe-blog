<div class="mt-6">
    <div class="max-w-4xl px-10 py-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between">
            <span class="font-light text-gray-600">{{$post->created_at->diffForHumans(now())}}</span>
            <div class="flex justify-end items-center space-x-1">
                @foreach($post->tag as $tag)
                    <a href="?tag={{$tag->name}}" class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500">{{$tag->name}}</a>
                @endforeach
            </div>
        </div>
        <div class="mt-2">
            <a href="{{route('post.show',['post' => $post->id])}}" class="text-2xl text-gray-700 font-bold hover:underline">
                {{$post->title}}
            </a>
            <p class="mt-2 text-gray-600 truncate">{!! $post->wrap_content !!}</p>
        </div>
        <div class="flex justify-between items-center mt-4">
            <a href="{{route('post.show',['post' => $post->id])}}" class="text-blue-500 hover:underline">查看</a>
            <div>
                <a href="#" class="flex items-center">
                    <img src="{{$post->user->profile_photo_url}}"
                         alt="avatar" class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block">
                    <h1 class="text-gray-700 font-bold hover:underline">{{$post->user->name}}</h1>
                </a>
            </div>
        </div>
    </div>
</div>
