<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 600; font-size: 1.25rem; color: #1f2937;">
            Задачи проекта
        </h2>
    </x-slot>

    <div style="padding: 3rem 0;">
        <div style="max-width: 80rem; margin-left: auto; margin-right: auto; padding-left: 1rem; padding-right: 1rem;">
            <!-- Сообщения об успехе -->
            @if (session('success'))
                <div style="margin-bottom: 1rem; padding: 1rem; background-color: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 0.5rem;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Информация о проекте -->
            <div style="background-color: white; overflow: hidden; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <div style="padding: 1.5rem;">
                    <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                        <div>
                            <h3 style="font-size: 1.5rem; font-weight: 700; color: #111827; margin-bottom: 0.5rem;">
                                {{ htmlspecialchars($project->name) }}
                            </h3>
                            @if($project->description)
                                <p style="color: #4b5563;">
                                    {{ htmlspecialchars($project->description) }}
                                </p>
                            @endif
                            <div style="margin-top: 1rem; font-size: 0.875rem; color: #6b7280;">
                                Всего задач: <span style="font-weight: 500;">{{ $project->tasks->count() }}</span>
                                @php
                                    $uncompletedCount = $project->tasks->where('completed', false)->count();
                                    if($uncompletedCount > 0) {
                                        echo ", из них невыполненных: <span style=\"font-weight: 500; color: #f97316;\">{$uncompletedCount}</span>";
                                    } else {
                                        echo ", <span style=\"color: #22c55e; font-weight: 500;\">все задачи выполнены!</span>";
                                    }
                                @endphp
                            </div>
                        </div>
                        <a
                            href="{{ route('projects.index') }}"
                            style="padding-left: 1rem; padding-right: 1rem; padding-top: 0.5rem; padding-bottom: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; color: #374151; text-decoration: none; transition: background-color 0.15s ease;"
                        >
                            ← Назад к проектам
                        </a>
                    </div>
                </div>
            </div>

            <!-- Форма добавления задачи -->
            <div style="background-color: white; overflow: hidden; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <div style="padding: 1.5rem;">
                    <form action="{{ route('tasks.store', $project) }}" method="POST">
                        @csrf
                        <div style="display: flex; flex-direction: column; flex-wrap: wrap; gap: 1rem;">
                            <input
                                type="text"
                                name="title"
                                placeholder="Новая задача..."
                                style="flex: 1; padding-left: 1rem; padding-right: 1rem; padding-top: 0.5rem; padding-bottom: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem;"
                                value="{{ old('title') }}"
                            >
                            <button type="submit" style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.5rem; padding-bottom: 0.5rem; background-color: #2563eb; color: white; border-radius: 0.5rem; border: none; cursor: pointer; white-space: nowrap;">
                                Добавить задачу
                            </button>
                        </div>
                        @error('title')
                            <div style="margin-top: 0.5rem; color: #dc2626; font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>

            <!-- Список задач -->
            <div style="background-color: white; overflow: hidden; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border-radius: 0.5rem;">
                <div style="padding: 1.5rem;">
                    @if($project->tasks->count() === 0)
                        <div style="text-align: center; color: #6b7280; padding: 3rem 0;">
                            <p>В этом проекте пока нет задач</p>
                        </div>
                    @else
                        <ul style="display: flex; flex-direction: column; gap: 0.75rem;">
                            @foreach($project->tasks as $task)
                                <li style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; background-color: #f9fafb; border-radius: 0.5rem; transition: background-color 0.15s ease;">
                                    <form action="{{ route('tasks.update', [$project, $task]) }}" method="POST" style="display: flex; align-items: center; flex: 1;">
                                        @csrf
                                        @method('PATCH')
                                        <input
                                            type="checkbox"
                                            name="completed"
                                            value="1"
                                            onchange="this.form.submit()"
                                            style="height: 1.25rem; width: 1.25rem; color: #2563eb; border-radius: 0.25rem; cursor: pointer;"
                                            {{ $task->completed ? 'checked' : '' }}
                                        >
                                        <span style="margin-left: 0.75rem; font-size: 1.125rem; {{ $task->completed ? 'color: #6b7280; text-decoration: line-through;' : 'color: #111827;' }}">
                                            {{ htmlspecialchars($task->title) }}
                                        </span>
                                    </form>

                                    <form action="{{ route('tasks.destroy', [$project, $task]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                            style="margin-left: 1rem; color: #dc2626; cursor: pointer; border: none; background: none; padding: 0;"
                                            onclick="return confirm('Вы уверены, что хотите удалить эту задачу?')"
                                        >
                                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
