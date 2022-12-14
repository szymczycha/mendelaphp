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
    <?php 
        include("hidden.php");
        if(isset($_POST["zarejestruj"])){
            //if istnieje juz ten uzytkownik 
            $username = $_POST["username"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $user_type = $_POST["user_type"];
            
            $mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
            $result = mysqli_query($mysqli, "SELECT * FROM uzytkownicy WHERE username = '$username'");
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            if($rows == null){

                var_dump($rows);
                $connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
                $queryString = "INSERT INTO `uzytkownicy`(`username`, `password`, `user_type`) VALUES (?,?,?);";
                $query = mysqli_prepare($connection, $queryString);
                mysqli_stmt_bind_param($query, "sss", $username, $password, $user_type);
                mysqli_stmt_execute($query);
                var_dump($query);
                echo "Dodano $query->affected_rows uzytkownika.";
                mysqli_close($connection);
            }else{
                echo "istnieje juz taki uzytkownik";
            }
        }
    ?>
    <form method="post" action="index.php" class="form">
        <input type="text" name="username"/>
        <input type="password" name="password"/>
        <button type="submit">zaloguj</button>
    </form>
    <a href="rejestracja.php">Zarejestruj się</a>
</body>
</html>