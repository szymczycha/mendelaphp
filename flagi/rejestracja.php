<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Document</title>
</head>
<body>
    <form method="post" action="login.php" class="form">
        <input type="hidden" name="zarejestruj" value="yes"/>
        <input type="text" name="username"/>
        <input type="password" name="password"/>
        <select name="user_type">
            <option value="admin">admin</option>
            <option value="worker">worker</option>
            <option value="user" selected>user</option>
        </select>
        <button type="submit">Zarejestruj</button>
    </form>
    <a href="login.php">Zaloguj się</a>
</body>
</html>