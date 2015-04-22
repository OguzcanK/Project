<div class="jumbotron">
    <h1>Admin Projecten</h1>
</div>
<div class="col-sm-8 blog-main">
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">Data</li>
    </ol>
    <div class="blog-post">
        <p>
            <a href="index.php?pageid=9">Overzicht</a> -
            <a href="index.php?pageid=9&action=toevoegen">Product toevoegen</a>
        </p>
        <!-- START BLOCK : MELDING -->
        <div class="alert alert-info" role="alert">
            <p>{MELDING}</p>
        </div>
        <!-- END BLOCK : MELDING -->
        <!-- START BLOCK : PROJECTFORM -->
        <form class="form-horizontal" action="{ACTION}" method="post">
            <div class="form-group">
                <label for="inputtitle" class="col-sm-4 control-label">Title</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputtitle" placeholder="Title" name="title" value="{TITLE}">
                </div>
            </div>
            <div class="form-group">
                <label for="editor1" class="col-sm-4 control-label">Content</label>
                <div class="col-sm-8">
                    <textarea class="ckeditor" rows="3" name="content" id="editor1" placeholder="Content">{CONTENT}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <input type="hidden" name="Projectid" value="{PROJECTID}">
                    <button type="submit" class="btn btn-default">{BUTTON}</button>
                </div>
            </div>
        </form>
        <!-- END BLOCK : PROJECTFORM -->

        <!-- START BLOCK : ADMIN -->
        <!-- START BLOCK : PROJECTLIST -->
        <form class="form-inline" action="index.php?pageid=9" method="post">
            <div class="form-group">
                <input type="text" class="form-control" id="Search" placeholder="Zoek Project" name="search" value="{SEARCH}">
            </div>
            <button type="submit" class="btn btn-default">Zoek</button>
        </form>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Username</th>
                <th>Title</th>
                <th>Content</th>
                <th>Wijzigen</th>
                <th>Verwijderen</th>
            </tr>
            </thead>
            <tbody>
            <!-- START BLOCK : PROJECTROW -->
            <tr>
                <td>{USERNAME}</td>
                <td>{TITLE}</td>
                <td>{CONTENT}</td>
                <td><a href="index.php?pageid=9&action=wijzigen&Projectid={PROJECTID}">Wijzigen</a> </td>
                <td><a href="index.php?pageid=9&action=verwijderen&Projectid={PROJECTID}">Verwijderen</a></td>
            </tr>
            <!-- END BLOCK : PROJECTROW -->
            </tbody>
        </table>
        <!-- END BLOCK : PROJECTLIST -->
        <!-- END BLOCK : ADMIN -->

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