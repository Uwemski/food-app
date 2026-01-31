<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-8 px-4">

@if(session('succcess'))
    <div class="">{{session('success')}}</div>
@endif
<table border='1' class='table table-striped'>
    <thead>
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Description</th>
            <th>Availability</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr data-id="{{$category->id}}">
                <td>{{$loop->iteration}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td>{{$category->is_available}}</td>
                <td>
                    <button onclick='editForm({{$category->id}})'>Edit</button>
                </td>
                <td class= 'btn-danger'>
                    <form action="{{route('category.delete', $category->id)}}" method='POST'>
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>

    
</table>
    
    <div class="bg-white rounded-lg shadow-md p-6 md:p-8">
        <form action="" style="display:none" id="categoryEditForm">
            @csrf
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
                ></textarea>
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
            <div>
                <button type='submit'>Edit</button>
                <button type='button' onclick='disableForm()'>Clear</button>
            </div>
        </form>
    </div>
    <div id="messageDiv"></div>
</body>
<script>

    function editForm(id) {
        console.log('Editing Category Id:', id)

        document.getElementById('categoryEditForm').style.display = 'block';

        const name = document.getElementById('name')
        const description = document.getElementById('description')
        const is_available = document.getElementById('is_available');
        const form = document.getElementById('categoryEditForm');
        const messageDiv = document.getElementById('messageDiv')

        fetch(`{{ url('/admin/categories/edit')}}/${id}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(
            res => {
              if(res.status) {
                const category = res.data;

                name.value = category.name;
                description.value = category.description;
                is_available.value = category.is_available;
            }  
              console.log(data)
            }
        )
        .catch(
            error => {
                messageDiv.innerHTML = `<p>${error}</p>`
                console.log(error)
            }
        )
    }

    function disableForm() {
        document.getElementById('categoryEditForm').style.display = 'none'
    }

    document.getElementById('categoryEditForm').addEventListener('submit', function() {
        const formData = new FormData
    })
</script>
</html>