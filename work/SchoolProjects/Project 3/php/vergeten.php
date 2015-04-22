<?php
$content = new TemplatePower("template/files/vergeten.tpl");
$content->prepare();

$action = GetAction();

switch($action){
    case "1":
        //username vergeten
        $check_account = $db->prepare("SELECT count(u.idUsers)
                                      FROM users u, accounts a
                                      WHERE u.Email = :email
                                            AND u.idUsers = a.Users_idUsers
                                      ");
        $check_account->bindParam(":email", $_POST['email']);
        $check_account->execute();

        if($check_account->fetchColumn() == 1){

            $get_account = $db->prepare("SELECT a.*, u.*
                                         FROM users u, accounts a
                                         WHERE u.Email = :email
                                              AND u.idUsers = a.Users_idUsers
                                         ");
            $get_account->bindParam(":email", $_POST['email']);
            $get_account->execute();

            $account = $get_account->fetch(PDO::FETCH_ASSOC);

            $Select_username = $db->prepare("SELECT username
                                            FROM accounts
                                            WHERE idAccounts = :accountid
                                            ");
            $Select_username->bindParam(":accountid", $account['idAccounts']);
            $Select_username->execute();

            $selected_username = $Select_username->fetch(PDO::FETCH_ASSOC);
            $selected = $selected_username['username'];

            //Email information
            $admin_email = "oguz_66tr@hotmail.com";
            $email = $_POST['email'];
            $subject = "Forgot Password";
            $comment = "Here is your username: $selected";

            //send email
            mail($email, "$subject", $comment, "From:" . $admin_email);

            //Email response
            $content->newBlock("MELDING");
            $content->assign("MELDING", "An Email has been send to your emailadress");

        } else {
            $errors->newBlock("ERRORS");
            $errors->assign("ERROR", "This Email doesn't exist");
        }

        break;
    case "2":
            // password vergeten
                $check_account = $db->prepare("SELECT count(u.idUsers)
                                               FROM users u, accounts a
                                               WHERE u.Email = :email
                                                     AND u.idUsers = a.Users_idUsers
                                               ");
                $check_account->bindParam(":email", $_POST['email']);
                $check_account->execute();

                if($check_account->fetchColumn() == 1){

                    $get_account = $db->prepare("SELECT a.*, u.*
                                                FROM users u, accounts a
                                                WHERE u.Email = :email
                                                      AND u.idUsers = a.Users_idUsers
                                                ");
                    $get_account->bindParam(":email", $_POST['email']);
                    $get_account->execute();

                    $account = $get_account->fetch(PDO::FETCH_ASSOC);

                    $hash = hashgenerator();
                    $insert_hash = $db->prepare("UPDATE accounts
                                                SET Reset = :hash
                                                WHERE idAccounts = :accountid ");
                    $insert_hash->bindParam(":hash", $hash);
                    $insert_hash->bindParam(":accountid", $account['idAccounts']);
                    $insert_hash->execute();

                    //Email information
                    $admin_email = "oguz_66tr@hotmail.com";
                    $email = $_POST['email'];
                    $subject = "Forgot Password";
                    $comment = "Here is you code please fill this in http://localhost:63342/Website1b/index.php?pageid=17&action=4&code=$hash";

                    //send email
                    mail($email, "$subject", $comment, "From:" . $admin_email);

                    //Email response
                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "An Email has been send to your emailadress");

                } else {
                    $errors->newBlock("ERRORS");
                    $errors->assign("ERROR", "This Email doesn't exist");
                }
        break;
    case "3":
        // passowrd en username vergeten
        $check_account = $db->prepare("SELECT count(u.idUsers)
                                      FROM users u, accounts a
                                      WHERE u.Email = :email
                                            AND u.idUsers = a.Users_idUsers
                                      ");
        $check_account->bindParam(":email", $_POST['email']);
        $check_account->execute();

        if($check_account->fetchColumn() == 1){
            // gebruiker gevonden
            $get_account = $db->prepare("SELECT a.*, u.*
                                        FROM users u, accounts a
                                        WHERE u.Email = :email
                                              AND u.idUsers = a.Users_idUsers
                                        ");
            $get_account->bindParam(":email", $_POST['email']);
            $get_account->execute();

            $account = $get_account->fetch(PDO::FETCH_ASSOC);

            $hash = hashgenerator();
            $insert_hash = $db->prepare("UPDATE accounts
                                        SET Reset = :hash
                                        WHERE idAccounts = :accountid
                                        ");
            $insert_hash->bindParam(":hash", $hash);
            $insert_hash->bindParam(":accountid", $account['idAccounts']);
            $insert_hash->execute();

            $Select_username = $db->prepare("SELECT username FROM accounts
                                            WHERE idAccounts = :accountid
                                            ");
            $Select_username->bindParam(":accountid", $account['idAccounts']);
            $Select_username->execute();

            $selected_username = $Select_username->fetch(PDO::FETCH_ASSOC);
            $selected = $selected_username['username'];

            //Email information
            $admin_email = "oguz_66tr@hotmail.com";
            $email = $_POST['email'];
            $subject = "Forgot Password";
            $comment = "Here is your code please fill this in http://localhost:63342/Website1b/index.php?pageid=17&action=4&code=$hash
            and here is your username: $selected";

            //send email
            mail($email, "$subject", $comment, "From:" . $admin_email);

            //Email response
            $content->newBlock("MELDING");
            $content->assign("MELDING", "An Email has been send to your emailadress");
        }else{
            $errors->newBlock("ERRORS");
            $errors->assign("ERROR", "This Email doesn't exist");
        }
        break;
    case "4":
        //change password
        if(isset($_GET['code'])) {
            if (isset($_POST['password'])) {
                if ($_POST['password'] == $_POST['password_repeat']) {

                    $get_account = $db->prepare("SELECT a.*, u.*
                                                FROM users u, accounts a
                                                WHERE a.Reset = :reset
                                                      AND u.idUsers = a.Users_idUsers
                                                ");
                    $get_account->bindParam(":reset", $_GET['code']);
                    $get_account->execute();

                    $account = $get_account->fetch(PDO::FETCH_ASSOC);

                    $update_password = $db->prepare("UPDATE accounts
                                                    SET Password = :password
                                                    WHERE idAccounts = :accountid
                                                    ");
                    $password = sha1($_POST['password']);
                    $update_password->bindParam(":password", $password);
                    $update_password->bindParam(":accountid", $account['idAccounts']);
                    $update_password->execute();

                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Password changed");
                } else {
                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Passwords do not match");

                    $content->newBlock("CHANGE_PASSWORD");
                    $content->assign("ACTION", "index.php?pageid=17&action=4&code=".$_GET['code']);
                }
            } else {
                $content->newBlock("CHANGE_PASSWORD");
                $content->assign("ACTION", "index.php?pageid=17&action=4&code=".$_GET['code']);
            }
        }else {
            UrlChangeError($errors);
        }
        break;
    default:
        $content->newBlock("VERGETENFORM");
        $content->assign("ACTION", "index.php?pageid=17&action=".$_GET['option']);
}