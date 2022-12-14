<h1>1</h1>
<form method="POST">
    <input type="text" name="txtVal">
    <input type="submit" value="OK">
</form>

<?php
if (empty($_POST["txtVal"])) {
    print_r("wypisano:");
} else {
    print_r("wypisano:" . $_POST["txtVal"]);
}
?>

<h1>2</h1>

<p>Ile masz lat?</p>
<form method="POST" action="age.php">
    <input type="text" name="yoVal">
    <input type="submit" value="OK">
</form>

<h1>3</h1>

<p>Lubisz zime?</p>
<form method="POST">
    <select name="zima">
        <option value="t">TAK!</option>
        <option value="n">NIE</option>
    </select>
    <input type="submit" value="OK">
</form>

<?php
if (!empty($_POST["zima"])) {
    $wynik = $_POST["zima"] == 't' ? 'Ja tez' : 'Szkoda :(';
    print_r($wynik);
}
?>

<h1>4a</h1>

<form method="POST">
    <input type="text" name="firstVal">
    <select name="sign">
        <option value="<">&lt;</option>
        <option value="<=">&lt;=</option>
        <option value="=">=</option>
        <option value=">=">&gt;</option>
        <option value=">">&gt;=</option>
    </select>
    <input type="text" name="secondVal">
    <label>?</label>
    <input type="submit" value="OK">

</form>

<?php
if (!empty($_POST["sign"]) && !empty($_POST["firstVal"]) && !empty($_POST["secondVal"])) {

    //print_r($_POST['sign2'] . $_POST['firstVal2'] . $_POST['secondVal2']);

    $wynik2 = false;
    $znak2 = $_POST['sign'];
    $c2 = $_POST['firstVal'];
    $d2 = $_POST['secondVal'];

    //print_r($znak . $c . $d);

    if ($znak2 == "<") {
        if ($c2 < $d2) {
            echo "prawda";
        } else {
            echo "fałsz";
        }
    } else if ($znak2 == "<=") {
        if ($c2 <= $d2) {
            echo "prawda";
        } else {
            echo "fałsz";
        }
    } else if ($znak2 == "=") {
        if ($c2 == $d2) {
            echo "prawda";
        } else {
            echo "fałsz";
        }
    } else if ($znak2 == ">=") {
        if ($c2 >= $d2) {
            echo "prawda";
        } else {
            echo "fałsz";
        }
    } else if ($znak2 == ">") {
        if ($c2 > $d2) {
            echo "prawda";
        } else {
            echo "fałsz";
        }
    }
}
?>

<h1>4b</h1>

<?php

// print_r($znak);
$znaki = [["<", "&lt;"], ["<=", "&lt;="], ["=", '='], ["=>", "=&gt;"], [">", "&gt;"]];
session_start();
$_SESSION['znak'] = "<";
if (!empty($_POST['sign2'])) {
    print_r($_POST['sign2']);
    echo '<form method="POST">
        <input type="text" name="firstVal2">
        <select name="sign2">';

    foreach ($znaki as $znakuse) {
        if ($znakuse[0] == $_POST['sign2']) {
            //print_r("TEST");
            echo '<option value="' . $znakuse[0] . '" selected>' . $znakuse[1] . '</option>';
            //echo "true";
        } else {
            echo '<option value="' . $znakuse[0] . '">' . $znakuse[1] . '</option>';
            //echo "false";
        }
    }

    echo '</select>
                <input type="text" name="secondVal2">
                <label>?</label>
                <input type="submit" value="OK">
                </form>';
} else {
?><form method="POST">
        <input type="text" name="firstVal2">
        <select name="sign2">
            <option hidden value="<?php $_SESSION['znak']; ?>"> </option>
            <option value="<">&lt;</option>
            <option value="<=">&lt;=</option>
            <option value="=">=</option>
            <option value=">=">&gt;=</option>
            <option value=">">&gt;</option>
        </select>
        <input type="text" name="secondVal2">
        <label>?</label>
        <input type="submit" value="OK">
    </form>
<?php
}



if (!empty($_POST["sign2"]) && !empty($_POST["firstVal2"]) && !empty($_POST["secondVal2"])) {

    //print_r($_POST['sign2'] . $_POST['firstVal2'] . $_POST['secondVal2']);

    $wynik = false;
    $znak = $_POST['sign2'];
    $c = $_POST['firstVal2'];
    $d = $_POST['secondVal2'];

    //print_r($znak . $c . $d);
    $_SESSION['znak'] = $znak;
    if ($znak == "<") {
        if ($c < $d) {
            echo "prawda";
        } else {
            echo "fałsz";
        }
    } else if ($znak == "<=") {
        if ($c <= $d) {
            echo "prawda";
        } else {
            echo "fałsz";
        }
    } else if ($znak == "=") {
        if ($c == $d) {
            echo "prawda";
        } else {
            echo "fałsz";
        }
    } else if ($znak == ">=") {
        if ($c >= $d) {
            echo "prawda";
        } else {
            echo "fałsz";
        }
    } else if ($znak == ">") {
        if ($c > $d) {
            echo "prawda";
        } else {
            echo "fałsz";
        }
    }
}
?>

<h1>5</h1>
<form method="POST">
    <input type="text" name="aVal" style="width:20px">
    <label>x</label>
    <sup>2</sup>
    <label>+</label>
    <input type="text" name="bVal" style="width:20px">
    <label>x+</label>
    <input type="text" name="cVal" style="width:20px">
    <label>= 0</label>
    <input type="submit" value="OK">
</form>

<?php
if (!empty($_POST['aVal']) && !empty($_POST['bVal']) && !empty($_POST['cVal'])) {
    $a = $_POST['aVal'];
    $b = $_POST['bVal'];
    $c = $_POST['cVal'];
    $delta = $b * $b - (4 * $a * $c);

    if ($delta < 0) {
        echo 'Δ = ' . $delta . ' brak pierwiastków';
    } else if ($delta == 0) {
        $pierw0 = ((-1 * $b) - $delta) / 2 * $a;
        echo 'Δ = <input style="color:red; width:30px;" value="' . $delta . '" disabled> x<sub>0</sub> = <input style="color:green; width:30px;" value="' . $pierw0 . '" disabled>';
    } else if ($delta > 0) {
        $pierw1 = ((-1 * $b) - sqrt($delta)) / 2 * $a;
        $pierw2 = ((-1 * $b) + sqrt($delta)) / 2 * $a;
        echo 'Δ = <input style="color:red; width:30px;" value="' . $delta . '" disabled> x<sub>1</sub> = <input style="color:green; width:30px;" value="' . $pierw1 . '" disabled>, x<sub>2</sub> = <input style="color:green; width:30px;" value="' . $pierw2 . '" disabled>';
    }
}
?>