<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 600; font-size: 1.25rem; color: #1f2937;">
            Проекты
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

            <!-- Кнопка создания проекта -->
            <div style="margin-bottom: 1.5rem;">
                <a href="{{ route('projects.create') }}" style="display: inline-flex; align-items: center; padding-left: 1rem; padding-right: 1rem; padding-top: 0.5rem; padding-bottom: 0.5rem; background-color: #2563eb; border: 1px solid transparent; border-radius: 0.5rem; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: white; text-decoration: none; transition: background-color 0.15s ease;">
                    + Новый проект
                </a>
            </div>

            <!-- Список проектов -->
            @if($projects->count() === 0)
                <div style="background-color: white; overflow: hidden; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border-radius: 0.5rem;">
                    <div style="padding: 1.5rem; text-align: center; color: #6b7280;">
                        <p>У вас пока нет проектов</p>
                        <a href="{{ route('projects.create') }}" style="color: #2563eb; text-decoration: none; margin-top: 0.5rem; display: inline-block;">
                            Создайте первый проект
                        </a>
                    </div>
                </div>
            @else
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
                    @foreach($projects as $project)
                        <div style="background-color: white; overflow: hidden; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border-radius: 0.5rem; transition: box-shadow 0.15s ease;">
                            <div style="padding: 1.5rem;">
                                <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 0.5rem;">
                                    <a href="{{ route('projects.show', $project) }}" style="color: #2563eb; text-decoration: none; transition: color 0.15s ease;">
                                        {{ htmlspecialchars($project->name) }}
                                    </a>
                                </h3>
                                @if($project->description)
                                    <p style="color: #4b5563; font-size: 0.875rem; margin-bottom: 1rem; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                        {{ htmlspecialchars($project->description) }}
                                    </p>
                                @endif
                                <div style="display: flex; align-items: center; justify-content: space-between; font-size: 0.875rem; color: #6b7280; border-top: 1px solid #e5e7eb; padding-top: 1rem;">
                                    <span>
                                        <span style="font-weight: 500; color: #111827;">{{ $project->tasks_count }}</span> задач
                                    </span>
                                    <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            style="color: #dc2626; cursor: pointer; border: none; background: none; padding: 0; font-size: 0.875rem;"
                                            onclick="return confirm('Вы уверены, что хотите удалить этот проект?')"
                                        >
                                            <svg style="width: 1rem; height: 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
