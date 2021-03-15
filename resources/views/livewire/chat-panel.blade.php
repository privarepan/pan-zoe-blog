<div x-data="{ show:false,scrollMark:true,typing_show:false }"

     x-init="$watch('show',value => { if(value) $nextTick(() => { $refs.scroll.scrollTop=$refs.scroll.scrollHeight })});
     Echo.private('chat.{{$channel}}').listenForWhisper('typing', (e) => {
                    typing_show=true
                }).listenForWhisper('no-typing',(e) => {
                    typing_show=false
                });"
     x-show="show" @hidden-current-chat.window="show=false"
     @display-current-chat-{{$user->id}}.window="show=true;" style="display: none">

    <p class="w-64 mx-auto text-center p-3">与{{$user->name}}的聊天<span
            style="display: none"
            x-show="typing_show"
            class="p-1 text-xs text-gray-500">对方正在输入...</span>
    </p>
    <div class="flex flex-col h-full space-y-10">
        <div class="flex flex-col overflow-y-auto"
             style="height: 35rem"
             @scroll="let dom = $refs.scroll;
              //标记用户移动了滚动条并且不在最底部 这样用户消息将不再滚动到最底部;
              if(dom.scrollHeight-dom.scrollTop !== dom.clientHeight) {
                scrollMark = false
              }else{
                scrollMark = true  //表示滚动条移动到了最底部;这样用户收到消息会自动滚动最底部
              }"
             x-ref="scroll" @scroll-{{$channel}}.window="
              if(typing_show) typing_show=false; //收到消息去掉正在输入的状态
              let dom = $refs.scroll;
              if(scrollMark){ //todo 只有滚动到底部才会持续在底部滚动
                $refs.scroll.scrollTop=$refs.scroll.scrollHeight
              }"
        >
            <div class="grid grid-cols-12 gap-y-2 bg-gray-100"
                 wire:init="latestMessage">
                @foreach($message_list as $message)
                    @if($message->from !== auth()->id())
                        <div class="col-start-1 col-end-8 p-3 rounded-lg">
                    <div class="flex flex-row items-center">
                        <div
                            class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0"
                        >
                            {{$message->fromUser->name}}
                        </div>
                        <div
                            class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl"
                        >
                            <div>
                                {{$message->message}}
                            </div>
                        </div>
                    </div>
                </div>
                    @else
                        <div class="col-start-6 col-end-13 p-3 rounded-lg">
                            <div class="flex items-center justify-start flex-row-reverse">
                                <div
                                    class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0"
                                >
                                    {{$message->fromUser->name}}
                                </div>
                                <div
                                    class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl"
                                >
                                    <div>{{$message->message}}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
        <div
            class="relative flex flex-row items-center h-10 rounded-xl bg-white w-full px-4"
        >
            <div class="flex-grow ml-4">
                <div class="relative w-full">
                    <input
                        type="text"
                        x-ref="input"
                        wire:model.defer="message"
                        wire:keydown.enter="submit"
                        @input.debounce.350ms="if($refs.input.value.length > 0){
                        Echo.private('chat.{{$channel}}').whisper('typing')
                    }else{
                        Echo.private('chat.{{$channel}}').whisper('no-typing')
                    }"
                        class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10"
                    />
                </div>
            </div>
            <x-jet-input-error class="absolute -top-5 " for="message"/>

            <div class="ml-4">
                <button wire:click="submit"
                        class="flex h-9 items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0"
                >
                    <span>发 送</span>
                    <span class="ml-2">
              <svg
                  class="w-4 h-4 transform rotate-45 -mt-px"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
              >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                ></path>
              </svg>
            </span>
                </button>
            </div>

        </div>
    </div>

</div>

<script>
    // document.addEventListener('')
</script>

