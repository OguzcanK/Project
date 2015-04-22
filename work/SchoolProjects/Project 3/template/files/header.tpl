<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Carousel Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="template/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="template/css/carousel.css" rel="stylesheet">
</head>
<!-- NAVBAR
================================================== -->
<body>
<div class="navbar-wrapper">
    <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Project name</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li {HOMEACTIVE}><a href="index.php?nav=home">Home</a></li>
                        <li {PROJECTENACTIVE}><a href="index.php?pageid=13&nav=projecten">projecten</a></li>
                        <li {BLOGACTIVE}><a href="index.php?pageid=11&nav=blog">blog</a></li>

                        <!-- START BLOCK : ADMIN -->

                        <li class="dropdown {ADMINACTIVE}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="index.php?pageid=2&nav=admin">Admin Panel</a></li>
                                <li ><a href="index.php?pageid=3&nav=admin">Admin Blog panel</a></li>
                                <li ><a href="index.php?pageid=9&nav=admin">Admin projeceten panel</a></li>
                                <li ><a href="index.php?pageid=15&nav=admin">Admin Comment panel</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Company name</li>
                            </ul>
                        </li>

                        <!-- END BLOCK : ADMIN -->

                    </ul>

                    <!-- START BLOCK : LOGINTOP -->

                    <form class="navbar-form navbar-right" action="index.php?pageid=4" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="Username" class="form-control" name="gnaam">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" name="password">
                        </div>
                        <button type="submit" class="btn btn-success">Sign in</button>
                        <a type="button" href="index.php?pageid=16" class="btn btn-success">Register</a>
                    </form>

                    <!-- END BLOCK : LOGINTOP -->

                    <!-- START BLOCK : LOGGEDIN -->

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown {ACCOUNTACTIVE}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{USERNAME} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="index.php?pageid=6&nav=account">My profile</a></li>
                                <li ><a href="#">You got ... POINTS</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Bedrijfs naam</li>
                                <li ><a href="index.php?pageid=7&nav=account">Change user</a></li>
                                <li ><a href="index.php?pageid=5&nav=account">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <p class="navbar-text navbar-right">Welcome</p>

                    <!-- END BLOCK : LOGGEDIN -->

                </div>
            </div>
        </nav>