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
                $boardSize= 3;
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

                            // determining a winner
                            // FIXME make valid for any # of boxes
                            // I'm thinking nested for loop 
                            // outside goes from 1 to (bS*(bS-1))+1 (horizontal) or bS (vertical)
                            // adds bS (horizontal) or 1 (vertical)
                            // inside goes from outside val to outside val + bS - 1 (horizontal) or (bS*(bS-1)+outside val
                            // adds 1 (horizontal) or bS (vertical)
                            // add each val to array of length w (horizontal) or l (vertical)
                            // check all values in array match
                            // no clue what to do for diag yet but dw I'll get it

                            // checking horizontal ie lines
                            // this loop goes line by line
                            for($a = 1; $a <= ($boardSize * ($boardSize - 1)) + 1; $a += $boardSize){

                                // this for loop fills an array with each value in said line
                                for($b = $a, $increment = 0; $b <= $a + $boardSize - 1, $increment < $boardSize;
                                $b++, $increment++){
                                    $winArray[$increment] == $_POST["$b"];
                                }

                                // check every value of the array against the previous one
                                // if any 2 don't match, we don't have a winner
                                $weHaveAWinner = true;
                                for($c = 1; $c < $boardSize; $c++){
                                    if($winArray[$c] != $winArray[$c - 1]) $weHaveAWinner = false;
                                }

                                // if all elements are the same,
                                // whichever player's value was in the box that the outside loop is looking at wins
                                if($weHaveAWinner and $_POST["$a"] == $p1) $p1Wins = true;
                                elseif($weHaveAWinner and $_POST["$a"] == $p2) $p2Wins = true;
                            }

                            // checking vertical ie columns
                            // this loop looks at the top of each column
                            for($a = 1; $a <= $boardSize; $a++){

                                // this for loop fills an array with each value in that column
                                for($b = $a, $increment = 0; $b <= ($boardSize*($boardSize - 1)) + $a, $increment < $boardSize;
                                $b += $boardSize, $increment++){
                                    $winArray[$increment] == $_POST["$b"];
                                }

                                // check every value of the array against the previous one
                                // if any 2 don't match, we don't have a winner
                                $weHaveAWinner = true;
                                for($c = 1; $c < $boardSize; $c++){
                                    if($winArray[$c] != $winArray[$c - 1]) $weHaveAWinner = false;
                                }

                                // if all elements are the same,
                                // whichever player's value was in the box that the outside loop is looking at wins
                                if($weHaveAWinner and $_POST["$a"] == $p1) $p1Wins = true;
                                elseif($weHaveAWinner and $_POST["$a"] == $p2) $p2Wins = true;
                            }

                            // checking diagonals
                            // the tutorial giver typed $c <= 9 and didn't see an issue but I noticed right away
                            // feels good man
                            for($a = 1, $b = 5, $c = 9; $a < 3, $b <= 5, $c >= 7; $a += 2, $b += 0, $c -= 2){
                                if($_POST["$a"] == $_POST["$b"] and $_POST["$b"] == $_POST["$c"]){
                                    if($_POST["$a"] == $p1) $p1Wins = true;
                                    elseif($_POST["$a"] == $p2) $p2Wins = true;
                                }
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
            elseif($count == 9 and !$p1Wins and !$p2Wins) print "It's a draw!";
            elseif($error) print "Oi! Type " . $p1 . " or " . $p2 . " ONLY!";
            else print "Please enter either " . $p1 . " or " . $p2 . ".";
        ?>
    </body>
</html>