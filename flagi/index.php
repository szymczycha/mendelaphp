<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="style2.css">
    <title>Document</title>
</head>
<body>
    <!-- <div style="display: flex;"> -->
        
    <?php
        include("hidden.php");
        session_start();
        if(isset($_POST["username"])){
            $username = $_POST["username"];
        }
        if(isset($_POST["password"])){
            $password = $_POST["password"];
        }
        $user_type = "";
        // var_dump($username);
        // var_dump($password);
        // $connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
        // $queryString = "SELECT `user_type` FROM `uzytkownicy` WHERE `username` = ? AND `password` = ?";
        // // $query = $connection->prepare($queryString);
        // $query = mysqli_prepare($connection, $queryString);
        // mysqli_stmt_bind_param($query, "ss", 
        //     $username, 
        //     $password);
        // mysqli_stmt_execute($query);
        // echo "SSSSS\n";
        // echo $query->affected_rows;
        // if($query->affected_rows == 1){
        //     $results = $query->get_result();

        //     $user_type = $result->fetch_assoc();
        //     var_dump($user_type);
        // }
        // mysqli_close($connection);
        // echo "SSSSS";
        if(isset($_POST["password"]) &&
                isset($_POST["username"])){
                
            $mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
            $result = mysqli_query($mysqli, "SELECT * FROM uzytkownicy WHERE username = '$username'");
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if($rows == null){
                echo "nie ma takiego uzytkownika";
                header('Location: /flagi/login.php');
                exit;
            }
            if(password_verify($_POST["password"],$rows[0]["password"])){
                $_SESSION["user_type"] = $rows[0]["user_type"];
                $user_type = $_SESSION["user_type"];
            }else{
                echo "zle haslo";
                header('Location: /flagi/login.php');
                exit;
            }

        }
        if(isset($_SESSION["user_type"])){
            $user_type = $_SESSION["user_type"];
        }else{
            // zaloguj sie lol
            header('Location: /flagi/login.php');
            exit;
        }
        if(isset($_POST["action"])){
            $action = $_POST["action"];
            if($action == "delete_data"){
                $delete_id = $_POST["delete_id"];
                if(isset($delete_id)&&
                    $delete_id != ""){
                    $connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
                    $queryString = "DELETE FROM `dane` WHERE `ID` = ?";
                    $query = $connection->prepare($queryString);
                    $query->bind_param("i", 
                        $delete_id);
                    $query->execute();
                    echo "Usunieto $query->affected_rows flag.";
                    mysqli_close($connection);
                }

            }
            if($action == "update_data"){
                $update_id = $_POST["update_id"];
                $update_flaga_id = $_POST["update_flaga_id"];
                $update_nominal = $_POST["update_nominal"];
                $update_nr_kat = $_POST["update_nr_kat"];
                $update_stop_id = $_POST["update_stop_id"];
                $update_rok = $_POST["update_rok"];
                if(isset($update_flaga_id) && 
                    isset($update_nominal) && 
                    isset($update_nr_kat) && 
                    isset($update_stop_id) && 
                    isset($update_rok) &&
                    $update_flaga_id != "" &&
                    $update_nominal != "" &&
                    $update_nr_kat != "" &&
                    $update_stop_id != "" &&
                    $update_rok != ""){
                    $connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
                    $queryString = "UPDATE `dane` SET `flaga_id`= ?,`nominal`= ?,`nr_kat`= ?,`stop_id`= ?,`rok`= ? WHERE `ID` = ?";
                    $query = $connection->prepare($queryString);
                    $query->bind_param("issiii", 
                        $update_flaga_id, 
                        $update_nominal,
                        $update_nr_kat,
                        $update_stop_id,
                        $update_rok,
                        $update_id);
                    $query->execute();
                    echo "Zaktualizowano $query->affected_rows flag.";
                    mysqli_close($connection);
                }
            }
            if($action == "insert_data"){
                $insert_flaga_id = $_POST["insert_flaga_id"];
                $insert_nominal = $_POST["insert_nominal"];
                $insert_nr_kat = $_POST["insert_nr_kat"];
                $insert_stop_id = $_POST["insert_stop_id"];
                $insert_rok = $_POST["insert_rok"];
                if(isset($insert_flaga_id) && 
                    isset($insert_nominal) && 
                    isset($insert_nr_kat) && 
                    isset($insert_stop_id) && 
                    isset($insert_rok) &&
                    $insert_flaga_id != "" &&
                    $insert_nominal != "" &&
                    $insert_nr_kat != "" &&
                    $insert_stop_id != "" &&
                    $insert_rok != ""){
                    $connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
                    $queryString = "INSERT INTO `dane`(`flaga_id`, `nominal`, `nr_kat`, `stop_id`, `rok`) VALUES (?, ?, ?, ?, ?)";
                    $query = $connection->prepare($queryString);
                    $query->bind_param("isssi", 
                        $insert_flaga_id, 
                        $insert_nominal,
                        $insert_nr_kat,
                        $insert_stop_id,
                        $insert_rok,);
                    $query->execute();
                    echo "Dodano $query->affected_rows flag.";
                    mysqli_close($connection);
                }
            }
        }
        
    ?>
    <!-- </div> -->

    <?php if($user_type=="admin" || $user_type=="worker" || $user_type == "user") : ?>
    <table>
        <tbody>
            <tr>
                <th></th>
                <th>nominał</th>
                <th>nr kat.</th>
                <th>stop</th>
                <th>rok</th>
                <?php if($user_type == "admin") : ?>
                <th></th>
                <?php endif; ?>
            </tr>
            <?php
                $connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
                $queryString = "SELECT `flagi`.`Link`, `nominal`, `nr_kat`, `stopy`.`Nazwa`, `rok`, `dane`.`ID`, `flaga_id`, `stop_id` FROM `dane`, `flagi`,`stopy` WHERE `dane`.`flaga_id` = `flagi`.`ID` AND `stopy`.`ID` = `dane`.`stop_id`";
                $query = mysqli_query($connection, $queryString);
                $results = mysqli_fetch_all($query);
                mysqli_close($connection);
                foreach($results as $row){
                    if(isset($_POST["editing_id"]) && $_POST["editing_id"] == $row[5]){
                        echo "                
                            <tr>
                                <form method='POST'>
                                    <input type='hidden' name='action' value='update_data'/>
                                    <input type='hidden' name='update_id' value='$row[5]'/>
                                    <td>
                                        <select name='update_flaga_id'>";
                                        $connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
                                        $queryString = "SELECT * FROM `flagi`";
                                        $flagiquery = mysqli_query($connection, $queryString);
                                        $flagiresults = mysqli_fetch_all($flagiquery);
                                        mysqli_close($connection);
                                        foreach($flagiresults as $flagirow){
                                            if($row[6] == $flagirow[0]){
                                                echo "<option value='$flagirow[0]' selected>$flagirow[1]</option>";
                                            }else{
                                                echo "<option value='$flagirow[0]'>$flagirow[1]</option>";
                                            }
                                        }
                                  echo "</select>
                                    </td>
                                    <td>
                                        <input type='text' name='update_nominal' value='$row[1]'/>
                                    </td>
                                    <td>
                                        <input type='text' name='update_nr_kat' value='$row[2]'/>
                                    </td>
                                    <td>
                                        <select name='update_stop_id'>";
                                        $connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
                                        $queryString = "SELECT * FROM `stopy`";
                                        $stopyquery = mysqli_query($connection, $queryString);
                                        $stopyresults = mysqli_fetch_all($stopyquery);
                                        mysqli_close($connection);
                                        foreach($stopyresults as $stopyrow){
                                            if($row[7] == $stopyrow[0]){
                                                echo "<option value='$stopyrow[0]' selected>$stopyrow[1]</option>";
                                            }else{
                                                echo "<option value='$stopyrow[0]'>$stopyrow[1]</option>";
                                            }
                                        }
                                  echo "</select>
                                    </td>
                                    <td>
                                        <input type='text' name='update_rok'  value='$row[4]'/>
                                    </td>
                                    <td>
                                        <button type='submit'>
                                            <img src='gfx/faja.png' alt='ok'/>
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        ";
                    }else{
                        echo "<tr>";
                        echo "<td>";
                        echo "<form method='POST'>";
                        echo "<input type='hidden' name='action' value='editing_data'/>";
                        echo "<input type='hidden' name='editing_id' value='$row[5]'/>";
                        if($user_type == "admin"){
                            echo "<button type='submit' class='flag_button'>";
                            echo "<img src='gfx/$row[0]'/>";
                            echo "</button>";
                        }else{
                            echo "<img src='gfx/$row[0]'/>";
                        }
                        echo "</form>";
                        echo "</td>";
                        echo "<td>";
                        echo "$row[1]";
                        echo "</td>";
                        echo "<td>";
                        echo "$row[2]";
                        echo "</td>";
                        echo "<td>";
                        echo "$row[3]";
                        echo "</td>";
                        echo "<td>";
                        echo "$row[4]";
                        echo "</td>";
                        if($user_type == "admin"){
                            echo "<td>";
                            echo "<form method='POST'>
                            <input type='hidden' name='delete_id' value='$row[5]'/>
                            <input type='hidden' name='action' value='delete_data'/>
                            <input type='submit' class='delete_button' value=''/> 
                            </form>";
                            echo "</td>";    
                        }

                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
    <?php endif; ?>
    <?php if($user_type=="admin" || $user_type=="worker") : ?>
    <div id="insert_form">
        <form method="POST">
            <select name="insert_flaga_id" id="insert_flaga_id">
                <?php
                    $connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
                    $queryString = "SELECT * FROM `flagi`";
                    $query = mysqli_query($connection, $queryString);
                    $results = mysqli_fetch_all($query);
                    mysqli_close($connection);
                    foreach($results as $row){
                        echo "<option value='$row[0]'>$row[1]</option>";
                    }
                ?>
            </select>
            <input type="text" name="insert_nominal" id="insert_nominal"/>
            <input type="text" name="insert_nr_kat" id="insert_nr_kat"/>
            
            <select name="insert_stop_id" id="insert_stop_id">
                <?php
                    $connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
                    $queryString = "SELECT * FROM `stopy`";
                    $query = mysqli_query($connection, $queryString);
                    $results = mysqli_fetch_all($query);
                    mysqli_close($connection);
                    foreach($results as $row){
                        echo "<option value='$row[0]'>$row[1]</option>";
                    }
                ?>
            </select>
            <input type='hidden' name='action' value='insert_data'/>
            <input type="text" name="insert_rok" id="insert_rok"/>
            <input type="submit" value="" style="background-image: url(gfx/faja.png); width: 30px; height: 30px; background-color: green;"/>
        </form>
    </div>
    <?php endif; ?>
</body>
</html>