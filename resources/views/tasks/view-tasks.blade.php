<x-app-layout>
    @foreach ($tasks as $task)
        <x-view-tasks :task="$task"></x-view-tasks>
    @endforeach
</x-app-layout>
