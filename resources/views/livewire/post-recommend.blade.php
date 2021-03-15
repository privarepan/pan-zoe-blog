<div class="flex">
    <ul class="w-full space-y-2">
        @foreach($posts as $post)
        <li ><a href="{{route('post.show',['post' => $post->id])}}" class="hover:underline hover:text-blue-600 hover:font-bold">{{$post->title}}</a></li>
        @endforeach
    </ul>
</div>
