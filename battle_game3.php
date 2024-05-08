<?php

// crit chance = player luck+player level - enemy level
//random = rand(1,10) x 9 + 1


//Functions to set up characters
function initialiseCharacter($name) {
    $level= rand(1,50);
    $hp= $level*123;
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
$player = initialiseCharacter("Alex");
$enemy = initialiseCharacter("Dire Wolf");

//Attack
function attack($attacker, &$target) {
    $basedamage = $attacker['atk']*rand(1,100);
    $damage = $basedamage;
    // echo "\nDEBUG: BASE DAMAGE " . $damage . "\n"; //DEBUG CODE
    if (criticalHit($attacker, $target)){
        $damage = $basedamage *1.5;
        echo "\n" . $attacker ['name'] . " critically hits " . $target['name'] .  " for " . number_format($damage) . " damage! (" . number_format($basedamage) . " x2" . ") \n";
    } else {
    echo "\n" . $attacker ['name'] . " attacks " . $target['name'] .  " for " . number_format($damage) . " damage.\n";
    }
    $target['hp'] -= $damage;
}
//Critical hit chance
function criticalHit($attacker, $target) {
    $critical=max(0,$attacker['luck']+$attacker['level']-$target['level']);
    $critvariable = rand(1,20)*9;
 echo "\n" . $attacker['name'] . "'s luck is " . $critical . ". Compared against a randomly generated value of {$critvariable}.";
    if ($critical>$critvariable) {
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

//Display player and monster status/names
echo str_repeat("##",20);
echo "\nALEX'S BATTLE SIMULATOR V1.3\nCopyright 2024 Alex Studios, all rights reserved (probably).\n";
echo "\n" . $player ['name'] . " (LVL " . $player ['level'] . "): " . number_format($player ['hp']) . " HP\n";
echo $enemy ['name'] . " (LVL " . $enemy ['level'] . "): " . number_format($enemy ['hp']) . " HP\n";
echo str_repeat("##",20) . "\n";

//Combat loop
$round=1;
echo "\n";

while(true) { // Figured this can just be endless since a break is in the loop itself
echo "Round " . $round;
        attack ($player, $enemy);
        if (checkHP($enemy)) break; // Check if they're alive (false). Break loop if theyre dead (true)
        attack ($enemy, $player); 
        if (checkHP($player)) break;
        $round++;
        echo "\n";
 
    }
    echo "\nBattle finished. Thanks for playing!\n";