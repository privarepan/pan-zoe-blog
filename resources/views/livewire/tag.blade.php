<div class="grid grid-cols-3 text-base h-9 gap-4">
    @foreach($tags as $tag)
    <a  href="?tag={{$tag->name}}"
        class="rounded-md text-white flex items-center justify-center
        transition duration-200 ease-in-out bg-blue-600
        hover:bg-red-600 transform hover:-translate-y-1 hover:scale-110
        font-bold
    ">
        {{$tag->name}}
    </a>
    @endforeach
</div>
