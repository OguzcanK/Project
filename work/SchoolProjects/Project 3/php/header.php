<?php
// Hier laad ik de header.html in
$header = new TemplatePower("template/files/header.tpl");
$header->prepare();

$active = 'class="active"';
$dropdown_active = 'active';

if (isset($_GET['nav'])) {
    switch ($_GET['nav']) {
        case 'home':
            $header->assign("HOMEACTIVE", $active );
            break;
        case 'projecten':
            $header->assign("PROJECTENACTIVE", $active );
            break;
        case 'blog':
            $header->assign("BLOGACTIVE", $active );
            break;
        case 'admin':
            $header->assign("ADMINACTIVE", $dropdown_active );
            break;
        case 'account':
            $header->assign("ACCOUNTACTIVE", $dropdown_active );
            break;
    }
}

if(isset($_SESSION['accountid'])){

    $header->newBlock("LOGGEDIN");
    $header->assign("USERNAME", $_SESSION['username']);

    if(isset($_SESSION['roleid'])) {
        if ($_SESSION['roleid'] == 2) {

            $header->newBlock('ADMIN');

        }
    }
}else {
    $header->newBlock("LOGINTOP");
}
