<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Listify Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap");

    * {
        box-sizing: border-box;
        font-family: "Outfit";
    }

    body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f8f8;
    }

    .container {
        width: 800px;
        height: 500px;
        display: flex;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        background-color: white;
    }

    .left {
        flex: 1;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: #e9e9e9;
    }

    .left h1 {
        font-size: 32px;
        margin: 0;
    }

    .left h1 span {
        color: #1a56db;
    }

    .left p {
        margin-top: 10px;
        font-size: 14px;
        color: #666;
    }

    .input-field {
        margin: 20px 0 10px;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        outline: none;
        font-size: 14px;
    }
    .login-btn {
        padding: 12px;
        background-color: #1a56db;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        width: 100%;
        margin-top:25px;
    }

    .register {
        margin-top: 15px;
        font-size: 12px;
        text-align: center;
        color: #555;
        
    }

    .register a {
        text-decoration: none;
        color:inherit;
    }

    .right {
        flex: 1;
        background-color: #f2f2f2;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .right img {
        max-width: 100%;
        height: auto;
    }

    .welcome-text {
        text-align: center;
        width: 100%;
        margin-bottom: 20px;
        margin-top: 25px;
    }

    .right img {
        width: 100%;
        margin: 10px;
        height: 300px;
        margin-right: 75px;
        margin-top: 210px;
        max-width: 360px;
        transform: translateX(30px);
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="left">
            <h1><strong>List</strong><span>ify</span></h1>

            <div class="welcome-text">
                <h1>Register</h1>
                <p>"Start your journey to better habits today."</p>
            </div>

            <form action="../auth/register.php" method="POST">

                <div class="input-field">
                    <input type="text" placeholder="Username" name="username" required>
                </div>
                <div class="input-field">
                    <input type="text" placeholder="Email" name="email" required>
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                
                <button class="login-btn">Register</button>
            </form>

            <div class="register">
                <a href="login.php">Have An Account?</a>
            </div>

        </div>
        <div class="right">
            <img src="assets/image/todolist.png" alt="To-Do List">
        </div>
    </div>

</body>

</html>