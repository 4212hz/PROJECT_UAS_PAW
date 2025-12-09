<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login untuk masuk</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body{
            height: 100vh;
            display: flex;
            justify-content: center;
            background: linear-gradient(135deg, #0a1f44, #021528);
            align-items: center;
            color: #fff;
            overflow: hidden;
        }
        .bg-shape{
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 30px;
            background: rgba(255,255,255,0.05);
            top: -50px;
            left: -50px;
            transform: rotate(45deg);
            filter: blur(10px);
        }
        .bg-shape2{
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            bottom: -80px;
            right: -80px;
            filter: blur(10px);
        }
        .bg-shape,
        .bg-shape2 {
            z-index: -1;
        }

        .container {
            display: flex;
            width: 100%;
            /* height: 100vh; */
        }
        .left {
            flex: 1;
            margin-left: 80px;
            justify-content: center;
            display: flex;
            align-items: center;
        }
        .text-box{
            width: 500px;
            padding: 35px;
        }
        .left h1{
            font-size: 60px;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .left p{
            max-width: 400px;
            /* opacity: .7; */
            /* margin-bottom: 30px; */
        }
        .right {
            flex: 1;
            display: flex;
            margin-right: 40px;
            justify-content: center;
            align-items: center;
        }
        .login-box{
            width: 380px;
            background: rgba(255,255,255,0.07);
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.4);
        }
        .login-box h2{
            text-align: center;
            margin-bottom: 15px;
            font-size: 30px;
        }
        .login-box label{
            font-size: 14px;
            font-weight: 500;
        }
        .login-box input{
            width: 100%;
            margin-top: 5px;
            margin-bottom: 20px;
            padding: 12px;
            border-radius: 30px;
            border: none;
            outline: none;
            background: rgba(255,255,255,0.15);
            color: #fff;
        }
        .login-box input:focus {
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.7);
            outline: none;
            background: rgba(10, 20, 40, 0.15);
        }
        .btn-submit{
            width: 100%;
            padding: 12px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            background: linear-gradient(to right, #007bff, #00c8ff);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .signup{
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            display: block;
            width: 100%;
        }
        .signup a{
            color: #00c8ff;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="bg-shape"></div>
    <div class="bg-shape2"></div>
    <div class="container">
        <div class="left">
            <div class="text-box">
                <h1>Welcome!</h1>
                <p>Silakan login menggunakan akun Anda untuk mengakses sistem.</p>
            </div>
        </div>
        <div class="right">
            <div class="login-box">
                <h2>Sign in</h2>
                    <form action="../controller/login_controller.php" method="POST">
                        <label>User Name</label>
                        <input type="text" name="nama" placeholder="Username">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password">
                        <button type="submit" class="btn-submit">Submit</button>
                    </form>
                <span class="signup">Don't have an account? <a href="../controller/signup_controller.php">Sign Up</a></span>
            </div>
        </div>
    </div>
</body>
</html>
