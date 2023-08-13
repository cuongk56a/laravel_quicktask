<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Post Edit") }}
                </div>
            </div>
            <form action="{{ route('posts.update', ['post' => $post]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-4">
                    <x-input-label for="title" :value="__('Title')" />

                    <x-text-input id="title" class="block mt-1 w-full" 
                        type="text" 
                        name="title" 
                        value="{{ $post->title }}" 
                        required 
                        autocomplete="title" />

                    <x-input-error :messages="$errors->get('title')" class="mt-2" /> 
                </div>
                <div class="mt-4">
                    <x-input-label for="body" :value="__('Body')" />

                    <x-text-input id="body" class="block mt-1 w-full" 
                        type="text" 
                        name="body" 
                        value="{{ $post->body }}" 
                        required 
                        autocomplete="body" />

                    <x-input-error :messages="$errors->get('body')" class="mt-2" /> 
                </div>
                <x-primary-button class="mt-4">
                    {{ __('Edit') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>