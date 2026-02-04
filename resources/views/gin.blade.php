<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login Slider</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    height:100vh;
    display:flex;
    overflow:hidden;
}

/* LEFT SLIDER */
.left{
    width:50%;
    position:relative;
    overflow:hidden;

    opacity:0;
    animation: slideLeft 1.2s ease forwards;
}

.slide{
    position:absolute;
    width:100%;
    height:100%;
    background-size:cover;
    background-position:center;
    opacity:0;
    transition:opacity 1s ease;
}

.slide.active{
    opacity:1;
}

/* RIGHT LOGIN */
.right{
    width:50%;
    background:#fff;
    padding:80px;
    display:flex;
    flex-direction:column;
    justify-content:center;

    opacity:0;
    animation: fadePanel 1s ease forwards;
    animation-delay:.8s;
}

/* CONTENT STAGGER */
.brand,
h2,
.subtitle,
.form-group,
.btn,
.forgot{
    opacity:0;
    transform:translateY(20px);
}

/* STAGGER DELAY */
.brand{ animation-delay:1.1s; }
h2{ animation-delay:1.25s; }
.subtitle{ animation-delay:1.4s; }
.form-group:nth-child(1){ animation-delay:1.55s; }
.form-group:nth-child(2){ animation-delay:1.7s; }
.btn{ animation-delay:1.9s; }
.forgot{ animation-delay:2.05s; }

.brand,
h2,
.subtitle,
.form-group,
.btn,
.forgot{
    animation: fadeUp .6s ease forwards;
}

.brand{
    font-size:32px;
    font-weight:600;
    margin-bottom:40px;
}

h2{
    font-size:24px;
    margin-bottom:5px;
}

.subtitle{
    color:#777;
    font-size:14px;
    margin-bottom:40px;
}

.form-group{
    margin-bottom:25px;
}

label{
    font-size:13px;
    color:#999;
}

input{
    width:100%;
    border:none;
    border-bottom:1px solid #ddd;
    padding:10px 0;
    font-size:15px;
    outline:none;
}

input:focus{
    border-color:#f4b41a;
}

.btn{
    width:140px;
    padding:12px;
    background:#f4b41a;
    border:none;
    color:#fff;
    font-weight:500;
    border-radius:6px;
    cursor:pointer;
    margin-top:20px;
    transition:transform .2s ease, box-shadow .2s ease;
}

.btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(244,180,26,.35);
}

.forgot{
    margin-top:15px;
    font-size:13px;
    color:#3b82f6;
    text-decoration:none;
}

/* RESPONSIVE */
@media(max-width:768px){
    body{
        flex-direction:column;
    }
    .left{
        width:100%;
        height:250px;
    }
    .right{
        width:100%;
        padding:40px;
    }
}

/* ANIMATIONS */
@keyframes slideLeft{
    from{
        transform:translateX(-80px);
        opacity:0;
    }
    to{
        transform:translateX(0);
        opacity:1;
    }
}

@keyframes fadePanel{
    from{
        opacity:0;
    }
    to{
        opacity:1;
    }
}

@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}
</style>
</head>
<body>

<!-- LEFT IMAGE SLIDER -->
<div class="left">
    <div class="slide active" style="background-image:url('image/drm.jpg');"></div>
    <div class="slide" style="background-image:url('image/prmuka.jpg');"></div>
    <div class="slide" style="background-image:url('image/kib.jpg');"></div>
    <div class="slide" style="background-image:url('image/nat.jpg');"></div>
    <div class="slide" style="background-image:url('image/jrnl.jpg');"></div>
    <div class="slide" style="background-image:url('image/pmr.jpg');"></div>
</div>

<!-- RIGHT LOGIN -->
<div class="right">
    <div class="brand">xmee</div>

    <h2>Log In</h2>
    <p class="subtitle">Log in to continue in our exam</p>

    <form>
        <div class="form-group">
            <label>Username</label>
            <input type="username">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password">
        </div>

        <button class="btn">Log in</button><br>
        <a href="/pramuka" class="forgot">Forgot Password</a>
    </form>
</div>

<script>
let slides = document.querySelectorAll('.slide');
let index = 0;

setInterval(() => {
    slides[index].classList.remove('active');
    index = (index + 1) % slides.length;
    slides[index].classList.add('active');
}, 4000);
</script>

</body>
</html>
