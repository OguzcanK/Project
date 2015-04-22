<?php

$content = new TemplatePower("template/files/comments.tpl");
$content->prepare();

$action = GetAction();

if(isset($_SESSION['roleid'])) {
    if ($_SESSION['roleid'] == 2) {

        $content->newBlock('ADMIN');

        switch ($action) {
            case "wijzigen":

                if (isset($_GET['commentid'])) {

                    $check_comment = CheckComments($db);

                    GetComments($db, $content, $check_comment, $errors, $action);

                } elseif (!empty($_POST['text'])
                    AND !empty($_POST['commentid'])
                ) {
                    $update = $db->prepare("UPDATE comments
                                            SET Text = :text
                                            WHERE idComments = :idcomment
                                            ");
                    $update->bindParam(":text", $_POST['text']);
                    $update->bindParam(":idcomment", $_POST['commentid']);
                    $update->execute();
                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Comment Updated");
                }else {
                    UrlChangeError($errors);
                }
                break;
            case "verwijderen":

                if (isset($_GET['commentid'])) {

                    $check_comment = CheckComments($db);

                    GetComments($db, $content, $check_comment, $errors, $action);

                } elseif (isset($_POST['commentid'])) {

                    $delete = $db->prepare("DELETE FROM comments
                                            WHERE idComments = :commentid
                                            ");
                    $delete->bindParam(":commentid", $_POST['commentid']);
                    $delete->execute();

                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Comment Deleted");
                } else {
                    UrlChangeError($errors);
                }
                break;
            default:

                $check_comments = $db->query("SELECT count(b.idComments)
                                              FROM accounts a, comments b
                                              WHERE a.idAccounts = b.Accounts_idAccounts
                                              ");
                if ($check_comments->fetchColumn() > 0) {

                    $content->newBlock("COMMENTLIST");

                    if (!empty($_POST['search'])) {

                        GetComments($db, $content, $check_comments, $errors, $action);

                        $content->assign("SEARCH", $_POST['search']);

                    }else {
                        $get_comments = $db->query("SELECT a.Username,
                                                           b.Text,
                                                           b.idComments
                                                    FROM accounts a, comments b
                                                    WHERE a.idAccounts = b.Accounts_idAccounts
                                                    ");

                        while ($comments = $get_comments->fetch(PDO::FETCH_ASSOC)) {
                            $content->newBlock("COMMENTROW");
                            $content->assign(array(
                                "USERNAME" => $comments['Username'],
                                "TEXT" => $comments['Text'],
                                "COMMENTID" => $comments['idComments']
                            ));
                        }
                    }
                } else {
                    $errors->newBlock("ERRORS");
                    $errors->assign("ERROR", "There are no Comments");
                }
        }
    }
}