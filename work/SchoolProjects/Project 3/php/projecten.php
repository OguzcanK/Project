<?php

$content = new TemplatePower("template/files/projecten.tpl");
$content->prepare();

$action = GetAction();

if(isset($_SESSION['roleid'])) {
    if ($_SESSION['roleid'] == 2) {

        $content->newBlock('ADMIN');

        switch ($action) {
            case "toevoegen":

                if (!empty($_POST['title']) AND !empty($_POST['content'])) {

                    $insert = $db->prepare("INSERT INTO products
                                                  SET Title = :title,
                                                      Content = :content,
                                                      Accounts_idAccounts = :account
                                          ");
                    $insert->bindParam(":title", $_POST['title']);
                    $insert->bindParam(":content", $_POST['content']);
                    $insert->bindParam(":account", $_SESSION['accountid']);
                    $insert->execute();
                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Add new Project");
                } else {

                    $content->newBlock("PROJECTFORM");
                    $content->assign(array("ACTION" => "index.php?pageid=9&action=toevoegen",
                        "BUTTON" => "Add new Project"));
                }
                break;
            case "wijzigen":

                if (isset($_GET['Projectid'])) {

                    $check_project = CheckProducts($db);

                    GetProducts($db, $content, $check_project, $errors, $action);

                } elseif (!empty($_POST['title'])
                    AND !empty($_POST['content'])
                    AND !empty($_POST['Projectid'])
                ) {
                    $update = $db->prepare("UPDATE products
                                                  SET Title = :title,
                                                  Content = :content
                                                  WHERE idProducts = :idProject
                                          ");
                    $update->bindParam(":title", $_POST['title']);
                    $update->bindParam(":content", $_POST['content']);
                    $update->bindParam(":idProject", $_POST['Projectid']);
                    $update->execute();

                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Project Updated");
                } else {
                    UrlChangeError($errors);
                }
                break;
            case "verwijderen":

                if (isset($_GET['Projectid'])) {

                    $check_project = CheckProducts($db);

                    GetProducts($db, $content, $check_project, $errors, $action);

                } elseif (isset($_POST['Projectid'])) {

                    $delete = $db->prepare("DELETE FROM products
                                                  WHERE idProducts = :Projectid
                                          ");
                    $delete->bindParam(":Projectid", $_POST['Projectid']);
                    $delete->execute();

                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Project Deleted");
                } else {
                    UrlChangeError($errors);
                }
                break;
            default:

                $check_projects = $db->query("SELECT count(b.idProducts)
                                              FROM accounts a, products b
                                              WHERE a.idAccounts = b.Accounts_idAccounts
                                              ");

                if ($check_projects->fetchColumn() > 0) {

                    // checken of er projecten zijn
                    if (!empty($_POST['search'])) {
                        // heb ik resultaten met de search
                        // check of ik resultaten heb
                        try {
                            $check_project = $db->prepare("SELECT count(p.idProducts)
                                                          FROM accounts a, products p
                                                          WHERE a.idAccounts = p.Accounts_idAccounts
                                                                AND p.Title LIKE :zoek
                                                                OR p.Content LIKE :zoek1
                                                          ");
                            $search = "%" . $_POST['search'] . "%";
                            $check_project->bindParam(":zoek", $search);
                            $check_project->bindParam(":zoek1", $search);
                            $check_project->execute();

                        } catch (PDOException $error) {
                            $errors->newBlock("ERRORS");
                            $errors->assign("ERROR", "Something went wrong");
                            break;
                        }
                        if ($check_project->fetchColumn() > 0) {
                            // nu heb ik resultaten
                            $content->newBlock("PROJECTLIST");
                            $get_projects = $db->prepare("SELECT a.Username,
                                                                  p.Title,
                                                                  p.Content,
                                                                  p.idProducts
                                                                  FROM accounts a, products p
                                                                  WHERE a.idAccounts = p.Accounts_idAccounts
                                                                        AND  (p.Title LIKE :zoek
                                                                        OR p.Content LIKE :zoek1)
                                                          ");
                            $get_projects->bindParam(":zoek", $search);
                            $get_projects->bindParam(":zoek1", $search);
                            $get_projects->execute();

                            $content->newBlock("MELDING");
                            $content->assign("MELDING", "Search Succes");
                        } else {
                            // melding laten zien, geen resultaten (geen tabel)
                            $content->newBlock("MELDING");
                            $content->assign("MELDING", "No search results");
                            break;
                        }
                    } else {
                        // overzicht laten zien alles uit db
                        $check_projects = $db->query("SELECT count(p.idProducts)
                                                      FROM accounts a, products p
                                                      WHERE a.idAccounts = p.Accounts_idAccounts
                                                      ");

                        if ($check_projects->fetchColumn() > 0) {

                            $content->newBlock("PROJECTLIST");
                            $get_projects = $db->query("SELECT a.Username,
                                                               p.Title,
                                                               p.Content,
                                                               p.idProducts
                                                       FROM accounts a, products p
                                                       WHERE a.idAccounts = p.Accounts_idAccounts
                                                       ");
                        } else {
                            $content->newBlock("MELDING");
                            $content->assign("MELDING", "No search results");
                            break;
                        }
                    }
                    while ($projects = $get_projects->fetch(PDO::FETCH_ASSOC)) {
                        $content->newBlock("PROJECTROW");
                        $inhoud = $projects['Content'];
                        if (strlen($inhoud) > 30) {
                            $inhoud = substr($projects['Content'], 0, 30) . "...";
                        }
                        $content->assign(array(
                            "USERNAME" => $projects['Username'],
                            "TITLE" => $projects['Title'],
                            "CONTENT" => $inhoud,
                            "PROJECTID" => $projects['idProducts']
                        ));
                    }
                }
        }
    }else{
            // je hebt niet de goede rechten
            $errors->newBlock("ERRORS");
            $errors->assign("ERROR", "You are not an Admin");
        }
    } else {
        // je bent niet ingelogd
        $errors->newBlock("ERRORS");
        $errors->assign("ERROR", "Log in please");
    }

