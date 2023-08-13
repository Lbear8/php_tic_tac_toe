<!DOCTYPE html>

<html>
    <!--basic header stuff, might return to later if I want to expand this -->
    <head>
        <meta charset="UTF-8">
        <Title></Title>
    </head>

    <body>
        <form method="POST" action="index.php">
            <?php
                // here be variables
                $count = 0;
                $boardSize= 5;
                $p1 = "x";
                $p2 = "o";
                $winArray = array_fill(0, $boardSize, "");
                $p1Wins = false;
                $p2Wins = false;
                $error = false;

                // these next two lines build the game board
                for($id = 1; $id <= $boardSize*$boardSize; $id++){
                    if($id > 1 and $id % $boardSize == 1) print "<br>";

                    // this line makes a box
                    print "<input name = $id type = text size =8";

                    // still not entirely sure what this line does
                    if(isset($_POST['submit']) and !empty($_POST[$id])){

                        // ensures valid inputs i.e. x and o
                        if($_POST[$id] == $p1 or $_POST[$id] == $p2){
                            $count += 1;
                            print " value = " . $_POST[$id] . " readonly>";

                            // checking horizontal ie lines
                            // this loop goes line by line
                            for($a = 1; $a <= ($boardSize * ($boardSize - 1)) + 1; $a += $boardSize){

                                // this for loop fills an array with each value in said line
                                for($b = $a, $increment = 0; $b <= $a + $boardSize - 1, $increment < $boardSize;
                                $b++, $increment++){
                                    $winArray[$increment] = $_POST["$b"];
                                }

                                // check every value of the array against the previous one
                                // if any 2 don't match, we don't have a winner
                                $weHaveAWinner = true;
                                for($c = 1; $c < $boardSize; $c++){
                                    if($winArray[$c] != $winArray[$c - 1]) $weHaveAWinner = false;
                                }

                                // if all elements are the same, whichever player's value was in the array wins
                                if($weHaveAWinner and $winArray[0] == $p1) $p1Wins = true;
                                elseif($weHaveAWinner and $winArray[0] == $p2) $p2Wins = true;
                            }

                            // checking vertical ie columns
                            // this loop looks at the top of each column
                            for($a = 1; $a <= $boardSize; $a++){

                                // this for loop fills an array with each value in that column
                                for($b = $a, $increment = 0; $b <= ($boardSize*($boardSize - 1)) + $a, $increment < $boardSize;
                                $b += $boardSize, $increment++){
                                    $winArray[$increment] = $_POST["$b"];
                                }

                                // check every value of the array against the previous one
                                // if any 2 don't match, we don't have a winner
                                $weHaveAWinner = true;
                                for($c = 1; $c < $boardSize; $c++){
                                    if($winArray[$c] != $winArray[$c - 1]) $weHaveAWinner = false;
                                }

                                // if all elements are the same, whichever player's value was in the array wins
                                if($weHaveAWinner and $winArray[0] == $p1) $p1Wins = true;
                                elseif($weHaveAWinner and $winArray[0] == $p2) $p2Wins = true;
                            }

                            // maybe 1 loop for each of the 2 diagonals?
                            // backslash wincheck
                            // start at 1, end at bS*bS
                            // add bS + 1
                            // fill array
                            // do checks
                            // forward slash wincheck
                            // start at bS, end at (bS*(bS-1))+1
                            // add bS - 1
                            // fill array
                            // do checks

                            // checking diagonals
                            // need to have something to contain the wincheck within a scope, idk exactly how to explain it
                            if(!$p1Wins and !$p2Wins){

                                // this loop fills the array with the back slash values
                                for($a = 1, $increment = 0; $a <= $boardSize*$boardSize, $increment < $boardSize;
                                $a += ($boardSize + 1), $increment++){
                                    $winArray[$increment] = $_POST["$a"];
                                }

                                // check every value of the array against the previous one
                                // if any 2 don't match, we don't have a winner
                                $weHaveAWinner = true;
                                for($c = 1; $c < $boardSize; $c++){
                                    if($winArray[$c] != $winArray[$c - 1]) $weHaveAWinner = false;
                                }

                                // if all elements are the same, whichever player's value was in the array wins
                                if($weHaveAWinner and $winArray[0] == $p1) $p1Wins = true;
                                elseif($weHaveAWinner and $winArray[0] == $p2) $p2Wins = true;
                            }

                            // once again something to contain the wincheck
                            if(!$p1Wins and !$p2Wins){

                                // this loop fills the array with the forward slash values
                                for($a = $boardSize, $increment = 0; $a <= ($boardSize*($boardSize - 1)) + 1, $increment < $boardSize;
                                $a += ($boardSize - 1), $increment++){
                                    $winArray[$increment] = $_POST["$a"];
                                }

                                // check every value of the array against the previous one
                                // if any 2 don't match, we don't have a winner
                                $weHaveAWinner = true;
                                for($c = 1; $c < $boardSize; $c++){
                                    if($winArray[$c] != $winArray[$c - 1]) $weHaveAWinner = false;
                                }

                                // if all elements are the same, whichever player's value was in the array wins
                                if($weHaveAWinner and $winArray[0] == $p1) $p1Wins = true;
                                elseif($weHaveAWinner and $winArray[0] == $p2) $p2Wins = true;
                            }

                        }
                        // if the input was neither x nor o, or whatever p1 and p2 use
                        else{
                            print ">";
                            $error = true;
                        }
                    }

                    // no idea what this does but apparently it's necessary
                    else{
                        print ">";
                    }
                }
            ?>
            <p><input name="submit" type="submit"></p>
        </form>
        <?php
            if($p1Wins) print $p1 . " wins!";
            elseif($p2Wins) print $p2 . " wins!";
            elseif($count == $boardSize*$boardSize and !$p1Wins and !$p2Wins) print "It's a draw!";
            elseif($error) print "Oi! Type " . $p1 . " or " . $p2 . " ONLY!";
            else print "Please enter either " . $p1 . " or " . $p2 . ".";
        ?>
    </body>
</html>