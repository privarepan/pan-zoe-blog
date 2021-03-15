<div class="flex items-center">
    <div class="relative w-96">
        <input type="text" wire:model.debounce.150ms="search" class="w-full rounded-md" placeholder="搜索">
            <div
                x-data="{ show: @entangle('show')}"
                x-show="show"
                class="absolute shadow bg-white mt-2 top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto"
                @click.away="show = false"
            >
                <div class="flex flex-col w-full">
                    @foreach($posts as $post)
                    <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100">
                        <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                            <div class="w-6 flex flex-col items-center">
                                <div class="flex relative w-5 h-5 bg-orange-500 justify-center items-center m-1 mr-2 w-4 h-4 mt-1 rounded-full ">
                                    <img class="rounded-full" alt="A" src="{{$post->user->profile_photo_url}}">
                                </div>
                            </div>
                            <div class="w-full items-center flex">
                                <div class="mx-2 -mt-1 ">
                                    <div class="py-2"><a class="hover:underline hover:text-pink-400" href="{{route('post.show',['post' => $post->id])}}">{{$post->title}}</a></div>
                                    <div class="text-xs truncate w-full h-10 normal-case font-normal -mt-1 text-gray-500 whitespace-normal truncate leading-5">{!! $post->wrap_content !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

    </div>

    <div class="px-2 w-10">
        <svg wire:loading wire:target="search" class="animate-spin -ml-1 mr-3 h-6 w-6 text-pink-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>



</div>
