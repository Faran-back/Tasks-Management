@props(['task'])

<div class="max-w-sm mx-auto mt-4 p-4 bg-white shadow-lg rounded-lg">
    <div class="px-2 sm:px-0">
        <h3 class="text-sm font-semibold text-gray-900">Task by: {{ $task->user->name }}</h3>
        <p class="mt-1 text-xs text-gray-500">
            Role: {{ $task->user->roles->pluck('name')->first() }}
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

        <!-- Check if user is admin or manager for edit -->
        @if(auth()->user()->hasRole(['admin', 'manager']))
            <div class="flex space-x-4 mt-4">
                <a href="{{ url('edit-task/'.$task->id) }}">
                    <x-secondary-button>Edit</x-secondary-button>
                </a>
            </div>
        @endif

        <!-- Only admin can delete -->
        @if(auth()->user()->hasRole('admin'))
        <div class="flex space-x-4 mt-4">
            <a href="{{ url('delete-task/'.$task->id) }}">
                <x-danger-button>Delete</x-danger-button>
            </a>
        </div>
        @endif
    </div>
</div>
