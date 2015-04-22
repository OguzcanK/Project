<?php

$content = new TemplatePower("template/files/blog.tpl");
$content->prepare();

$action = GetAction();

if(isset($_SESSION['roleid'])) {
    if ($_SESSION['roleid'] == 2) {

        $content->newBlock('ADMIN');

     switch ($action) {
         case "toevoegen":

                if (!empty($_POST['title']) AND !empty($_POST['content'])) {

                    $insert = $data->prepare("INSERT INTO blog
                                              SET Title = :title,
                                                  Content = :content,
                                                  Accounts_idAccounts = :account
                                            ");
                    $insert->bindParam(":title", $_POST['title']);
                    $insert->bindParam(":content", $_POST['content']);
                    $insert->bindParam(":account", $_SESSION['accountid']);
                    $insert->execute();

                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Blog is added");
                }else {

                    $content->newBlock("BLOGFORM");
                    $content->assign(array("ACTION" => "index.php?pageid=3&action=toevoegen",
                        "BUTTON" => "Add new Blog"));
                }
                break;
         case "wijzigen":

                if (isset($_GET['blogid'])) {

                    $check_blog = CheckBlog($db);

                    GetBlog($db, $check_blog,$content, $errors, $action);

                } elseif (!empty($_POST['title'])
                    AND !empty($_POST['content'])
                    AND !empty($_POST['blogid'])
                ) {
                    $update = $db->prepare("UPDATE blog
                                            SET Title = :title,
                                                Content = :content
                                                WHERE idBlog = :idblog");
                    $update->bindParam(":title", $_POST['title']);
                    $update->bindParam(":content", $_POST['content']);
                    $update->bindParam(":idblog", $_POST['blogid']);
                    $update->execute();

                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Blog Updated");
                } else {
                    UrlChangeError($errors);
                }
                break;
         case "verwijderen":
                if (isset($_GET['blogid'])) {

                    $check_blog = CheckBlog($db);

                    GetBlog($db, $check_blog,$content, $errors, $action);

                } elseif (isset($_POST['blogid'])) {

                    $delete = $db->prepare("DELETE FROM blog
                                            WHERE idBlog = :blogid");
                    $delete->bindParam(":blogid", $_POST['blogid']);
                    $delete->execute();

                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Blog Deleted");
                } else {
                    UrlChangeError($errors);
                }
                break;
         default:
// checken of er blogs zijn
                $More = 'No';

                $check_blog = $db->query("SELECT count(b.idBlog)
                                          FROM accounts a, blog b
                                          WHERE a.idAccounts = b.Accounts_idAccounts");
                if ($check_blog->fetchColumn() > 0) {

                    if(!empty($_POST['search'])){
                        try {

                            $check_blog = $db->prepare("SELECT count(b.idBlog)
                                                      FROM accounts a, blog b
                                                      WHERE a.idAccounts = b.Accounts_idAccounts
                                                            AND b.Title LIKE :zoek
                                                            OR b.Content LIKE :zoek1
                                                      ");
                            $search = "%" . $_POST['search'] . "%";
                            $check_blog->bindParam(":zoek", $search);
                            $check_blog->bindParam(":zoek1", $search);
                            $check_blog->execute();

                        }catch(PDOException $error){
                            $errors->newBlock("ERRORS");
                            $errors->assign("ERROR", "Something went wrong");
                            break;
                        }
                        if($check_blog->fetchColumn() > 0){
                            // nu heb ik resultaten
                            $content->newBlock("BLOGLIST");
                            $get_blog1 = $db->prepare("SELECT a.Username,
                                                              b.Title,
                                                              b.Content,
                                                              b.idBlog
                                                      FROM accounts a, blog b
                                                      WHERE a.idAccounts = b.Accounts_idAccounts
                                                            AND  (b.Title LIKE :zoek
                                                            OR b.Content LIKE :zoek1)
                                                      ");
                            $get_blog1->bindParam(":zoek", $search );
                            $get_blog1->bindParam(":zoek1", $search);
                            $get_blog1->execute();

                            $content->newBlock("MELDING");
                            $content->assign("MELDING", "Search Succes");
                        }else{
                            // melding laten zien, geen resultaten (geen tabel)
                            $content->newBlock("MELDING");
                            $content->assign("MELDING", "No search results");
                            break;
                        }
                    }else {
                        // overzicht laten zien alles uit db
                        $check_blogs = $db->query("SELECT count(b.idBlog)
                                                  FROM accounts a, blog b
                                                  WHERE a.idAccounts = b.Accounts_idAccounts
                                                  ");

                        if ($check_blogs->fetchColumn() > 0) {

                            $content->newBlock("BLOGLIST");
                            $get_blog1 = $db->query("SELECT a.Username,
                                                            b.Title,
                                                            b.Content,
                                                            b.idBlog
                                                    FROM accounts a, blog b
                                                    WHERE a.idAccounts = b.Accounts_idAccounts
                                                    ");

                        }else{
                            $content->newBlock("MELDING");
                            $content->assign("MELDING", "No search results");
                            break;
                        }
                    }
                    while ($blogs = $get_blog1->fetch(PDO::FETCH_ASSOC)) {
                        $content->newBlock("BLOGROW");
                        $inhoud = $blogs['Content'];
                        if (strlen($inhoud) > 30) {
                            $inhoud = substr($blogs['Content'], 0, 30) . "...";
                        }
                        $content->assign(array(
                            "USERNAME" => $blogs['Username'],
                            "TITEL" => $blogs['Title'],
                            "CONTENT" => $inhoud,
                            "BLOGID" => $blogs['idBlog']
                        ));
                    }
                }
        }
    }
}