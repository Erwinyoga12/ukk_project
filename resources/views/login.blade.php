<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">

    <style>
        /* Gaya umum */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(to right, #4b79a1, #283e51);
}

body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 200%;
    height: 200%;
    background: linear-gradient(
        45deg,
        #ff9a9e,
        #fad0c4,
        #fad0c4,
        #fbc2eb,
        #a18cd1,
        #fbc2eb,
        #fad0c4,
        #ff9a9e
    );
    background-size: 400% 400%;
    animation: rainbowMove 10s ease infinite;
    z-index: -1;
} 

/* Animasi bergerak pada background */
@keyframes rainbowMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}


/* Gaya untuk kotak login */
.login-container {
    width: 100%;
    max-width: 400px;
    background-color: rgba(255, 255, 255, 0.85);
    padding: 20px;
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.login-box {
    width: 100%;
    max-width: 400px;
    padding: 30px;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    
}


/* Gaya input */
.input-group {
    position: relative;
    margin-bottom: 20px;
}

.input-group input {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f8f8f8;
    outline: none;
}

.input-group input:focus {
    border-color: #0088cc;
    background-color: #e6f7ff;
}

.input-group label {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    font-size: 16px;
    color: #999;
    transition: all 0.3s ease;
    pointer-events: none;
}

.input-group input:focus + label,
.input-group input:not(:placeholder-shown) + label {
    top: -5px;
    left: 10px;
    font-size: 12px;
    color: #0088cc;
}

/* Gaya tombol */
button {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    background-color: #0088cc;
    border: none;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.login-btn:hover {
    background-color: #005f99;
}

/* Pesan error */
.error-msg {
    color: red;
    font-size: 14px;
    text-align: center;
    margin-top: 10px;
}

    </style>
</head>
<body>
    
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="{{ route('cek_user' ) }}" method="post">
                @csrf
                <div class="input-group">
                    <input type="text" id="username" name="username" required>
                    <label for="username">Username</label>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" required>
                    <label for="password">Password</label>
                </div>
                <button type="submit">Login</button>

                
                
            </form>
            @if(session()->has('pesan'))
            <h2 style="color:red;">{{ session()->get('pesan') }}</h2>
            @endif
        </div>
    </div>
</body>
</html>
