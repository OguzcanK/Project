<?php

$content = new TemplatePower("template/files/public_producten.tpl");
$content->prepare();

$action = GetAction();

switch ($action) {
    case "commenten":

        if (!empty($_POST['text'])) {
            if (isset($_POST['projectid'])) {

                $insert = $db->prepare("INSERT INTO comments
                                            SET Text = :text,
                                            Products_idProducts = :product,
                                            Accounts_idAccounts = :accountid,
                                            Blog_idblog = NULL
                                      ");
                $insert->bindParam(":text", $_POST['text']);
                $insert->bindParam(":product", $_POST['projectid']);
                $insert->bindParam(":accountid", $_SESSION['accountid']);
                $insert->execute();

                $content->newBlock("MELDING");
                $content->assign("MELDING", "Posted Comment");
            } else {

                $content->newBlock("COMMENTFORM");
                $content->assign(array(
                    "ACTION" => "index.php?pageid=13&action=commenten",
                    "BUTTON" => "Posted Comment",
                    "PROJECTID" => $_GET['projectid']));
            }
        } else {

            $content->newBlock("COMMENTFORM");
            $content->assign(array(
                "ACTION" => "index.php?pageid=13&action=commenten",
                "BUTTON" => "Posted Comment",
                "PROJECTID" => $_GET['projectid']));
        }
        break;
    default:

        if (isset($_GET['projectid'])) {
            // controleren of alles er is
            $content->newBlock("DETAILS");

            $check_project = $db->prepare("SELECT count(*)
                                            FROM products
                                            WHERE idProducts = :projectid
                                            ");
            $check_project->bindParam(":projectid", $_GET['projectid']);
            $check_project->execute();

            if ($check_project->fetchColumn() == 1) {

                $get_project = $db->prepare("SELECT p.*, a.Username
                                            FROM products p, accounts a
                                            WHERE p.idProducts = :projectid
                                                  AND p.Accounts_idAccounts = a.idAccounts
                                            ");
                $get_project->bindParam(":projectid", $_GET['projectid']);
                $get_project->execute();

                $project = $get_project->fetch(PDO::FETCH_ASSOC);
                
                $content->assign(array("TITLE" => $project['Title'],
                    "CONTENT" => $project['Content'],
                    "USERNAME" => $project['Username']));
            } else {
                $errors->newBlock("ERRORS");
                $errors->assign("ERROR", "There are no Projects");
            }
        } else {

            $check_projects = $db->query("SELECT count(*)
                                          FROM products
                                          ");

            if ($check_projects->fetchColumn() > 0) {

                $get_projects = $db->query("SELECT *
                                            FROM products
                                            ");

                $teller = 0;
                while ($projects = $get_projects->fetch(PDO::FETCH_ASSOC)) {

                    $teller++;
                    if ($teller % 3 == 1) {
                        // div openen
                        $content->newBlock("BEGIN");
                    }
                    // block van een element oproepen
                    $projectcontent = substr($projects['Content'], 0, 150) . " ...";
                    $content->newBlock("PROJECT");
                    $content->assign(array("TITLE" => $projects['Title'],
                        "CONTENT" => $projectcontent,
                        "PROJECTID" => $projects['idProducts']));
                    if ($teller % 3 == 0) {
                        // div sluiten
                        $content->newBlock("END");
                    }
                }
            } else {
                $errors->newBlock("ERRORS");
                $errors->assign("ERROR", "There are no Projects");
            }
        }

        if (isset($_GET['projectid'])) {
            if (!empty($_POST['text'])) {
                if (isset($_POST['projectid'])) {

                    $insert = $db->prepare("INSERT INTO comments
                                            SET Text = :text,
                                                Products_idProducts = :projectid,
                                                Accounts_idAccounts = :accountid,
                                                Blog_idBlog = NULL
                                            ");
                    $insert->bindParam(":text", $_POST['text']);
                    $insert->bindParam(":projectid", $_POST['projectid']);
                    $insert->bindParam(":accountid", $_SESSION['accountid']);
                    $insert->execute();

                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Posted Comment");
                } else {

                    $content->newBlock("COMMENTFORM");
                    $content->assign(array(
                        "ACTION" => "index.php?pageid=11&action=commenten",
                        "BUTTON" => "Posted Comment",
                        "PROJECTID" => $_GET['projectid']));

                }
            } else {

                if (isset($_SESSION['roleid'])) {
                    if ($_SESSION['roleid'] == 1 || 2) {

                        $content->newBlock("COMMENTFORM");
                        $content->assign(array(
                            "ACTION" => "index.php?pageid=13&action=commenten",
                            "BUTTON" => "Post Comment",
                            "PROJECTID" => $_GET['projectid']));

                    }
                }
            }

            $check_comment = $db->prepare("SELECT count(*)
                                           FROM products a, comments c
                                           WHERE c.Products_idProducts = :projectid
                                           ");
            $check_comment->bindParam(":projectid", $_GET['projectid']);
            $check_comment->execute();

            if ($check_comment->fetchColumn() > 0) {

                $content->newBlock("COMMENTLIST");

                $get_comments = $db->prepare("SELECT a.Username,
                                                     c.Text,
                                                     c.idComments
                                              FROM accounts a, comments c
                                              WHERE a.idAccounts = c.Accounts_idAccounts
                                                    AND c.Products_idProducts = :projectid
                                              ");
                $get_comments->bindParam(":projectid", $_GET['projectid']);
                $get_comments->execute();

                while ($comments = $get_comments->fetch(PDO::FETCH_ASSOC)) {
                    $content->newBlock("COMMENTROW");
                    $content->assign(array(
                        "USERNAME" => $comments['Username'],
                        "TEXT" => $comments['Text'],
                    ));
                    if(isset($_SESSION['roleid'])) {
                        if ($_SESSION['roleid'] == 2) {
                            $content->newBlock('ADMIN');
                            $content->assign("COMMENTID" , $comments['idComments']);
                        }
                    }
                }
                if(isset($_SESSION['roleid'])) {
                    if ($_SESSION['roleid'] == 2) {
                        $content->newBlock('ADMIN_2');
                        $content->assign("PROJECTID" , $_GET['projectid']);
                    }
                }
            } else {
                $content->newBlock("MELDING");
                $content->assign("MELDING", "There are no comments");
            }
        }
}
