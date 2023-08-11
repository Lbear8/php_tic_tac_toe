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
                $boardSize= 3;
                $horizWinLength = 3;
                $vertWinLength = 1;
                $p1 = "x";
                $p2 = "o";
                $p1Wins = false;
                $p2Wins = false;
                $error = false;

                // these 2 loops build the game board
                for($i = 1; $i<= $boardSize; $i++){
                    for($id = 1; $id <= $boardSize; $id++){

                        // this line makes a box
                        print "<input name = $id type = text size =8>";

                        // still not entirely sure what this line does
                        // FIXME f*** around and find out
                        if(isset($_POST['submit']) and !empty($_POST[$id])){

                            // ensures valid inputs i.e. x and o
                            if($_POST[$id] == $p1 or $_POST[$id] == $p2){
                                print "value = $_POST[$id]";

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
                                // each round of the for loop checks a whole line at a time
                                for($a = 1, $b = 2, $c = 3; $a < 7, $b <= 8, $c <= 9;
                                $a += $horizWinLength, $b += $horizWinLength, $c += $horizWinLength){
                                    if($_POST[$a] == $_POST[$b] and $_POST[$b] == $_POST[$c]){
                                        if($_POST[$a] == $p1) $p1Wins = true;
                                        else $p2Wins = true;
                                    }
                                }

                                // checking vertical ie columns
                                // each round checks a whole column at a time
                                for($a = 1, $b = 4, $c = 3; $a < 7, $b <= 8, $c <= 9;
                                $a += $horizWinLength, $b += $horizWinLength, $c += $horizWinLength){
                                    if($_POST[$a] == $_POST[$b] and $_POST[$b] == $_POST[$c]){
                                        if($_POST[$a] == $p1) $p1Wins = true;
                                        else $p2Wins = true;
                                    }
                                }
                            }
                            else{
                                $error = true;
                            }
                        }
                    }
                    print"<br>";
                }
            ?>
        </form>

    </body>
</html>