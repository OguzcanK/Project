<?php
$content = new TemplatePower("template/files/register.tpl");
$content->prepare();

Register($db, $content, $errors, $RegisterAs);