@extends('layouts.app')

@section('content')
<style>
    .login-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 80vh;
    padding: 20px;
    background-color: #f1f5f9;
}

.login-container {
    background: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
}

.login-container h2 {
    margin-bottom: 20px;
    color: #333;
    text-align: center;
    
}

.login-container input[type="text"],
.login-container input[type="password"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.login-container button {
    width: 100%;
    padding: 12px;
    background-color: #198754;
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s;
}

.login-container button:hover {
    background-color: #145c39;
}

.login-container .forgot-password {
    margin-top: 15px;
    display: block;
    text-align: right;
    font-size: 14px;
    color: #198754;
}

</style>
<div class="login-wrapper d-flex justify-content-center">
    <div class="login-container">
        <h2><strong>Login</strong></h2>
        <form action="/login" method="POST">
            @csrf
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Masuk</button>
        </form>
    </div>
</div>
@endsection
