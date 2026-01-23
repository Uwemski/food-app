<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>

<table border='1'>
    <thead>
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Description</th>
            <th>Availability</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>1</td>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td>{{$category->is_available}}</td>
            </tr>


        @endforeach
    </tbody>
</table>
    
</body>
</html>