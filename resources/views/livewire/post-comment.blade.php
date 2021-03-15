<div class="flex">
    <div class="flex-shrink-0 mr-3">
        <img class="mt-2 rounded-full w-8 h-8 sm:w-10 sm:h-10" src="{{$comment->user->profile_photo_url}}" alt="">
    </div>
    <div class="flex-1 border rounded-lg px-4 space-y-2 sm:px-6 sm:py-4 leading-relaxed">
        <strong>{{$comment->user->name}}</strong>
        <span class="text-xs text-gray-400">{{$comment->created_at}}</span>
        <p class="text-sm">
            {{$comment->content}}
        </p>
        <div class="flex items-center">
            <div class="flex items-center justify-center space-x-2">
                <div class="text-sm text-gray-500 font-semibold">
                    {{$comment->reply_count}} <a href="javascript:;" class="text-blue-500" wire:click="replyToComment('{{$comment->user_id}}')">回复</a>
                </div>

                <div class="cursor-pointer">
                    <div class="flex justify-center items-center flex-col py-2">
                        <svg t="1614738966132" class="text-gray-400 w-5 h-5" fill="currentColor" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2679" width="200" height="200"><path d="M949.570847 212.673727l-41.801035 41.517579L768.565377 115.843378l41.801035-41.459251c15.340383-15.283078 39.522132-16.084327 53.892421-1.768273l87.024006 86.454024C965.710432 173.382862 964.91123 197.393719 949.570847 212.673727L949.570847 212.673727zM580.373227 579.594491 441.169815 441.244516l306.238706-304.299541 139.205459 138.348951L580.373227 579.594491 580.373227 579.594491zM560.984644 598.869486l-194.863083 55.314817 55.659671-193.666838L560.984644 598.869486 560.984644 598.869486zM236.551554 178.118724c-48.13223 0-87.081311 38.949081-87.081311 87.024006l0 522.372232c0 48.062646 38.962384 87.026052 87.026052 87.026052l522.485819 0c48.063669 0 87.028099-38.963407 87.028099-87.028099L846.010213 439.248046l87.079264-87.028099 0 464.321094c0 80.124875-64.954361 145.078213-145.078213 145.078213L207.468169 961.619254c-80.124875 0-145.078213-64.954361-145.078213-145.078213L62.389956 236.114602c0-80.124875 64.954361-145.078213 145.078213-145.078213l464.435705 0-87.083357 87.083357L236.551554 178.119747 236.551554 178.118724z" p-id="2680"></path></svg>
                    </div>
                </div>

                <div class="cursor-pointer" wire:click="$emitUp('showModal',{{$comment->id}},'{{$comment->content}}')">
                    <div class="flex justify-center items-center flex-col py-2">
                        <svg t="1614922928158" class="text-gray-400 w-5 h-5" fill="currentColor" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1838" width="200" height="200"><path d="M798.1 872.6c0 34.3-27.9 62.2-62.1 62.2H288.1c-34.3-0.1-62.1-27.9-62.2-62.2V212.8h572.2v659.8zM350.2 101.2c0-7.2 5.6-12.8 12.8-12.8h298.8c7.2 0 12.7 5.6 12.7 12.8v37.5H350.2v-37.5z m634.3 37.5H748.7v-37.5c0-47.8-39-86.9-86.9-86.9H363c-47.9 0.1-86.8 38.9-86.9 86.9v37.5H39.5C18.7 138.7 2 155.4 2 176.1s16.7 37.5 37.5 37.5H151v659c0 75.7 61.4 137.1 137.1 137.1h447.8c75.7 0 137.1-61.4 137.1-137.1V212.8h111.6c20.7 0 37.5-16.7 37.5-37.5s-16.8-36.6-37.6-36.6zM512 822.4c20.7 0 37.5-16.7 37.5-37.5V386.5c0-20.7-16.7-37.5-37.5-37.5-20.7 0-37.5 16.7-37.5 37.5v398.4c0 20.7 16.8 37.5 37.5 37.5m-174.5 0c20.7 0 37.5-16.7 37.5-37.5V386.5c0-20.7-16.7-37.5-37.5-37.5-20.7 0-37.5 16.7-37.5 37.5v398.4c0.8 20.7 17.6 37.5 37.5 37.5m349 0c20.7 0 37.5-16.7 37.5-37.5V386.5c0-20.7-16.7-37.5-37.5-37.5-20.7 0-37.5 16.7-37.5 37.5v398.4c0.1 20.7 16.8 37.5 37.5 37.5" p-id="1839"></path></svg>
                    </div>
                </div>
            </div>

        </div>

        <div class="w-full flex space-x-4 h-10 relative">
            <x-jet-input class="w-1/2 border" wire:model.defer="content" x-ref="reply" @reply-point.window="$refs.reply.scrollIntoView()"/>
            <x-jet-input-error for="content" class="absolute -top-4"/>
            <x-jet-button wire:click="reply" class="w-20 justify-center bg-red-500">评论</x-jet-button>
        </div>

        <div class="flex w-full">
            <div class="space-y-4 w-full divide-y">
                @foreach($comment->reply as $reply)
                    <livewire:post-comment-reply :reply="$reply"  :key="'reply-'.$reply->id"/>
                @endforeach
            </div>

        </div>
    </div>

</div>


