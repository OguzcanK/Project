<!DOCTYPE html>
<html>
<head>
    <title>Rock Paper Scissor Lizard Spock</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../PHP/stylesheet.css" type="text/css" >
</head>
<body>


<div id="platform">
    <!-- START BLOCK : FORMULIER -->
    <form class="Game" method="post" action="../PHP/Game.php" name="item">
    <ul id="game">
        <li><button type="submit" name="item" value="rock"><img src="../PHP/rock.jpg" alt="rock"></button></li>
        <li><button type="submit" name="item" value="paper"><img src="../PHP/paper.jpg" alt="paper"></button></li>
        <li><button type="submit" name="item" value="scissor"><img src="../PHP/scissor.jpg" alt="scissor"></button></li>
        <li><button type="submit" name="item" value="lizard"><img src="../PHP/lizard.jpg" alt="lizard"></button></li>
        <li><button type="submit" name="item" value="spock"><img src="../PHP/spock.jpg" alt="spock"></button></li>
    </ul>

    </form>
    <!-- END BLOCK : FORMULIER -->

    <!-- START BLOCK : INGEVULD -->

    <img src="{UITSLAG}" class="uitslag" alt="1"/>
    <img src="{ITEM}" class="item" alt="" />
    <img src="{COMP_ITEM}" class="compitem" alt="" />
    <form method="post" action="">
    <p class="win">Win:  {WIN}</p>
    <p class="tie">Tie:  {TIE}</p>
    <p class="lose">Lose:  {LOSE}</p>
    </form>
    <!-- END BLOCK : INGEVULD -->

</div>

<div id="rules">
    <fieldset>
        <legend>The Rules</legend>
        <ul>
            <li class="combinations">Scissors cut paper</li>
            <li class="combinations">Paper covers rock</li>
            <li class="combinations">Rock crushes lizard</li>
            <li class="combinations">Lizard poisons Spock</li>
            <li class="combinations">Spock smashes scissors</li>
            <li class="combinations">Scissors decapitate lizard</li>
            <li class="combinations">Lizard eats paper</li>
            <li class="combinations">Paper disproves Spock</li>
            <li class="combinations">Spock vaporizes rock</li>
            <li class="combinations">Rock crushes scissors</li>
        </ul>
    </fieldset>
</div>
</body>
</html>