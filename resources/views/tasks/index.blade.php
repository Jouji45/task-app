<!DOCTYPE html>
<html>
<head>
    <title>Task App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h1 class="text-2xl font-bold">Task Manager</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-500 hover:text-red-500 transition-colors">
                Logout
            </button>
        </form>
    </div>

    <!-- Add Task Form -->
    <form method="POST" action="/tasks" class="flex gap-2 mb-4">
        @csrf
        <input type="text" 
               name="title" 
               class="border p-2 flex-1 rounded" 
               placeholder="New task" 
               required>
        <button class="bg-blue-500 text-white px-4 rounded">
            Add
        </button>
    </form>


    <!-- Task List -->
    @foreach($tasks as $task)
        <div class="flex items-center justify-between mb-2 p-2 border rounded">
        
            <form method="POST" action="/tasks/{{ $task->id }}">
                @csrf
                @method('PATCH')
                <button class="mr-2">
                    {{ $task->is_done ? '✔' : '❌' }}
                </button>
            </form>

            
            <span class="flex-1 {{ $task->is_done ? 'line-through text-gray-400' : '' }}">
                {{ $task->title }}
            </span>
            
            <form method="POST" action="/tasks/{{ $task->id }}">
                @csrf
                @method('DELETE')
                <button class="text-red-500 ml-4">
                    Delete
                </button>
            </form>
        </div>
    @endforeach

</div>    

</body>
</html>