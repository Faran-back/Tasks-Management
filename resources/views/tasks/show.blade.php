<x-app-layout>
    @foreach ($tasks as $task)
     <x-task-card :task='$task'></x-task-card>
    @endforeach
</x-app-layout>
