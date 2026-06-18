<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 600; font-size: 1.25rem; color: #1f2937;">
            Новый проект
        </h2>
    </x-slot>

    <div style="padding: 3rem 0;">
        <div style="max-width: 48rem; margin-left: auto; margin-right: auto; padding-left: 1rem; padding-right: 1rem;">
            <div style="background-color: white; overflow: hidden; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border-radius: 0.5rem;">
                <div style="padding: 1.5rem;">
                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            <div>
                                <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">
                                    Название проекта
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    style="width: 100%; padding-left: 1rem; padding-right: 1rem; padding-top: 0.5rem; padding-bottom: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem;"
                                    value="{{ old('name') }}"
                                    placeholder="Например: Веб-сайт"
                                >
                                @error('name')
                                    <div style="margin-top: 0.5rem; color: #dc2626; font-size: 0.875rem;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="description" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">
                                    Описание (опционально)
                                </label>
                                <textarea
                                    id="description"
                                    name="description"
                                    rows="4"
                                    style="width: 100%; padding-left: 1rem; padding-right: 1rem; padding-top: 0.5rem; padding-bottom: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem;"
                                    placeholder="Опишите цель проекта..."
                                >{{ old('description') }}</textarea>
                                @error('description')
                                    <div style="margin-top: 0.5rem; color: #dc2626; font-size: 0.875rem;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 1rem; padding-top: 1rem;">
                                <a
                                    href="{{ route('projects.index') }}"
                                    style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.5rem; padding-bottom: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; color: #374151; text-decoration: none; transition: background-color 0.15s ease;"
                                >
                                    Отмена
                                </a>
                                <button type="submit" style="padding-left: 1.5rem; padding-right: 1.5rem; padding-top: 0.5rem; padding-bottom: 0.5rem; background-color: #2563eb; color: white; border-radius: 0.5rem; border: none; cursor: pointer;">
                                    Создать проект
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
