<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Задачи проекта') }}
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

            <!-- Информация о проекте -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                {{ htmlspecialchars($project->name) }}
                            </h3>
                            @if($project->description)
                                <p class="text-gray-600">
                                    {{ htmlspecialchars($project->description) }}
                                </p>
                            @endif
                            <div class="mt-4 text-sm text-gray-500">
                                Всего задач: <span class="font-medium">{{ $project->tasks->count() }}</span>
                                @php
                                    $uncompletedCount = $project->tasks->where('completed', false)->count();
                                    if($uncompletedCount > 0) {
                                        echo ", из них невыполненных: <span class=\"font-medium text-orange-600\">{$uncompletedCount}</span>";
                                    } else {
                                        echo ", <span class=\"text-green-600 font-medium\">все задачи выполнены!</span>";
                                    }
                                @endphp
                            </div>
                        </div>
                        <a
                            href="{{ route('projects.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                        >
                            ← Назад к проектам
                        </a>
                    </div>
                </div>
            </div>

            <!-- Форма добавления задачи -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('tasks.store', $project) }}" method="POST">
                        @csrf
                        <div class="flex flex-col sm:flex-row gap-4">
                            <input
                                type="text"
                                name="title"
                                placeholder="Новая задача..."
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                                value="{{ old('title') }}"
                            >
                            <button type="submit" class="px-6 py-2 bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 whitespace-nowrap">
                                Добавить задачу
                            </button>
                        </div>
                        @error('title')
                            <div class="mt-2 text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>

            <!-- Список задач -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($project->tasks->count() === 0)
                        <div class="text-center text-gray-500 py-12">
                            <p>В этом проекте пока нет задач</p>
                        </div>
                    @else
                        <ul class="space-y-3">
                            @foreach($project->tasks as $task)
                                <li class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <form action="{{ route('tasks.update', [$project, $task]) }}" method="POST" class="flex items-center flex-1">
                                        @csrf
                                        @method('PATCH')
                                        <input
                                            type="checkbox"
                                            name="completed"
                                            value="1"
                                            onchange="this.form.submit()"
                                            class="h-5 w-5 text-blue-600 rounded focus:ring-blue-500 cursor-pointer"
                                            {{ $task->completed ? 'checked' : '' }}
                                        >
                                        <span class="ml-3 text-lg {{ $task->completed ? 'text-gray-500 line-through' : 'text-gray-800' }}">
                                            {{ htmlspecialchars($task->title) }}
                                        </span>
                                    </form>

                                    <form action="{{ route('tasks.destroy', [$project, $task]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="ml-4 text-red-600 hover:text-red-800 focus:outline-none"
                                            onclick="return confirm('Вы уверены, что хотите удалить эту задачу?')"
                                        >
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
