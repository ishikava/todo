<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Проекты') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Сообщения об успехе -->
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Кнопка создания проекта -->
            <div class="mb-6">
                <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    + Новый проект
                </a>
            </div>

            <!-- Список проектов -->
            @if($projects->count() === 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-500">
                        <p>У вас пока нет проектов</p>
                        <a href="{{ route('projects.create') }}" class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                            Создайте первый проект
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($projects as $project)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    <a href="{{ route('projects.show', $project) }}" class="hover:text-blue-600 transition-colors">
                                        {{ htmlspecialchars($project->name) }}
                                    </a>
                                </h3>
                                @if($project->description)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ htmlspecialchars($project->description) }}
                                    </p>
                                @endif
                                <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                                    <span>
                                        <span class="font-medium text-gray-900">{{ $project->tasks_count }}</span> задач
                                    </span>
                                    <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="text-red-600 hover:text-red-800 focus:outline-none"
                                            onclick="return confirm('Вы уверены, что хотите удалить этот проект?')"
                                        >
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
