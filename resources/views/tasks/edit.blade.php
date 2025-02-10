<x-app-layout>
    <div class="max-w-sm mx-auto mt-4 p-6 bg-white shadow-xl rounded-lg border border-gray-200 w-96">
        <form id="task-form">
            @csrf
            <div class="mb-6">
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="block w-full mt-1 p-3 border rounded-lg shadow-sm"/>
            </div>

            <div class="mb-6">
                <x-input-label for="description" :value="__('Description')" />
                <x-text-input id="description" name="description" type="text" class="block w-full mt-1 p-3 border rounded-lg shadow-sm"/>
            </div>

            <div class="mb-6">
                <x-input-label for="status" :value="__('Status')" />
                <x-text-input id="status" name="status" type="text" class="block w-full mt-1 p-3 border rounded-lg shadow-sm"/>
            </div>

            <div class="mt-6">
                <x-primary-button type="submit" class="py-3 px-4 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                    {{ __('Update') }}
                </x-primary-button>
            </div>
        </form>

        <div id="success-message" class="text-green-600 mt-4 hidden">Task updated successfully!</div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#task-form').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ url('/update') }}", // API endpoint
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    },
                    data: {
                        title: $('#title').val(),
                        description: $('#description').val(),
                        status: $('#status').val(),
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
