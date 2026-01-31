<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product - Tailwind Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-8 px-4">
    
    <!-- Main Container -->
    <div class="max-w-2xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Create New Category</h1>
            <p class="text-gray-600">Fill in the details below to add a new product to your inventory</p>
        </div>

        @if(session('success'))
            <div class="">{{session('success')}}</div>
        @elseif(session('error'))
            <div class="">{{session('error')}}</div>
        @endif
        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-md p-6 md:p-8">
            <form action="{{route('category.store')}}" method='POST' enctype="multipart/form-data" class="space-y-6">
                @csrf
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        placeholder="e.g., Jollof Rice Special"
                        value="{{old('name')}}"
                    >
                    <p class="mt-1 text-sm text-gray-500">Enter a clear, descriptive name for the product</p>
                </div>

                <!-- Description Field -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition resize-none"
                        placeholder="Describe the product, ingredients, or special features..." 
                    >{{old('description')}}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Provide details that will help customers understand the product</p>
                </div>

                <!-- Image Upload Field -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        Product Image <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="image" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6" id="uploadPlaceholder">
                                <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG (MAX. 2MB)</p>
                            </div>
                            <img id="imagePreview" class="hidden w-full h-full object-cover rounded-lg" alt="Preview">
                            <input 
                                id="image" 
                                name="image" 
                                type="file" 
                                accept="image/png, image/jpeg, image/jpg"
                                required
                                class="hidden"
                            />
                        </label>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Upload a high-quality image of the product</p>
                </div>

                <!-- Is Available Field (Role Dropdown) -->
                <div>
                    <label for="is_available" class="block text-sm font-medium text-gray-700 mb-2">
                        Availabilty <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="is_available"
                        name="is_available" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition bg-white"
                    >
                        <option value="">-- Select Option --</option>
                        <option value="AVAILABLE">Available</option>
                        <option value="UN-AVAILABLE">Un-available</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Select the availability for this product</p>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button 
                        type="submit" 
                        class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition"
                    >
                        Create Category
                    </button>
                    <button 
                        type="button" 
                        onclick="resetForm()"
                        class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition"
                    >
                        Cancel
                    </button>
                </div>

            </form>
        </div>

        <!-- Success Message (Hidden by default) -->
        <div id="successMessage" class="hidden mt-6 bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-green-800 font-medium">Product created successfully!</p>
            </div>
        </div>

    </div>

    <script>
        // Image preview functionality
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Check file size (2MB max)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    imageInput.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    uploadPlaceholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Form submission
        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const successMessage = document.getElementById('successMessage');
            // Get form data
            const formData = new FormData(this);
            const data = {
                name: formData.get('name'),
                description: formData.get('description'),
                image: formData.get('image').name,
                is_available: formData.get('is_available')
            };

            fetch('/admin/categories/store', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                body: json.stringify(data)
            })
            .then(response => response.json())
            .then(res => {
                if(res.status){
                    successMessage.style.display = 'block';
                    console.log(res)

                    document.getElementById('productForm').reset();
                }
                
            })
            .catch(error => {
                console.log(error)
            })
            // Log to console (in real app, this would be an API call)
            console.log('Form Data:', data);

            // Show success message
            document.getElementById('successMessage').classList.remove('hidden');

            // Reset form after 2 seconds
            setTimeout(() => {
                resetForm();
            }, 2000);
        });

        // Reset form function
        function resetForm() {
            document.getElementById('productForm').reset();
            imagePreview.classList.add('hidden');
            uploadPlaceholder.classList.remove('hidden');
            document.getElementById('successMessage').classList.add('hidden');
        }
    </script>

</body>
</html>