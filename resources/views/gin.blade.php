<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login Eskul</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

{{-- WAJIB: untuk fetch POST ke Laravel --}}
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
.btn{width:150px;padding:12px;background:#f4b41a;border:none;color:#fff;border-radius:6px;cursor:pointer}
</style>
</head>

<body>

<div class="left"></div>

<div class="right">

<div class="brand">Sistem Penilaian Eskul</div>

<div class="form-group">
<label>Username</label>
<input type="text" id="username">
</div>

<div class="form-group">
<label>Password</label>
<input type="password" id="password">
</div>

<button class="btn" onclick="login()">Login</button>

</div>

<script>

async function login(){

    const username = document.getElementById("username").value.toLowerCase()
    const password = document.getElementById("password").value

    const akun = {
        pramuka:     { password:"123", eskul:"pramuka"      },
        paskibra:    { password:"123", eskul:"paskibra"     },
        pmr:         { password:"123", eskul:"pmr"          },
        natbinari:   { password:"123", eskul:"natbinari"    },
        jurnal:      { password:"123", eskul:"jurnal"       },
        marchingband:{ password:"123", eskul:"marchingband" }
    }

    if(akun[username] && akun[username].password === password){

        const eskul = akun[username].eskul

        // 1. Simpan ke localStorage (untuk tampilan JS di halaman eskul)
        localStorage.setItem("eskul_login", eskul)

        // 2. Set session Laravel supaya RekapController bisa baca
        await fetch("/set-session", {
            method: "POST",
            headers: {
                "Content-Type":  "application/json",
                "X-CSRF-TOKEN":  document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ eskul: eskul })
        })

        // 3. Redirect ke halaman penilaian
        window.location.href = "/eskul"

    } else {

        alert("Username atau password salah")

    }

}

</script>

</body>
</html>