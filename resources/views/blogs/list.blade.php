<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blogs List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($blogs->isEmpty())
                        <p class="text-gray-600">No blogs found.</p>
                    @else
                        <ul class="divide-y divide-gray-200">
                            @foreach ($blogs as $blog)
                                <li class="py-4">
                                    <a href="{{ route('blogs.edit', $blog) }}" class="text-indigo-600 hover:text-indigo-900">{{ $blog->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
