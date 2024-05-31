<html>
<head>
  <link rel="stylesheet" href="styles.css">
</head>
<?php
//Functions to set up characters
function initialiseCharacter($name) {
    $level= rand(14,25);
    $hp= $level*223;
    $atk=$level*1.4;
return [
    'name' => $name,
    'hp' => $hp,
    'level' => $level,
    'luck' => rand (1,100),
    'atk' => $atk
];
}
//Initialise player and enemy
$player = initialiseCharacter($_GET['name']);
$enemy = initialiseCharacter($_GET['enemy']);

//Attack
function attack($attacker, &$target) {
    $basedamage = $attacker['atk']*rand(1,20);
    $damage = $basedamage;
    // echo "<br>DEBUG: BASE DAMAGE " . $damage . "<br>"; //DEBUG CODE
    if (criticalHit($attacker, $target)){
        $damage = $basedamage *1.5;
        ?>
        <div class="criticalhit"> <?=$attacker ['name'] . " critically hits " . $target['name'] .  " for " . number_format($damage) . " damage! (" . number_format($basedamage) . " x1.5" . ") <br>";?></div>
        <?php
    } else {
    echo "<p>" . $attacker ['name'] . " attacks " . $target['name'] .  " for " . number_format($damage) . " damage.</p>";
    }
    $target['hp'] -= $damage;
}
//Critical hit chance
function criticalHit($attacker, $target) {
    $critical=max(0,$attacker['luck']+$attacker['level']-$target['level']);
    $critvariable = rand(1,20)*9;
    ?>
 <p><?=$attacker['name'];?>'s luck is <?=$critical;?>. Compared against a randomly generated value of <?=$critvariable;?>.</p>
   <?php
   if ($critical>$critvariable) {
        return true;
    } else {
        return false;
    }

}

//Check health
function checkHP ($target) {
    if ($target ['hp']<1) { // Are they dead? Inform player
        echo "<p>" . $target['name'] .  " has died.<br>";
    return true;
} else { // If not, report state of play
    echo "<p>" . $target['name'] . " has " . number_format($target['hp']) . " HP remaining.<br>";
    return false;
}
}
?>
<h1>ALEX'S BATTLE SIMULATOR V1.3</h1>
<h2><?=$player['name']?> is Level <?=$player['level']?> with <?=$player['hp']?> HP.</h2>
<h2><?=$enemy['name']?> is Level <?=$enemy['level']?> with <?=$enemy['hp']?> HP.</h2>

<?php
//Combat loop
$round=1;
echo "<br>";

while(true) { // Figured this can just be endless since a break is in the loop itself
echo "<h2>Round " . $round . "</h2>";
        attack ($player, $enemy);
        if (checkHP($enemy)) break; // Check if they're alive (false). Break loop if theyre dead (true)
        attack ($enemy, $player); 
        if (checkHP($player)) break;
        $round++;
 
    }
    echo "<br>Battle finished. Thanks for playing!<br>";
