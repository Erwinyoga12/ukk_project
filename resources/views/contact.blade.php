<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>My Portofolio</title>
</head>
<style>
    body{
                
                font-family: 'Times New Roman', Times, serif
                }
</style>
<body>
    
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid text-bg-dark">
            <a class="navbar-brand text-white" href="#">sitisolehah</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link  text-white" aria-current="page" href="index">Beranda</a>
                    </li>
                    <li class="nav-item text-bg-dark">
                        <a class="nav-link text-white" href="/profil">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/kegiatan">Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/prestasi">Prestasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="/contact">Contact</a>
                    </li>
  
                </ul>
            </div>
        </div>
    </nav>
</div>


<div class="container mt-5 ml-10">
    <div class="row">
        <form class="form-control" method="POST" action="{{ route('contact.store') }}">
            @csrf
            <label >Nama Lengkap</label>
            <input name="nama_lengkap" type="text" class="form-control" placeholder="isi nama lengkap" required>

            <label >Email</label>
            <input name="email" type="email" class="form-control" placeholder="isi email" required>

            <label >Pesan</label>
            <textarea name="pesan" rows="3" class="form-control" placeholder="Kirim pesan untuk Admin" required></textarea>
            @if(session()->has('SUCCES!'))
            <span class="text-success">
                {{session()->get('SUCCES!') }}
            </span>
            @endif
            <center>
            <input type="submit" class="btn btn-primary mt-2 col-5" value="kirim" href="wa.me/+62">
            </center>
        </form>
    </div>
</div>

<div class="container">
    <table class="table">
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Pesan</th>
        </thead>
        
        @foreach ($contact as $row) 
        <tr>
            <td>{{ $row->id}}</td>
            <td>{{ $row->nama_lengkap}}</td>
            <td>{{ $row->email}}</td>
            <td>{{ $row->pesan}}</td>
        </tr>
        @endforeach
    </table>                                                                                       
</div>



</body>
</html>
