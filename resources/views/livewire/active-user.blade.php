<div tabindex="-1" role="option" class="relative"
     @click="$dispatch('hidden-current-chat');$dispatch('display-current-chat-{{$user->id}}');$wire.markRead('active-user','mark-read-{{$channel}}')"
>
    <div class="flex items-center px-1 py-2">
        <div class="relative">
            <img src="{{$user->profile_photo_url}}" alt="" class="h-10 w-10  overflow-hidden object-cover">
            <span class="absolute -top-1 -right-1 inline-flex
             text-white  rounded-full h-4 w-4 bg-red-500
              text-xs items-center justify-center">{{$message_list->whereNull('read_at')->where('to',auth()->id())->count()}}</span>
        </div>

        <div>
            <div class="ml-3 font-normal truncate">{{$user->name}}</div>
            <div class="ml-3 xl:text-xs truncate text-gray-500 w-40">
                <span class="truncate">{{$message_list->last()->message ?? ''}}</span>
            </div>
        </div>
    </div>
    <span class="absolute inset-y-0 right-0 flex items-center pr-4"></span>
</div>
