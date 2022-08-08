<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User created</title>
</head>
<body>
    <h2>Email Notification: user account created on Blog FS-08</h2>
    <p>An account under your name was created by Sophia.</p>
    <p>Your Info:</p>
    <p>
        <strong>Name: </strong> {{$user['name']}}
        <strong>Email: </strong> {{$user['email']}}
        <strong>Name: </strong> {{$user['pass']}}
    </p>
</body>
</html>