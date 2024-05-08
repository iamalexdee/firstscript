<?php
// Set the player and enemy HP
$monsterhp = rand(100, 2000);
$hp = rand(100, 2000);

//Calculate player and enemy luck
$playerluck = rand (2000,5000);
$enemyluck = rand (2000,5000);

function initialiseCharacter($name, $hp) {
return [
    'name' => $name,
    'hp' => rand(1000,2000)
];
}

// Battle introduction
echo "ALEX'S BATTLE SIMULATOR V1.1<br>";
echo "I am giving you {$hp}HP.<br>" . "The enemy has {$monsterhp}HP.<br>";
echo "'Hello, I am a monster and will now hit you :)'<br>";
echo "An overkill will be called if the killing blow was your current HP+200 or higher.<br>";
// Create loop, calculate monster damage and hit the player
do {
    $enemy_damage = rand(100, 500);
    // Store current health to check for overkill
    $current_health = $hp;
    $hp -= $enemy_damage;
    // Inform player of the event 
    echo "<br>The enemy hits you for {$enemy_damage}HP!";
    if ($enemy_damage > $current_health + 200) {
        echo "<br>Overkill (remaining health+200 or more)!";
    } elseif ($enemy_damage > $current_health) {
        echo "<br>You drop your sword and stumble to the ground...<br>";
    }
    // Check if player died and game over them if so
    if ($hp < 1) {
        echo "<br>You have died ({$hp} HP lol).<br>";
    } else {
        // If the player survived, inform them
        echo "<br>You now have {$hp}HP.";
    }
    echo "<br>";
    // Check if alive, player takes turn if so
    if ($hp > 0) {
        $player_damage = rand(100, 500);
        $monsterhp -= $player_damage;
        echo "<br>You strike the enemy for {$player_damage}HP!";
        if ($monsterhp<1)
        echo "<br>The monster has died! ({$monsterhp}HP)";
        else {
                    echo "<br>The monster now has {$monsterhp}HP.";
                    echo "<br>";
                    
        }
        }
//Keep going until one of them is dead
} while ($hp > 0 && $monsterhp > 0); 
?>
