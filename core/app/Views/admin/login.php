<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
        }

        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .login-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            letter-spacing: 1px;
        }

        .login-header p {
            margin: 8px 0 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .login-body {
            padding: 40px;
        }

        .alert-danger {
            border-radius: 10px;
            border: 0;
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .alert-danger i {
            font-size: 18px;
        }

        .alert-danger.hidden {
            display: none;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group label i {
            color: #667eea;
            font-size: 16px;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            outline: 0;
        }

        .form-control::placeholder {
            color: #999;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: 0;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            padding: 20px 40px;
            color: #999;
            font-size: 13px;
            background: #f9f9f9;
            border-top: 1px solid #e0e0e0;
        }

        @media (max-width: 480px) {
            .login-body {
                padding: 30px 20px;
            }

            .login-header {
                padding: 30px 20px;
            }

            .login-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1><i class="fas fa-lock"></i> Admin Login</h1>
                <p>Masuk ke Dashboard Admin</p>
            </div>

            <div class="login-body">
                <?php if (isset($msg) && !empty($msg)): ?>
                    <div class="alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?= $msg ?></span>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url("admin/proses_login"); ?>" method="POST">
                    <?= csrf_field(); ?>

                    <div class="form-group">
                        <label for="username">
                            <i class="fas fa-user"></i> Username
                        </label>
                        <input required type="text" class="form-control" id="username" name="username" placeholder="Masukkan username Anda" autocomplete="username">
                    </div>

                    <div class="form-group">
                        <label for="password">
                            <i class="fas fa-key"></i> Password
                        </label>
                        <input required type="password" class="form-control" id="password" name="password" placeholder="Masukkan password Anda" autocomplete="current-password">
                    </div>

                    <input type="hidden" name="_method" value="put">
                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> Masuk
                    </button>
                </form>
            </div>

            <div class="login-footer">
                <i class="fas fa-shield-alt"></i> Akun Anda dilindungi dengan aman
            </div>
        </div>
    </div>

    <!-- Bootstrap & jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>