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
                    {{ __("Post List") }}
                </div>
            </div>
            <a href="{{ route('posts.create') }}">
                <x-primary-button class="mt-4">
                    {{ __('Create New Post') }}
                </x-primary-button>
            </a>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-white dark:text-gray-100" scope="col">#</th>
                        <th class="text-white dark:text-gray-100" scope="col">{{ __("Title") }}</th>
                        <th class="text-white dark:text-gray-100" scope="col">{{ __("Body") }}</th>
                        <th class="text-white dark:text-gray-100" scope="col">{{ __("Created At") }}</th>
                        <th class="text-white dark:text-gray-100" scope="col">{{ __("Update At") }}</th>
                        <th class="text-white dark:text-gray-100" scope="col">{{ __("Action") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $index => $post)
                        <tr>
                            <th class="text-white dark:text-gray-100 text-center" scope="row">{{ $post -> id }}</th>
                            <td class="text-white dark:text-gray-100 text-center">{{ $post-> title }}</td>
                            <td class="text-white dark:text-gray-100 text-center">{{ $post-> body }}</td>
                            <td class="text-white dark:text-gray-100 text-center">{{ $post-> created_at }}</td>
                            <td class="text-white dark:text-gray-100 text-center">{{ $post-> updated_at }}</td>
                            <td class="text-white dark:text-gray-100 text-center">
                                @if ($post->user_id == Auth::user()->id)
                                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}">
                                        <x-secondary-button class="mt-4">
                                            {{ __('Edit') }}
                                        </x-secondary-button>
                                    </a>
                                @endif
                                @if ($post->user_id == Auth::user()->id || Auth::user()->is_admin == true)
                                    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" class="inline-block" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="mt-4">
                                            {{ __('Delete') }}
                                        </x-danger-button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>