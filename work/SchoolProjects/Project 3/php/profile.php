<?php
$content = new TemplatePower("template/files/profile.tpl");
$content->prepare();

$action = GetAction();

switch($action) {
    case "wijzigen":

        if (isset($_POST['accountid'])) {

            $update_account = $db->prepare("UPDATE accounts
                                                SET Username = :username
                                                WHERE idAccounts = :accountid
                                            ");
            $update_account->bindParam(":username", $_POST['gnaam']);
            $update_account->bindParam(":accountid", $_POST['accountid']);
            $update_account->execute();

            $update_user = $db->prepare("UPDATE users
                                              SET Surename = :achternaam,
                                                  Name = :voornaam,
                                                  Email = :email
                                                  WHERE idUsers = :userid
                                        ");
            $update_user->bindParam(":achternaam", $_POST['anaam']);
            $update_user->bindParam(":voornaam", $_POST['vnaam']);
            $update_user->bindParam(":email", $_POST['email']);
            $update_user->bindParam(":userid", $_POST['userid']);
            $update_user->execute();

        }else {

            $get_user = $db->prepare("SELECT users.*, accounts.*
                                      FROM users, accounts
                                      WHERE users.idUsers=accounts.Users_idUsers
                                            AND accounts.idAccounts = :accountid
                                      ");
            $get_user->bindParam(":accountid", $_GET['accountid']);
            $get_user->execute();

            $user = $get_user->fetch(PDO::FETCH_ASSOC);

            $content->newBlock("PROFILEFORM");
            $content->assign("ACTION", "index.php?pageid=6&action=wijzigen");
            $content->assign("BUTTON", "Change");

            $content->assign(array(
                "VOORNAAM" => $user['Name'],
                "ACHTERNAAM" => $user['Surename'],
                "EMAIL" => $user['Email'],
                "USERNAME" => $user['Username'],
                "ACCOUNTID" => $user['idAccounts'],
                "USERID" => $user['idUsers']
            ));
        }
        break;
    default:

        $get_users = $db->prepare("SELECT users.Surename,
                                          users.Name,
                                          users.Email,
                                          accounts.Username,
                                          accounts.idAccounts
                                  FROM users, accounts
                                  WHERE users.idUsers = accounts.Users_idUsers
                                        AND accounts.Username = :username
                                  ");
        $get_users->bindParam(":username", $_SESSION['username']);
        $get_users->execute();

        $users = $get_users->fetch(PDO::FETCH_ASSOC);

            $content->newBlock("HEADERPROFILE");
            $content->assign(array(
                "USERNAME" => $users['Username'],
                "ACCOUNTID" => $users['idAccounts']
            ));

            $content->newBlock("PROFILELIST");

            $content->assign(array(
                "VOORNAAM" => $users['Name'],
                "ACHTERNAAM" => $users['Surename'],
                "EMAIL" => $users['Email'],
                "USERNAME" => $users['Username'],
                "ACCOUNTID" => $users['idAccounts']
            ));
}