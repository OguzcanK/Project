<?php

$content = new TemplatePower("template/files/public_blog.tpl");
$content->prepare();

$action = GetAction();

switch ($action) {
    case "commenten":
        if (!empty($_POST['text'])) {
            if (isset($_POST['blogid'])) {

                $insert = $db->prepare("INSERT INTO comments
                                            SET Text = :text,
                                            Blog_idBlog = :blogid,
                                            Accounts_idAccounts = :accountid,
                                            Products_idProducts = NULL");
                $insert->bindParam(":text", $_POST['text']);
                $insert->bindParam(":blogid", $_POST['blogid']);
                $insert->bindParam(":accountid", $_SESSION['accountid']);
                $insert->execute();
                $content->newBlock("MELDING");
                $content->assign("MELDING", "Comment Posted");

            }else {

                $content->newBlock("COMMENTFORM");

                $content->assign(array(
                    "ACTION" => "index.php?pageid=12&action=commenten",
                    "BUTTON" => "Post Comment",
                    "BLOGID" => $_GET['blogid']));
            }
        } else {

            $content->newBlock("COMMENTFORM");

            $content->assign(array(
                "ACTION" => "index.php?pageid=12&action=commenten",
                "BUTTON" => "Post Comment",
                "BLOGID" => $_GET['blogid']));
        }
        break;
    default:

        if (isset($_GET['blogid'])) {
            // controleren of alles er is
            $content->newBlock("DETAILS");

            $check_blog = CheckBlog($db);

            if ($check_blog->fetchColumn() == 1) {

                $get_blog = $db->prepare("SELECT b.*, a.Username
                                          FROM blog b, accounts a
                                          WHERE b.idBlog = :blogid
                                                AND b.Accounts_idAccounts = a.idAccounts
                                          ");

                $get_blog->bindParam(":blogid", $_GET['blogid']);
                $get_blog->execute();
                $blog = $get_blog->fetch(PDO::FETCH_ASSOC);
                $content->assign(array(
                    "TITLE" => $blog['Title'],
                    "CONTENT" => $blog['Content'],
                    "USERNAME" => $blog['Username']));
            }else {
                $errors->newBlock("ERRORS");
                $errors->assign("ERROR", "There are no Blogs");
            }
        } else {

            $check_blog = $db->query("SELECT count(*)
                                      FROM blog
                                      ");

            if ($check_blog->fetchColumn() > 0) {

                $get_blog = $db->query("SELECT *
                                        FROM blog, accounts
                                        WHERE Accounts_idAccounts = accounts.idAccounts
                                        ");

                $teller = 0;
                while ($blog = $get_blog->fetch(PDO::FETCH_ASSOC)) {
                    $teller++;
                    if ($teller % 3 == 1) {
                        // div openen
                        $content->newBlock("BEGIN");
                    }
                    // block van een element oproepen
                    $blogcontent = substr($blog['Content'], 0, 150) . " ...";
                    $content->newBlock("BLOG");
                    $content->assign(array("TITLE" => $blog['Title'],
                        "CONTENT" => $blogcontent,
                        "BLOGID" => $blog['idBlog'],
                        "USERNAME" => $blog['Username']));
                    if ($teller % 3 == 0) {
                        // div sluiten
                        $content->newBlock("END");
                    }
                }
            } else {
                $errors->newBlock("ERRORS");
                $errors->assign("ERROR", "There are no Blogs");
            }
        }
if(isset($_GET['blogid'])) {
    if (!empty($_POST['text'])) { // voorwaarde => insert
        if (isset($_POST['blogid'])) {

            $insert = $db->prepare("INSERT INTO comments
                                            SET Text = :text,
                                                Blog_idBlog = :blogid,
                                                Accounts_idAccounts = :accountid,
                                                Products_idProducts = NULL");
            $insert->bindParam(":text", $_POST['text']);
            $insert->bindParam(":blogid", $_POST['blogid']);
            $insert->bindParam(":accountid", $_SESSION['accountid']);
            $insert->execute();

            $content->newBlock("MELDING");
            $content->assign("MELDING", "Posted Comment");
        } else {

            $content->newBlock("COMMENTFORM");
            $content->assign(array(
                "ACTION" => "index.php?pageid=11&action=commenten",
                "BUTTON" => "Post Comment",
                "BLOGID" => $_GET['blogid']));
        }
    } else {

        if(isset($_SESSION['roleid'])){
            if($_SESSION['roleid'] == 1 || 2){

                $content->newBlock("COMMENTFORM");
                $content->assign(array(
                    "ACTION" => "index.php?pageid=11&action=commenten",
                    "BUTTON" => "Post Comment",
                    "BLOGID" => $_GET['blogid']));
            }
        }
    }

    $check_comment = $db->prepare("SELECT count(*)
                                  FROM blog a, comments c
                                  WHERE c.Blog_idBlog = :blogid
                                  ");
    $check_comment->bindParam(":blogid", $_GET['blogid']);
    $check_comment->execute();

    if ($check_comment->fetchColumn() > 0) {

        $get_comments = $db->prepare("SELECT a.Username,
                                              c.Text,
                                              c.idComments
                                              FROM accounts a, comments c
                                              WHERE a.idAccounts = c.Accounts_idAccounts
                                                    AND  c.Blog_idBlog = :blogid
                                      ");
        $get_comments->bindParam(":blogid", $_GET['blogid']);
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
                $content->assign("BLOGID" , $_GET['blogid']);

            }
        }
    } else {
        $content->newBlock("MELDING");
        $content->assign("MELDING", "There are no comments");
    }
}
}
