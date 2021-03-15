<div>
    <!-- component -->
    <div class="bg-gray-100 min-h-screen overflow-x-hidden">

        <div class="px-6 py-8">
            <div class="flex justify-between container mx-auto">
                <div class="w-full lg:w-8/12">
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-bold text-gray-700 md:text-2xl">文章</h1>

                    </div>
                    @foreach($posts as $post)
                        <livewire:post :post="$post" :key="$post->id"/>
                    @endforeach
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                </div>
                <div class="-mx-8 w-4/12 hidden lg:block">
                    <div class="flex flex-col">
                        <div>
                            <h1 class="text-xl font-bold text-gray-700 md:text-2xl">标签</h1>
                        </div>
                        <div class="mt-6">
                            <livewire:tag/>

                        </div>
                    </div>
                    <div class="mt-10">
                        <h1 class="mb-4 text-xl font-bold text-gray-700">文章推荐</h1>
                        <div class="flex border border-gray-300 shadow-md bg-gray-200 flex-col bg-white p-2 rounded-lg shadow-md">
                            <livewire:post-recommend/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
