<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <main>
        <div class="container">
            <H1 style="color: red;" class="my-3"><?= isset($msg) ? $msg : '' ?></H1>

            <form action="<?= base_url("admin/masuk"); ?>" method="POST" class="mt-3">
                <?= csrf_field(); ?>
                <div class="form-group mt-3">
                    <label for="username">Username</label>
                    <input required type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input required type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>

                <input type="hidden" name="_method" value="put">
                <button type="submit" class="btn btn-success">Log In</button>
            </form>
        </div>
    </main>
</body>