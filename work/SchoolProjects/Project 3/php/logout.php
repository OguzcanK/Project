<?php

$content = new TemplatePower("template/files/logout.tpl");
$content->prepare();

$_SESSION['accountid'] = "";
$_SESSION['username'] = "";
$_SESSION['roleid'] = "";
$_SESSION['email'] = "";

unset($_SESSION['accountid']);
unset($_SESSION['username']);
unset($_SESSION['roleid']);
unset($_SESSION['email']);
