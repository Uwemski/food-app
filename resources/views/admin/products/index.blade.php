<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-8 px-4">

@if(session('succcess'))
    <div class="">{{session('success')}}</div>
@endif
<table border='1' class='table-auto'>
    <thead>
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Availabilty</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr id="product-{{$product->id}}">
                <td>{{$loop->iteration}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->price}}</td>
                <td>
                    <select name="is_available" id="is_available" class="availability">
                        <option value="available" {{$product->available ? 'selected' : ''}} >Available</option>
                        <option value="not_available" {{$product->available ? 'selected' : ''}} >Un-Available</option>
                    </select>
                </td>
                <td>
                    <button onclick='editForm({{$product->id}})'>Edit</button>
                </td>
                <td class= 'btn-danger'>
                    <form action="{{route('product.delete', $product->id)}}" method='POST'>
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
        <form action="" style="display:none" id="productEditForm">
            @csrf
            <div>
                <input type="hidden" name="productId" id="productId">
            </div>
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
                >{{old('description')}}</textarea>
                <p class="mt-1 text-sm text-gray-500">Provide details that will help customers understand the product</p>
                
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Product Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="number" 
                    id="price" 
                    name="price" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                    value="{{old('price')}}"
                >
                <p class="mt-1 text-sm text-gray-500">Enter a clear, descriptive price for the product</p>
            </div>

            <!-- Current Image Display -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                <img id="currentImage" src="" alt="Current product image" class="w-32 h-32 object-cover rounded border">
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
                    Availability <span class="text-red-500">*</span>
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
                <label for="is_available" class="block text-sm font-medium text-gray-700 mb-2">
                    Category <span class="text-red-500">*</span>
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
                <button type='submit'>Update</button>
                <button type='button' onclick='disableForm()'>Clear</button>
            </div>
        </form>
    </div>
    <div id="messageDiv"></div>
</body>
<script>

    function editForm(id) {
        const form =  document.getElementById('productEditForm');

        console.log('Editing Category Id:', id)

        form.style.display = 'block';
        const name = document.getElementById('name')
        const description = document.getElementById('description')
        const price = document.getElementById('price')
        const image = document.getElementById('image')
        const category = document.getElementById('categories_id')
        const is_available = document.getElementById('is_available')

        fetch(`{{url('/admin/products/')}}/${id}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
        })
        .then(response => response.json())
        .then(res => {
            console.log(res)
            if(res.success) {
                const product = res.data
                name.value = product.name
                description.value = product.description
                price.value = product.price
                is_available.value = product.is_available

                //show image
                // if(product.image){
                //     document.getElementById('currentImage').src = `{{ asset('storage.products') }}/${product.image}`
                // }
            }
        })
        .catch(error => {
            console.error(error)
        })
    }

    document.getElementById('productEditForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const productId = document.getElementById('productId').value;
        const name = document.getElementById('name');
        const description = document.getElementById('description');
        const price = document.getElementById('price');
        const is_available = document.getElementById('is_available')

        const formData = new FormData(this)
        formData.append('_method', 'PUT')

        fetch(`{{url('/admin/products/update')}}/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}",
                'Accept': 'Application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success){
                console.log('Data sent and updated')
            }
        })
        .catch(error => {
            console.log(error)
        })
    })

    document.querySelectorAll('.availability').forEach(function (select) {
        select.addEventListener('change', function() {
            const messageDiv = document.getElementById('messageDiv')
            let row = this.closest('tr');
            let productId = row.id.replace('product-', '');
            let value = this.value

            // console.log(value)

            fetch(`/admin/products/${productId}/availabilty`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    is_available: value
                })
            })
            .then(response => response.json())
            .then(res => {
                let data = res.data;
                let cells = document.querySelector('td');
                if(res.success) {
                    console.log(res);
                    messageDiv.innerHTML = `<p class="text-green">${data.message}</p>`
                    cells[5].textContent = res.is_available
                }else{
                    messageDiv.innerHTML = `<p class="text-green">${data.message}</p>`
                }
            })
            .catch(error => {
                console.log(error)
            })
        })
    })

    function disableForm()
    {
        document.getElementById('productEditForm').style.display = 'none'
    }
</script>
</html>