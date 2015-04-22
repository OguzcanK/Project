<?php

$content = new TemplatePower("template/files/users.tpl");
$content->prepare();

$action = GetAction();
switch($action)
{
    case "change":
        if(isset($_GET['accountid']))
        {
            $check_user = $db->prepare("SELECT count(*) FROM accounts WHERE idAccounts = :accountid");
            $check_user->bindParam(":accountid", $_GET['accountid']);
            $check_user->execute();

            if($check_user->fetchColumn() == 1){
                $get_user = $db->prepare("SELECT users.*, accounts.* FROM users, accounts
                                      WHERE users.idUsers=accounts.Users_idUsers
                                      AND accounts.idAccounts = :accountid");
                $get_user->bindParam(":accountid", $_GET['accountid']);
                $get_user->execute();

                $user = $get_user->fetch(PDO::FETCH_ASSOC);

                $_SESSION['accountid'] = $user['idAccounts'];
                $_SESSION['username'] = $user['Username'];
                $_SESSION['email'] = $user['Email'];
                $_SESSION['roleid'] = $user['Role_idRole'];
                $content->newBlock("PROFILEROW");

                $content->newBlock("MELDING");
                $content->assign("MELDING", "Changed user");

            }else{
                $errors->newBlock("ERRORS");
                $errors->assign("ERROR", "Deze gebruiker bestaat niet. Hoe ben je hier gekomen?");
            }


        }elseif(isset($_POST['accountid'])){

            $delete = $db->prepare("DELETE FROM accounts WHERE idAccounts = :accountid");
            $delete->bindParam(":accountid", $_POST['accountid']);
            $delete->execute();

            $delete = $db->prepare("DELETE FROM users WHERE idUsers = :userid");
            $delete->bindParam(":userid", $_POST['userid']);
            $delete->execute();

            $content->newBlock("MELDING");
            $content->assign("MELDING", "Gebruiker is verwijderd");


        }else{
            $errors->newBlock("ERRORS");
            $errors->assign("ERROR", "Deze gebruiker bestaat helemaal niet. Hoe ben je hier gekomen???");
        }
        break;
    default:
        $content->newBlock("PROFILELIST");
            $get_users = $db->prepare("SELECT users.Email,
                                              accounts.Username,
                                              accounts.idAccounts
                                      FROM users, accounts
                                      WHERE users.idUsers = accounts.Users_idUsers
                                            AND users.Email = :email
                                      ");
            $get_users->bindParam(":email", $_SESSION['email']);
            $get_users->execute();

        while($users = $get_users->fetch(PDO::FETCH_ASSOC)){
            $content->newBlock("PROFILEROW");
            $content->assign(array(
                "USERNAME" => $users['Username'],
                "ACCOUNTID" => $users['idAccounts']
            ));
        }
}