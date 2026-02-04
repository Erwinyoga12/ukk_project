<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    <h1 style="text-align:center">ini halaman customers</h1>

    <div class="container mt-5 ml-10">
    <div class="row">
        <form class="form-control" method="POST" action="{{ route('customer.store') }}">
            @csrf
            <label >Customer name</label>
            <input name="customers_name" type="text" class="form-control" placeholder="isi nama lengkap" required>

            <label >Address</label>
            <textarea name="address" rows="3" class="form-control" placeholder="silahkan isi" required></textarea>
            @if(session()->has('SUCCES!'))
            <span class="text-success">
                {{session()->get('SUCCES!') }}
            </span>
            @endif
            <center>
            <input type="submit" class="btn btn-danger mt-2 col-5" value="kirim">
            </center>
        </form>
    </div>
</div>

<div class="container">
    <table class="table">
        <thead>
            
            <th>Customer Name</th>
            <th>Address</th>
        </thead>
        
        @foreach ($customer as $row) 
        <tr>
           
            <td>{{ $row->customers_name}}</td>
            <td>{{ $row->address}}</td>
        </tr>
        @endforeach
    </table>                                                                                       
</div>

</body>
</html>