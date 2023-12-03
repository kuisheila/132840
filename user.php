<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Selection</title>
    <style>
        body {
            background-color: #000000; /* Green background color */
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        div {
            text-align: center;
            padding: 20px;
            background-color: #23801d; /* White background color for the content */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #000000; /* Green text color */
        }

        button {
            background-color: #01080c; /* Blue button color */
            color: #fff; /* White text color */
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
        }

        button:hover {
            background-color: rgb(81, 118, 52, 107, 182); /* Darker blue on hover */
        }
    </style>
</head>
<body>

<div>
    <h2>Select User to Log In</h2>

    <form action="login.php" method="post">
        <button type="submit" name="userType" value="admin">Log in as Admin</button>
    </form>

    <form action="logindonor.php" method="post">
        <button type="submit" name="userType" value="donor">Log in as Donor</button>
    </form>

    <form action="loginhome.php" method="post">
        <button type="submit" name="userType" value="home">Log in as Home</button>
    </form>
</div>

</body>
</html>
