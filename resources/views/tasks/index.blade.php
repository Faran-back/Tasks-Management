<x-app-layout>
    <div class="container mx-auto px-4 bg-gray-100">
        <div class="mt-4 mx-4 p-6 bg-white shadow-xl rounded-lg border border-gray-200">
            <form id="task-form">
                @csrf
                <div class="mb-6">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" name="title" type="text"
                        class="block w-full mt-1 p-3 border rounded-lg shadow-sm" required />
                </div>

                <div class="mb-6">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-text-input id="description" name="description" type="text"
                        class="block w-full mt-1 p-3 border rounded-lg shadow-sm" required />
                </div>

                <div class="mt-6">
                    <x-primary-button type="submit" class="py-3 px-4 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="filament-toast" class="fixed top-5 right-5 z-50 hidden bg-green-700 text-white text-sm p-4 rounded-lg shadow-lg transition-opacity duration-500 opacity-0">
        <span id="toast-message">Task created successfully!</span>
    </div>

    <!-- Inline Styles -->
    <style>
        #filament-toast {
            transition: opacity 0.5s ease-out;
            opacity: 0;
        }

        #filament-toast.show {
            opacity: 1;
        }

        /* Position the toast in the top-right corner */
        #filament-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            background-color: #48bb78; /* Green color */
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showFilamentToast(message) {
            const toast = document.getElementById('filament-toast');
            const toastMessage = document.getElementById('toast-message');

            // Set the toast message
            toastMessage.textContent = message;

            // Show the toast
            toast.classList.remove('hidden');
            toast.classList.add('show');

            // Hide the toast after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 500); // Toast disappears after fade-out
            }, 3000); // Duration the toast stays on screen
        }

        $(document).ready(function() {
            $('#task-form').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ url('/create') }}", // API endpoint
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    },
                    data: {
                        title: $('#title').val(),
                        description: $('#description').val(),
                    },
                    success: function(response) {
                        showFilamentToast("Task created successfully!");
                        $('#task-form')[0].reset(); // Reset form fields
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
