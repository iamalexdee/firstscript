<html>
<head>
  <link rel="stylesheet" href="styles.css">
</head>
<?php
$image=rand(1,3);
switch ($image){
    case 1:
        ?>
        <img src="images/orangeart.png" width="100%" height="50%">
        <?php
        break;
    case 2:
        ?>
        <img src="images/blueart.png" width="100%" height="20%">
        <?php
        break;
    case 3:
        ?>
        <img src="images/rainbowart.png" width="100%" height="20%">
        <?php
        break;
        default:
        echo "I have fucked up somewhere";
}
?>      
<h1>A PRE-DETERMINED OPEN WORLD ADVENTURE</h1>
<h2>2024 Alex Studios</h2>
<div class="container">
    <p>Hey there.</p>
<form method="get" action="battle_game4.php">
<h2>What should I call you?</h2>
<input type=text name="name"><br><br>
<h2>What is your enemy called?</h2>
<input type=text name="enemy"><br>
<h2>Are you ready to battle?</h2>
<input type="submit" type="submit">
</form>
</div>
    </html>