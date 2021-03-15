<div class="flex antialiased text-gray-800" x-data>
    <div class="flex flex-row h-full w-full">
        <div class="flex flex-col py-8 pl-6 pr-2 w-64 bg-white flex-shrink-0">
            <div class="flex flex-row items-center justify-center h-12 w-full">
                <div
                    class="flex items-center justify-center rounded-2xl text-indigo-700 bg-indigo-100 h-10 w-10"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
                        ></path>
                    </svg>
                </div>
                <div class="ml-2 font-bold text-2xl">QuickChat</div>
            </div>
            <div
                class="flex flex-col items-center bg-indigo-100 border border-gray-200 mt-4 w-full py-6 px-4 rounded-lg"
            >
                <div class="h-20 w-20 rounded-full border overflow-hidden">
                    <img
                        src="{{auth()->user()->profile_photo_url}}"
                        alt="Avatar"
                        class="h-full w-full"
                    />
                </div>
                <div class="text-sm font-semibold mt-2">{{auth()->user()->name}}</div>
                <div class="text-xs text-gray-500">{{auth()->user()->email}}</div>
                <div class="flex flex-row items-center mt-3">
                    <div class="h-3 w-3 bg-green-500 rounded-full self-end mr-1"></div>
                    <div class="leading-none ml-1 text-xs">在线</div>
                </div>
            </div>
            <div class="flex flex-col mt-8" style="height: 27.1rem">
                <div class="flex flex-row items-center justify-between text-xs">
                    <span class="font-bold">活跃对话</span>
                    <span class="flex items-center justify-center bg-gray-300 h-4 w-4 rounded-full">{{$this->users->count()}}</span>
                </div>
                <div class="flex flex-col space-y-1 mt-4 -mx-2 overflow-y-auto">
                    @foreach($this->users as $user)
                        <livewire:active-user :user="$user" :key="'active-user-'.$user->id"/>

                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-col flex-auto h-full p-6">
            <div
                class="flex flex-col flex-auto flex-shrink-0 rounded-2xl h-full p-4"
            >
                @foreach($users as $user)
                    <livewire:chat-panel :user="$user" :key="'chat-panel-'.$user->id"/>
                @endforeach
            </div>

        </div>
    </div>
</div>
