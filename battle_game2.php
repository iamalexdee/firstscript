<?php


//Functions to set up characters
function initialiseCharacter($name) {
return [
    'name' => $name,
    'hp' => rand(10000,25000),
    'level' => rand (1,10),
    'luck' => rand (1,100)
];
}
//Initialise player and enemy
$player = initialiseCharacter("Alex");
$enemy = initialiseCharacter("Dire Wolf");

//Attack
function attack($attacker, &$target) {
    $basedamage = rand (1000 ,3000);
    $damage = $basedamage;
    $multiplier=rand(2,5);
    // echo "\nDEBUG: BASE DAMAGE " . $damage . "\n"; //DEBUG CODE
    if (criticalHit($attacker)){
        $damage = $basedamage * $multiplier;
        echo "\n" . $attacker ['name'] . " critically hits " . $target['name'] .  " for " . number_format($damage) . " damage! (" . number_format($basedamage) . " x " . $multiplier . ") \n";
    } else {
    echo "\n" . $attacker ['name'] . " attacks " . $target['name'] .  " for " . number_format($damage) . " damage.\n";
    }
    $target['hp'] -= $damage;
}
//Critical hit chance
function criticalHit($attacker) {
    $critical = rand (1, 100);
 echo "\n" . $attacker['name'] . "'s luck is " . $attacker['luck'] . ". Critical value is " . $critical . ".\n"; 
    if ($attacker['luck']>$critical) {
        return true;
    } else {
        return false;
    }

}

//Check health
function checkHP ($target) {
    if ($target ['hp']<1) { // Are they dead? Inform player
    echo $target['name'] .  " has died.\n";
    return true;
} else { // If not, report state of play
    echo $target['name'] . " has " . number_format($target['hp']) . " HP remaining.\n";
    return false;
}
}

echo "ALEX'S BATTLE SIMULATOR V1.2\n";

//Display player and monster status/names
echo "\n" . $player ['name'] . ": " . number_format($player ['hp']) . " HP\n";
echo $enemy ['name'] . ": " . number_format($enemy ['hp']) . " HP\n";

//Combat loop
$round=1;
echo "\n";

while(true) { // Figured this can just be endless since a break is in the loop itself
echo "Round "  . $round . "";
        attack ($player, $enemy);
        if (checkHP($enemy)) break; // Check if they're alive (false). Break loop if theyre dead (true)
        attack ($enemy, $player); 
        if (checkHP($player)) break;
        $round++;
        echo "\n";
 
    }
    echo "\nBattle finished. Thanks for playing!\n";