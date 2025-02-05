<x-app-layout>
    <div class="max-w-xl mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
        <form id="task-form">
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

        <div id="success-message" class="text-green-600 mt-4 hidden">Task created successfully!</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#task-form').on('submit', function(event) {
                event.preventDefault();

                const token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('store') }}", // API endpoint
                    method: "POST",
                    headers: {
                        'Authorization': 'Bearer ' + token, // Sanctum token
                        'Accept': 'application/json'
                    },
                    data: {
                        title: $('#title').val(),
                        description: $('#description').val(),
                    },
                    success: function(response) {
                        $('#success-message').removeClass('hidden');
                        $('#task-form')[0].reset(); // Reset form fields
                        console.log(response); // Log the response for debugging
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Validation error
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';
                            for (let field in errors) {
                                errorMessage += errors[field][0] + '\n';
                            }
                            alert('Validation Error:\n' + errorMessage);
                        } else {
                            alert('Error: ' + xhr.responseJSON.message);
                        }
                    }
                });
            });
        });
    </script>
</x-app-layout>
