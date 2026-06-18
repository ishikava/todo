# To-Do List Application

Простое веб-приложение для управления задачами, созданное на Laravel 11.

## Особенности

- 📁 Управление проектами с описаниями
- ✅ Создание и управление задачами внутри проектов
- ✅ Отметка задач как выполненные
- 🗑️ Удаление проектов и задач
- 💾 Хранение данных в SQLite
- 🎨 Современный дизайн с Tailwind CSS
- 📱 Адаптивный интерфейс

## Технологии

- Laravel 11
- PHP 8.2+
- SQLite
- Tailwind CSS
- Alpine.js

## Установка

1. Склонируйте репозиторий:
```bash
git clone <repository-url>
cd todo
```

2. Установите зависимости через Composer:
```bash
composer install
```

3. Скопируйте файл `.env.example` в `.env`:
```bash
copy .env.example .env
```

4. Сгенерируйте ключ приложения:
```bash
php artisan key:generate
```

5. Создайте базу данных SQLite (если не создана):
```bash
type nul > database/todo.sqlite
```

6. Выполните миграции:
```bash
php artisan migrate
```

7. Заполните базу данных тестовыми данными:
```bash
php artisan db:seed
```

8. Запустите сервер разработки:
```bash
php artisan serve
```

8. Откройте приложение в браузере: `http://localhost:8000`

## Использование

1. Создайте новый проект на главной странице
2. Добавьте задачи в проект
3. Отметьте задачи как выполненные, нажав на checkbox
4. Удалите ненужные задачи или проекты

## Структура проекта

```
app/
├── Models/
│   ├── Project.php    # Модель проекта
│   └── Task.php       # Модель задачи
├── Http/
│   └── Controllers/
│       ├── ProjectController.php
│       └── TaskController.php
database/
├── migrations/
│   ├── 2026_06_18_094724_create_projects_table.php
│   └── 2026_06_18_094728_create_tasks_table.php
resources/
├── views/
│   ├── projects/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── show.blade.php
│   └── layouts/
│       ├── app.blade.php
│       └── navigation.blade.php
routes/
└── web.php
```

## Схема базы данных

### Users (Пользователи)
- id
- name
- email (уникальный)
- email_verified_at
- password
- remember_token
- created_at
- updated_at

### Projects (Проекты)
- id
- name (название)
- description (описание)
- created_at
- updated_at

### Tasks (Задачи)
- id
- project_id (внешний ключ к projects)
- title (название задачи)
- description (описание)
- completed (статус выполнения: 0/1)
- created_at
- updated_at

## Тестовые данные

После выполнения `php artisan db:seed` база данных будет заполнена:
- 10 пользователей
- 10 проектов
- 50 задач (по 5 задач на каждый проект)

## Разработка

### Запуск тестов
```bash
php artisan test
```

### Форматирование кода
```bash
composer format
```

## Лицензия

MIT License
