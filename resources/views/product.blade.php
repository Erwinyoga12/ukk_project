<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>SELAMAT DATANG DI HALAMAN PRODUCT</h1>

    <div class="container">
    <table class="table">
        <thead> 
            <th>product_code</th>
            <th>product_name</th>
            <th>price</th>
            <th>stock</th>
        </thead>
        
        @foreach ($product as $row) 
        <tr>
            <td>{{ $row->product_code}}</td>
            <td>{{ $row->product_name}}</td>
            <td>{{ $row->price}}</td>
            <td>{{ $row->stock}}</td>
        </tr>
        @endforeach
    </table>                                                                                       
</div>
</body>
</html>