<h1>1a</h1>
<form method="POST">
    <label>Ile cyfr wypisać</label>
    <input type="text" name="howMuch">
    <input type="submit" value="OK">
</form>

<?php
    $writeOut = "";
    if(!empty($_POST['howMuch'])){
        for($i=1; $i<=$_POST["howMuch"]; $i++){
            $writeOut = $writeOut . $i . " ";
        }
        echo $writeOut;
    }
?>

<h1>1b</h1>
<form method="POST">
    <label>Ile cyfr wypisać</label>
    <input type="text" name="howMuch2">
    <input type="submit" value="OK">
</form>

<?php
    $writeOut = "";
    if(!empty($_POST['howMuch2'])){
        for($i=1; $i<=$_POST["howMuch2"]; $i++){
            $writeOut = $writeOut . $i . "<br>";
        }
        echo $writeOut;
    }
?>

<h1>1c</h1>
<form method="POST">
    <label>Od ilu maleć</label>
    <input type="text" name="howMuch3">
    <input type="submit" value="OK">
</form>

<?php
    $writeOut = "";
    if(!empty($_POST['howMuch3'])){
        for($i=$_POST["howMuch3"]; $i>=1; $i--){
            $writeOut = $writeOut . $i . " ";
        }
        echo $writeOut;
    }
?>

<h1>1d</h1>
<form method="POST">
    <label>start:</label>
    <input type="text" name="start">
    <label>krok:</label>
    <input type="text" name="step">
    <label>koniec:</label>
    <input type="text" name="end">
    <input type="submit" value="ok">
</form>

<?php
    if(!empty($_POST['start']) && !empty($_POST['step']) && !empty($_POST['end'])){
        $start = $_POST['start'];
        $step = $_POST['step'];
        $end = $_POST['end'];
        $writeOut = "";

        if($start <= $end){
            for($i = $start; $i<=$end; $i = $i+$step){
                $writeOut = $writeOut . $i . " ";
            }
        }else if($start > $end){
            for($i = $start; $i >= $end; $i = $i-$step){
                $writeOut = $writeOut . $i . " ";
            }
        }

        echo $writeOut;
    }
?>

<h1>2</h1>

<form method="POST">
    <select name="ageChoose">
    <?php 
        for($i = 1; $i <= 133; $i++){
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
    ?>
    </select>
    <input type="submit" value="OK">
</form>

<?php
    if(!empty($_POST['ageChoose'])){
        echo $_POST['ageChoose'] . '! Jesteś w kwiecie wieku!';
    }
?>

<h1>3</h1>

<form method="POST">
    <label>Ile cyfr</label>
    <input type="text" name="howMuch4">
    <br>
    <label>pion/poziom</label>
    <select name="porp">
        <option value="poziom">poziom</option>
        <option value="pion">pion</option>
    </select>
    <br>
    <label>krok:</label>
    <input type="text" name="step2">
    <input type="submit" value="ok">
</form>

<?php
    if(!empty($_POST['howMuch4']) && !empty($_POST['porp']) && !empty($_POST['step2'])){
        //print_r($_POST['howMuch4']);
        echo '<table border="1"> <tbody>';
        if($_POST['porp'] == "poziom"){
            echo '<tr>';
            for($i = 1; $i <= $_POST['howMuch4']; $i = $i+$_POST['step2']){
                echo '<td>'.$i.'</td>';
            }
            echo '</tr>';
        }
        else{
            for($i = 1; $i <= $_POST['howMuch4']; $i = $i + $_POST['step2']){
                echo '<tr><td>'.$i.'</td></tr>';
            }
        }
        echo '</tbody></table>';
    }
?>

<h1>4</h1>
<form method="POST">
    <label>wierszy:</label>
    <input type="text" name="wiersze" style="width:30px">
    <label>kolumn:</label>
    <input type="text" name="kolumny" style="width:30px">
    <input type="submit" value="OK">
</form>

<?php 
    if(!empty($_POST['wiersze']) && !empty($_POST['kolumny'])){
        $licznik = 1;
        echo '<table border="1"><tbody>';
        for($i = 1; $i <= $_POST['wiersze']; $i++){
            echo '<tr>';
            for($x = 1; $x <= $_POST['kolumny']; $x++){
                echo '<td>'.$licznik.'</td>';
                $licznik++;
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
    }
?>

<h1>5</h1>
<p>SZACHOWNICA</p>
<form method="POST">
    <label>wierszy:</label>
    <input type="text" name="wiersze2" style="width:30px">
    <label>kolumn:</label>
    <input type="text" name="kolumny2" style="width:30px">
    <input type="submit" value="OK">
</form>

<?php 
    if(!empty($_POST['wiersze2']) && !empty($_POST['kolumny2'])){
        $licznik2 = 1;
        echo '<table border="1"><tbody>';
        for($i = 1; $i <= $_POST['wiersze2']; $i++){
            echo '<tr>';
            for($x = 1; $x <= $_POST['kolumny2']; $x++){
                if(($i % 2 != 0 && $x % 2 != 0) || ($i % 2 == 0 && $x % 2 == 0)){
                    echo '<td style="width:20px; height:20x; background-color:white;"></td>';
                }else{
                    echo '<td style="width:20px; height:20px; background-color:black;"></td>';
                }
                
                $licznik2++;
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
    }
?>

<h1>6a</h1>
<form method="POST">
    <label>rozmiar:</label>
    <input type="text" name="size">
    <input type="submit" value="OK">
</form>

<?php
    if(!empty($_POST['size'])){
        echo '<table border="1"><tbody>';
        for($i=1;$i<=$_POST['size']; $i++){
            echo '<tr>';
            for($x=1; $x<=$_POST['size']; $x++){  
                echo '<td>'.$i * $x.'</td>';
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
    }
?>

<h1>6b</h1>
<form method="POST">
    <label>rozmiar:</label>
    <input type="text" name="size2">
    <input type="submit" value="OK">
</form>

<?php
    if(!empty($_POST['size2'])){
        echo '<table><tbody>';
        for($i=0;$i<=$_POST['size2']; $i++){
            echo '<tr>';
            for($x=0; $x<=$_POST['size2']; $x++){  
                if(($i == 0 && $x != 0) || ($i != 0 && $x == 0)){
                    echo '<td style="background-color:grey; width:15px; height:15px;" >'.$i + $x.'</td>';
                }else if($i == 0 && $x == 0){
                    echo '<td style="background-color:white; width:15px; height:15px;" ></td>';
                }else{
                    echo '<td style="background-color:white; width:15px; height:15px;" >'. $i * $x.'</td>';
                }
                
            }
            echo '</tr>';
            
        }
        echo '</tbody></table>';
    }
?>