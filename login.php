<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>

<div class="container vh-100">
    <div class="row justify-content-center h-100">
        <div class="card w-250 my-auto shadow">
            <header class="py-5">
                <h1 class="display-4 text-center">LOG IN FORM</h1>
                <p class="lead">Login to your account to manage your profile and support children's homes.</p>
            </header>

            <form method="post" action="./dashboard.php"> <!-- Change action to "viewdonors.php" -->
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" placeholder="Enter your email address"
                               name="email">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" placeholder="Enter your password"
                               name="password">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </form>

            <p class="text-center">Don't have an account? <a href="Register.php" class="btn btn-link">Register here</a></p>
        </div>
    </div>
</div>

</body>
</html>
