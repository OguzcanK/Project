
<div class="jumbotron">
    <!-- START BLOCK : HEADERPROFILE -->
    <h1>{USERNAME}'s profile</h1>
    <!-- END BLOCK : HEADERPROFILE -->
</div>

<div class="col-sm-8 blog-main">

    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">Data</li>
    </ol>
    <div class="blog-post">

        <p>
            <a href="index.php?pageid=6">Overzicht</a> -
        </p>

        <!-- START BLOCK : MELDING -->

        <div class="alert alert-info" role="alert">
            <p>{MELDING}</p>
        </div>
        <!-- END BLOCK : MELDING -->


        <!-- START BLOCK : PROFILEFORM -->
        <form class="form-horizontal" action="{ACTION}" method="post">
            <div class="form-group">
                <label for="inputvnaam" class="col-sm-4 control-label">Voornaam</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputvnaam" placeholder="Voornaam" name="vnaam" value="{VOORNAAM}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputanaam" class="col-sm-4 control-label">Achternaam</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputanaam" placeholder="Achternaam" name="anaam" value="{ACHTERNAAM}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputgnaam" class="col-sm-4 control-label">Gebruikersnaam</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputgnaam" placeholder="Gebruikersnaam" name="gnaam" value="{USERNAME}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-4 control-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="{EMAIL}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <input type="hidden" name="accountid" value="{ACCOUNTID}">
                    <input type="hidden" name="userid" value="{USERID}">
                    <button type="submit" class="btn btn-default">{BUTTON}</button>
                </div>
            </div>
        </form>
        <!-- END BLOCK : PROFILEFORM -->

        <!-- START BLOCK : PROFILELIST -->

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Voornaam</th>
                <td>{VOORNAAM}</td>
            </tr>
            <tr>
                <th>Achternaam</th>
                <td>{ACHTERNAAM}</td>
            </tr>
            <tr>
                <th>Gebruikersnaam</th>
                <td>{USERNAME}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{EMAIL}</td>
            </tr>
            <tr>
                <th>Wijzigen</th>
                <td><a href="index.php?pageid=6&action=wijzigen&accountid={ACCOUNTID}">Wijzigen</a> </td>
            </tr>
            </thead>
        </table>

        <!-- END BLOCK : PROFILELIST -->

    </div><!-- /.blog-post -->
</div>

<div class="col-sm-3 col-sm-offset-1 blog-sidebar">

    <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
    </div>
    <div class="sidebar-module">
        <h4>Archives</h4>
        <ol class="list-unstyled">
            <li><a href="#">March 2014</a></li>
            <li><a href="#">February 2014</a></li>
            <li><a href="#">January 2014</a></li>
            <li><a href="#">December 2013</a></li>
            <li><a href="#">November 2013</a></li>
            <li><a href="#">October 2013</a></li>
            <li><a href="#">September 2013</a></li>
            <li><a href="#">August 2013</a></li>
            <li><a href="#">July 2013</a></li>
            <li><a href="#">June 2013</a></li>
            <li><a href="#">May 2013</a></li>
            <li><a href="#">April 2013</a></li>
        </ol>
    </div>
    <div class="sidebar-module">
        <h4>Elsewhere</h4>
        <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
        </ol>
    </div>
</div>