<?php

function CheckComments($conn){
    $check_comment = $conn->prepare("SELECT count(*) FROM comments c, accounts a WHERE
                                                    a.idAccounts = c.Accounts_idAccounts AND
                                                    idComments = :commentid");
    $check_comment->bindParam(":commentid", $_GET['commentid']);
    $check_comment->execute();

    return $check_comment;
}

function GetComments($conn, $content, $check, $errors, $action){
    if ($check->fetchColumn() > 0) {
// hij bestaat in db
        $get_comment = $conn->prepare("SELECT * FROM
                                                    accounts a, comments b
                                                    WHERE a.idAccounts = b.Accounts_idAccounts
                                                    AND b.idComments = :commentid");
        $get_comment->bindParam(":commentid", $_GET['commentid']);
        $get_comment->execute();
        $comments = $get_comment->fetch(PDO::FETCH_ASSOC);
        $content->newBlock("COMMENTFORM");
        $content->assign(array(
            "TEXT" => $comments['Text'],
            "COMMENTID" => $comments['idComments'],
            "ACTION" => "index.php?pageid=15&action=$action",
            "BUTTON" => "Comments $action"
        ));

        return $comments;
    } else {
        $errors->newBlock("ERRORS");
        $errors->assign("ERROR", "Waarom heb je het Commentid in de url veranderd???");
    }
}

function CheckProducts($conn){
    $check_project = $conn->prepare("SELECT count(*) FROM
                                                  accounts a, products b
                                                  WHERE a.idAccounts = b.Accounts_idAccounts
                                                  AND b.idProducts = :Projectid");
    $check_project->bindParam(":Projectid", $_GET['Projectid']);
    $check_project->execute();

    return $check_project;
}

function GetProducts($conn, $content, $check, $errors, $action){
    if ($check->fetchColumn() > 0) {
    $get_product = $conn->prepare("SELECT * FROM
                                                    accounts a, products b
                                                    WHERE a.idAccounts = b.Accounts_idAccounts
                                                    AND b.idProducts = :Projectid");
    $get_product->bindParam(":Projectid", $_GET['Projectid']);
    $get_product->execute();
    $products = $get_product->fetch(PDO::FETCH_ASSOC);
    $content->newBlock("PROJECTFORM");
    $content->assign(array(
        "TITLE" => $products['Title'],
        "CONTENT" => $products['Content'],
        "PROJECTID" => $products['idProducts'],
        "ACTION" => "index.php?pageid=9&action=$action",
        "BUTTON" => "Project $action"
    ));

        return $products;
    } else {
    $errors->newBlock("ERRORS");
    $errors->assign("ERROR", "Waarom heb je het Projectid in de url veranderd???");
}
}

function CheckBlog($conn){
    $check_blog = $conn->prepare("SELECT count(*) FROM
                                                  accounts a, blog b
                                                  WHERE a.idAccounts = b.Accounts_idAccounts
                                                  AND b.idBlog = :blogid");
    $check_blog->bindParam(":blogid", $_GET['blogid']);
    $check_blog->execute();

    return $check_blog;
}

function GetBlog($conn, $check_blog, $content, $errors, $action ){
    if ($check_blog->fetchColumn() > 0) {
// hij bestaat in db
    $get_blog = $conn->prepare("SELECT * FROM
                                                    accounts a, blog b
                                                    WHERE a.idAccounts = b.Accounts_idAccounts
                                                    AND b.idBlog = :blogid");
    $get_blog->bindParam(":blogid", $_GET['blogid']);
    $get_blog->execute();
    $blog = $get_blog->fetch(PDO::FETCH_ASSOC);
    $content->newBlock("BLOGFORM");
    $content->assign(array(
        "TITLE" => $blog['Title'],
        "CONTENT" => $blog['Content'],
        "BLOGID" => $blog['idBlog'],
        "ACTION" => "index.php?pageid=3&action=$action",
        "BUTTON" => "Blog $action"
    ));
} else {
        $errors->newBlock("ERRORS");
        $errors->assign("ERROR", "Waarom heb je het blogid in de url veranderd???");
    }
}

function GetAction(){
    if(isset($_GET['action']))
    {
        $action = $_GET['action'];
        return $action;

    }else{
        $action = NULL;
        return $action;
    }
}

function hashgenerator(){
    $string = "abcdefghijklmnopqrstuvwxyz0123456789";
    $hash = "";
    for($i = 1; $i <= 25; $i++){
        $hash .= substr($string, rand(1, strlen($string)), 1);
    }
    return $hash;
}

function Register($conn, $content, $errors, $RegisterAs){
if (!empty($_POST['vnaam'])
    && !empty($_POST['anaam'])
    && !empty($_POST['gnaam'])
    && !empty($_POST['email'])
    && !empty($_POST['password1'])
    && !empty($_POST['password2'])
) {
    // insert
    if ($_POST['password1'] == $_POST['password2']) {
        // insert
        $insert_user = $conn->prepare("INSERT INTO users SET
                  Surename = :anaam,
                  Name = :vnaam,
                  Email = :email");
        $insert_user->bindParam(":anaam", $_POST['anaam']);
        $insert_user->bindParam(":vnaam", $_POST['vnaam']);
        $insert_user->bindParam(":email", $_POST['email']);
        $insert_user->execute();

        $userid = $conn->lastInsertId();

        $insert_account = $conn->prepare("INSERT INTO accounts SET
                  Username = :username,
                  Password = :password,
                  salt = :salt,
                  Users_idUsers = :userid,
                  Role_idRole = :roleid");
        $insert_account->bindParam(":username", $_POST['gnaam']);
        $password = sha1($_POST['password1']);
        $insert_account->bindParam(":password", $password);
        $insert_account->bindParam(":salt", $userid);
        $insert_account->bindParam(":userid", $userid);
        $insert_account->bindValue(":roleid", 1);
        $insert_account->execute();

        $content->newBlock("MELDING");
        $content->assign("MELDING", "Je bent geregistreed");

    } else {
        $errors->newBlock("ERRORS");
        $errors->assign("ERROR", "Wachtwoord komt niet overeen");
        $content->newBlock("USERFORM");
        if($RegisterAs == 'Admin') {
            $content->assign("ACTION", "index.php?pageid=2&action=toevoegen");
            $content->assign("BUTTON", "Add User");
        } else{
            $content->assign("ACTION", "index.php?pageid=16");
            $content->assign("BUTTON", "Register");
        }
    }

} else {
    // formulier
    $content->newBlock("USERFORM");
    if($RegisterAs == 'Admin') {
        $content->assign("ACTION", "index.php?pageid=2&action=toevoegen");
        $content->assign("BUTTON", "Add User");
    } else{
        $content->assign("ACTION", "index.php?pageid=16");
        $content->assign("BUTTON", "Register");
    }
}
}

function UrlChangeError($errors){
    $errors->newBlock("ERRORS");
    $errors->assign("ERROR", "Please don't play with the URL");
}
