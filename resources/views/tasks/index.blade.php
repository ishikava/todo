<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Мои задачи') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Сообщения об успехе -->
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Форма добавления задачи -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="flex gap-4">
                            <input
                                type="text"
                                name="title"
                                placeholder="Новая задача..."
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                value="{{ old('title') }}"
                            >
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Добавить
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
                    @if(count($tasks) === 0)
                        <div class="text-center text-gray-500 py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            <p class="mt-2">У вас пока нет задач</p>
                        </div>
                    @else
                        <ul class="space-y-3">
                            @foreach($tasks as $task)
                                <li class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <form action="{{ route('tasks.update', $task['id']) }}" method="POST" class="flex items-center flex-1">
                                        @csrf
                                        @method('PATCH')
                                        <input
                                            type="checkbox"
                                            name="completed"
                                            value="1"
                                            onchange="this.form.submit()"
                                            class="h-5 w-5 text-blue-600 rounded focus:ring-blue-500 cursor-pointer"
                                            {{ $task['completed'] ? 'checked' : '' }}
                                        >
                                        <span class="ml-3 text-lg {{ $task['completed'] ? 'text-gray-500 line-through' : 'text-gray-800' }}">
                                            {{ htmlspecialchars($task['title']) }}
                                        </span>
                                    </form>

                                    <form action="{{ route('tasks.destroy', $task['id']) }}" method="POST">
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

                        <div class="mt-4 text-sm text-gray-500">
                            Всего задач: {{ count($tasks) }}
                            @php
                                $uncompletedCount = count(array_filter($tasks, fn($t) => !$t['completed']));
                                if($uncompletedCount > 0) {
                                    echo ", из них невыполненных: " . $uncompletedCount;
                                }
                            @endphp
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
