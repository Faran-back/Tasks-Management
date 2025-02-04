<x-app-layout>
    <div class="max-w-xl mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
        <form action="{{ route('store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="block w-full mt-1 p-3 border rounded-lg shadow-sm" required />
            </div>

            <div class="mb-6">
                <x-input-label for="description" :value="__('Description')" />
                <x-text-input id="description" name="description" type="text" class="block w-full mt-1 p-3 border rounded-lg shadow-sm" required />
            </div>

            <div class="mt-6">
                <x-primary-button type="submit" class="py-3 px-4 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
