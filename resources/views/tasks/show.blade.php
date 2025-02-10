<x-app-layout>
    <div class="max-w-sm mx-auto mt-4 p-4 bg-white shadow-lg rounded-lg">
        @if ($tasks->isEmpty())
            <p class="text-center text-gray-500">No tasks available.</p>
        @else
            @foreach ($tasks as $task)
                <div class="px-2 sm:px-0">
                    <h3 class="text-sm font-semibold text-gray-900">{{ $task->user->name }}</h3>
                    <p class="mt-1 text-xs text-gray-500">
                        Role: {{ optional($task->user)->getRoleNames()->implode(', ') ?? 'No Role' }}
                    </p>
                </div>

                <div class="mt-4 border-t border-gray-100">
                    <dl class="divide-y divide-gray-100">
                        <div class="px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-0">
                            <dt class="text-xs font-medium text-gray-900">Title</dt>
                            <dd class="mt-1 text-xs text-gray-700 sm:col-span-2 sm:mt-0">{{ $task->title }}</dd>
                        </div>

                        <div class="px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-0">
                            <dt class="text-xs font-medium text-gray-900">Description</dt>
                            <dd class="mt-1 text-xs text-gray-700 sm:col-span-2 sm:mt-0">{{ $task->description }}</dd>
                        </div>
                    </dl>
                    <a href="{{ url('edit-task/'.$task->id) }}">
                        <x-primary-button>View</x-primary-button>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>
