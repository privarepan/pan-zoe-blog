<div class="flex  bg-gray-100"
    x-data="{star : {{json_encode($post->starWithAuth)}} }">
    <div class="flex py-6 w-full min-h-screen space-x-4">
        <div class="flex w-1/5 justify-end ">
            <div class="flex flex-col fixed bg-white divide-y divide-gray-300 rounded-lg">
                <div class="flex w-12 h-14 justify-center items-center cursor-pointer"
                     wire:loading.class="cursor-wait"
                     wire:click="star">
                    <div class="flex justify-center items-center  flex-col py-2" wire:target="star">
                        <svg t="1614739433530" :class="star?'text-red-500':'text-gray-400'" class="w-5 h-5" fill="currentColor" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6371" width="200" height="200"><path d="M934.528 410.154667S1002.666667 404.48 1002.666667 475.733333c0 0 0 102.528-100.736 447.189334 0 0-31.232 101.12-69.546667 101.12H425.130667c-28.373333 0-100.736-19.2-100.736-72.618667V410.154667s201.472-149.546667 201.472-340.352C531.541333 59.818667 515.968 0 591.146667 0c0 0 177.408 19.925333 72.362666 410.154667h271.018667zM212.181333 409.6s40.064-0.512 40.064 41.429333v549.973334s0.256 22.997333-28.16 22.997333h-136.533333s-33.621333 0-33.621333-34.773333L21.333333 442.752S21.845333 409.6 54.442667 409.6h157.696z" p-id="6372"></path></svg>
                        <span class="text-gray-400">{{$post->star_count}}</span>
                    </div>
                </div>
                <div class="flex w-12 h-14 justify-center items-center cursor-pointer">
                    <div class="flex justify-center items-center flex-col py-2" @click="$dispatch('comment')">
                        <svg t="1614738966132" class="text-gray-400 w-5 h-5" fill="currentColor" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2679" width="200" height="200"><path d="M949.570847 212.673727l-41.801035 41.517579L768.565377 115.843378l41.801035-41.459251c15.340383-15.283078 39.522132-16.084327 53.892421-1.768273l87.024006 86.454024C965.710432 173.382862 964.91123 197.393719 949.570847 212.673727L949.570847 212.673727zM580.373227 579.594491 441.169815 441.244516l306.238706-304.299541 139.205459 138.348951L580.373227 579.594491 580.373227 579.594491zM560.984644 598.869486l-194.863083 55.314817 55.659671-193.666838L560.984644 598.869486 560.984644 598.869486zM236.551554 178.118724c-48.13223 0-87.081311 38.949081-87.081311 87.024006l0 522.372232c0 48.062646 38.962384 87.026052 87.026052 87.026052l522.485819 0c48.063669 0 87.028099-38.963407 87.028099-87.028099L846.010213 439.248046l87.079264-87.028099 0 464.321094c0 80.124875-64.954361 145.078213-145.078213 145.078213L207.468169 961.619254c-80.124875 0-145.078213-64.954361-145.078213-145.078213L62.389956 236.114602c0-80.124875 64.954361-145.078213 145.078213-145.078213l464.435705 0-87.083357 87.083357L236.551554 178.119747 236.551554 178.118724z" p-id="2680"></path></svg>
                        <span class="text-gray-400">{{$post->comment_count}}</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="w-3/5 space-y-4">
            <!-- component -->
            <!-- This is an example component -->
            <div class="max-w-full p-4 bg-white rounded-lg shadow-md">
                <div class="flex justify-between">
                    <span class="font-light text-gray-600">{{$post->created_at->diffForHumans(now())}}</span>
                    <div class="flex justify-end items-center space-x-1">
                        @foreach($post->tag as $tag)
                            <a href="#" class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500">{{$tag->name}}</a>
                        @endforeach
                    </div>
                </div>

                <div class="mt-2">
                    <a href="#" class="text-2xl text-gray-700 font-bold hover:underline">
                        {{$post->title}}
                    </a>
                    <p class="mt-2 text-gray-600">{!! $post->content !!}</p>
                </div>

            </div>

            <div class="flex w-full p-2 rounded-md bg-white items-center justify-start">
                <div class="p-1 w-24 text-gray-500">{{$post->star_count}}人点赞</div>
                <div class="w-auto max-w-full">
                    @foreach($post->star as $star)
                        @if($loop->iteration < 10)
                        <img class="inline-block object-cover w-8 h-8 text-white border-2 border-white rounded-full shadow-sm cursor-pointer" src="{{$star->user->profile_photo_url}}" alt="">
                        @endif
                    @endforeach
                </div>

            </div>

            <div class="antialiased w-full bg-white p-4" x-data="{ modal:{{json_encode($modal)}}}">
                <h3 class="mb-4 text-lg font-semibold text-gray-900">评论</h3>
                <div class="space-y-4 h-full">
                @foreach($post->comment as $comment)
                    <livewire:post-comment :comment="$comment" :key="'comment-'.$comment->id"/>
                @endforeach
                </div>
            </div>

            <div class="w-full flex space-x-4 h-10 relative">
                <x-jet-input class="w-1/2 border" wire:model.defer="content" x-ref="reply" @comment.window="$refs.reply.focus()"/>
                <x-jet-input-error for="content" class="absolute -top-4"/>
                <x-jet-button wire:click="comment"  class="w-20 justify-center bg-red-500">评论</x-jet-button>
            </div>
        </div>

        <x-jet-confirmation-modal wire:model="modal.show">
            <x-slot name="title">{{$modal['title']}}</x-slot>
            <x-slot name="content">{{$modal['content']}}</x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button @click="show=false" wire:loading.attr="disabled">
                    取 消
                </x-jet-secondary-button>

                <x-jet-button class="ml-2" dusk="confirm-password-button" wire:click="$emitTo('{{$modal['component']}}','destroy:{{$modal['id']}}')" wire:loading.attr="disabled">
                    确 认
                </x-jet-button>
            </x-slot>
        </x-jet-confirmation-modal>

        <div class="w-1/5">
            <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden">
                <img class="w-full h-56 object-cover object-center" src="{{$post->user->profile_photo_url}}" alt="avatar">
                <div class="py-4 px-6">
                    <h1 class="text-2xl font-semibold text-gray-800">{{$post->user->name}}</h1>
                    <p class="py-2 text-lg text-gray-700">这家伙很懒什么也没留下,我劝你好好做个人吧</p>
                    <div class="flex items-center mt-4 text-gray-700">
                        <svg class="h-6 w-6 fill-current" viewBox="0 0 512 512">
                            <path d="M437.332 80H74.668C51.199 80 32 99.198 32 122.667v266.666C32 412.802 51.199 432 74.668 432h362.664C460.801 432 480 412.802 480 389.333V122.667C480 99.198 460.801 80 437.332 80zM432 170.667L256 288 80 170.667V128l176 117.333L432 128v42.667z"/>
                        </svg>
                        <h1 class="px-2 text-sm">{{$post->user->email}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


