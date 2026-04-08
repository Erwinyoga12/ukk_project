<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Eskul</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- CSRF Token untuk keamanan Laravel --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
        body{height:100vh;display:flex}
        .left{width:50%;background:url('image/prmuka.jpg') center/cover}
        .right{width:50%;background:#fff;padding:80px;display:flex;flex-direction:column;justify-content:center}
        .brand{font-size:32px;font-weight:600;margin-bottom:30px}
        .form-group{margin-bottom:20px}
        label{font-size:13px;color:#777}
        input{width:100%;border:none;border-bottom:1px solid #ddd;padding:10px 0;font-size:15px;outline:none}
        input:focus{border-bottom-color:#f4b41a}
        .btn{width:150px;padding:12px;background:#f4b41a;border:none;color:#fff;border-radius:6px;cursor:pointer;font-weight:500}
        .btn:hover{background:#dca30f}
        .error-msg{color:#e74c3c;font-size:13px;margin-top:8px;display:block}
    </style>
</head>
<body>

<div class="left"></div>

<div class="right">
    <div class="brand">Sistem Penilaian Eskul</div>

    {{-- Form dengan method POST ke route Laravel --}}
    <form action="{{ route('login.process') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" id="username" placeholder="pramuka" required autocomplete="off" value="{{ old('username') }}">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="••••••" required>
        </div>

        {{-- Tampilkan error dari session --}}
        @if(session('pesan'))
            <div class="error-msg">{{ session('pesan') }}</div>
        @endif
        @if($errors->any())
            <div class="error-msg">{{ $errors->first() }}</div>
        @endif

        <button type="submit" class="btn">Login</button>
    </form>
</div>

</body>
</html>