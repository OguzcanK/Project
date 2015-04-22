<?php
session_start();
include ('../TemplatePower/class.TemplatePower.inc.php');

$tpl = new TemplatePower("../Tmp/index.tpl");

$tpl->prepare();

$tpl->newBlock('FORMULIER');

if(isset($_POST ['item'])) {
//All items
    $items = array(
        'scissor',
        'paper',
        'rock',
        'lizard',
        'spock'
    );

//User item pick
    $user_item = $_POST['item'];

//Computer Random Pick
    $comp_item = $items[rand(0, 4)];

    $tpl->newBlock('INGEVULD');
    $img_win = "goodjob.jpg";
    $img_lose = "lost.png";
    $img_tie = "Tie.jpg";
    $img_rock = "rock.jpg";
    $img_paper = "paper.jpg";
    $img_scissor = "scissor.jpg";
    $img_lizard = "lizard.jpg";
    $img_spock = "spock.jpg";

    if(!isset($_SESSION['win']) && !isset($_SESSION['lose']) && !isset($_SESSION['tie'] ))
    {
        $_SESSION['win']=0;
        $_SESSION['lose']=0;
        $_SESSION['tie']=0;
    }

/*    if(isset($_POST['reset'])) {
        $wincount = 0;
        $losecount = 0;
        $tie = 0;
    }*/

//if user item beats computer item
    if ($user_item == 'scissor' && $comp_item == 'paper'    ||
        $user_item == 'scissor' && $comp_item == 'lizard'   ||
        $user_item == 'paper'   && $comp_item == 'rock'     ||
        $user_item == 'paper'   && $comp_item == 'spock'    ||
        $user_item == 'rock'    && $comp_item == 'scissor'  ||
        $user_item == 'rock'    && $comp_item == 'lizard'   ||
        $user_item == 'lizard'  && $comp_item == 'spock'    ||
        $user_item == 'lizard'  && $comp_item == 'paper'    ||
        $user_item == 'spock'   && $comp_item == 'rock'     ||
        $user_item == 'spock'   && $comp_item == 'rock'
    ) {

        $_SESSION['win']++;
        $wincount = $_SESSION['win'];

        $tpl->assign("UITSLAG", $img_win );

        switch ($user_item) {
            case "rock":
                $tpl->assign("ITEM", $img_rock );
                break;
            case "paper":
                $tpl->assign("ITEM", $img_paper );
                break;
            case "scissor":
                $tpl->assign("ITEM", $img_scissor );
                break;
            case "lizard":
                $tpl->assign("ITEM", $img_lizard );
                break;
            case "spock":
                $tpl->assign("ITEM", $img_spock );
                break;
        }
        switch ($comp_item) {
            case "rock":
                $tpl->assign("COMP_ITEM", $img_rock );
                break;
            case "paper":
                $tpl->assign("COMP_ITEM", $img_paper );
                break;
            case "scissor":
                $tpl->assign("COMP_ITEM", $img_scissor );
                break;
            case "lizard":
                $tpl->assign("COMP_ITEM", $img_lizard );
                break;
            case "spock":
                $tpl->assign("COMP_ITEM", $img_spock );
                break;
        }

    } //If computer item beats user item
    elseif (
        $comp_item == 'scissor' && $user_item == 'paper' ||
        $comp_item == 'scissor' && $user_item == 'lizard' ||
        $comp_item == 'paper' && $user_item == 'rock' ||
        $comp_item == 'paper' && $user_item == 'spock' ||
        $comp_item == 'rock' && $user_item == 'scissor' ||
        $comp_item == 'rock' && $user_item == 'lizard' ||
        $comp_item == 'lizard' && $user_item == 'spock' ||
        $comp_item == 'lizard' && $user_item == 'paper' ||
        $comp_item == 'spock' && $user_item == 'rock' ||
        $comp_item == 'spock' && $user_item == 'scissor'
    ) {

        $_SESSION['lose']++;
        $losecount= $_SESSION['lose'];

        $tpl->assign("UITSLAG", $img_lose );

        switch ($user_item) {
            case "rock":
                $tpl->assign("ITEM", $img_rock );
                break;
            case "paper":
                $tpl->assign("ITEM", $img_paper );
                break;
            case "scissor":
                $tpl->assign("ITEM", $img_scissor );
                break;
            case "lizard":
                $tpl->assign("ITEM", $img_lizard );
                break;
            case "spock":
                $tpl->assign("ITEM", $img_spock );
                break;
        }
        switch ($comp_item) {
            case "rock":
                $tpl->assign("COMP_ITEM", $img_rock );
                break;
            case "paper":
                $tpl->assign("COMP_ITEM", $img_paper );
                break;
            case "scissor":
                $tpl->assign("COMP_ITEM", $img_scissor );
                break;
            case "lizard":
                $tpl->assign("COMP_ITEM", $img_lizard );
                break;
            case "spock":
                $tpl->assign("COMP_ITEM", $img_spock );
                break;
        }

    } //If user item is equal to computer item
    else {
        $tpl->assign("UITSLAG", $img_tie );

        $_SESSION['tie']++;
        $tie = $_SESSION['tie'];

        switch ($user_item) {
            case "rock":
                $tpl->assign("ITEM", $img_rock );
                break;
            case "paper":
                $tpl->assign("ITEM", $img_paper );
                break;
            case "scissor":
                $tpl->assign("ITEM", $img_scissor );
                break;
            case "lizard":
                $tpl->assign("ITEM", $img_lizard );
                break;
            case "spock":
                $tpl->assign("ITEM", $img_spock );
                break;
        }
        switch ($comp_item) {
            case "rock":
                $tpl->assign("COMP_ITEM", $img_rock );
                break;
            case "paper":
                $tpl->assign("COMP_ITEM", $img_paper );
                break;
            case "scissor":
                $tpl->assign("COMP_ITEM", $img_scissor );
                break;
            case "lizard":
                $tpl->assign("COMP_ITEM", $img_lizard );
                break;
            case "spock":
                $tpl->assign("COMP_ITEM", $img_spock );
                break;
        }
    }

    $tpl->assign("LOSE", $_SESSION['lose']);
    $tpl->assign("WIN", $_SESSION['win']);
    $tpl->assign("TIE", $_SESSION['tie']);
}
$tpl->printToScreen();
?>