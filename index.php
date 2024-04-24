<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #3C5B6F;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background-color: #FFFBF5;
            max-width: 400px;
            width: 100%;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .login-card-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-card-header h2 {
            color: #333;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .login-card-header p {
            color: #777;
            margin-bottom: 0;
        }

        .login-card-body .form-control {
            border: none;
            border-bottom: 2px solid #ddd;
            border-radius: 0;
            padding: 10px 0;
            margin-bottom: 30px;
            box-shadow: none;
            background-color: transparent;
            transition: border-color 0.3s ease;
        }

        .login-card-body .form-control:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: none;
        }

        .login-card-body .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .login-card-body .btn-primary:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 10px;
            display: none;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-card-header">
                <h2>Login</h2>
                <p>Welcome back! Please login to your account.</p>
            </div>
            <div class="login-card-body">
                <form id="login-form" method="POST" action="./functions/login.php">
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign In</button>
                    <div class="error-message" id="error-message">Incorrect email or password.</div>
                </form>
              
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
