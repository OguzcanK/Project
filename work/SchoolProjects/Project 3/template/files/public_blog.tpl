<div class="jumbotron">
    <h1>Blogs</h1>
</div>

<div class="col-sm-12 blog-main">

    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">Data</li>
    </ol>
    <div class="blog-post">

        <!-- START BLOCK : MELDING -->
        <div class="alert alert-info" role="alert">
            <p>{MELDING}</p>
        </div>
        <!-- END BLOCK : MELDING -->

        <!-- START BLOCK : BEGIN -->
        <div class="row">
            <!-- END BLOCK : BEGIN -->

            <!-- START BLOCK : BLOG -->
            <div class="">
                <p class="blog-post-meta">{USERNAME}</p>
                <h2>{TITLE}</h2>
                <p>{CONTENT}</p>
                <p><a class="btn btn-default" href="index.php?pageid=11&blogid={BLOGID}" role="button">View details &raquo;</a></p>
                <hr>
            </div><!-- /.col-lg-4 -->
            <!-- END BLOCK : BLOG -->

            <!-- START BLOCK : END -->
        </div><!-- /.row -->
        <!-- END BLOCK : END -->



        <!-- START BLOCK : DETAILS -->
        <!-- START BLOCK : MELDING_DETAIL -->
        <div class="alert alert-info" role="alert">
            <p>{MELDING}</p>
        </div>
        <!-- END BLOCK : MELDING_DETAIL -->



        <div class="col-sm-12 blog-main">

            <div class="blog-post">
                <h2 class="blog-post-title">{TITLE}</h2>
                <p class="blog-post-meta">January 1, 2014 by <a href="#">{USERNAME}</a></p>

                <p>{CONTENT}</p>
                <!-- START BLOCK : ADMIN_2 -->
                <p><a class="btn btn-primary" href="index.php?pageid=3&action=wijzigen&blogid={BLOGID}">Update</a>
                <a class="btn btn-primary"href="index.php?pageid=3&action=verwijderen&blogid={BLOGID}">Delete</a></p>
                <!-- END BLOCK : ADMIN_2 -->
                <hr>
            </div><!-- /.blog-post -->
        </div>


        <!-- START BLOCK : COMMENTFORM -->
        <form class="form-horizontal" action="{ACTION}" method="post">
            <div class="form-group">
                <label for="editor1" class="col-sm-2 control-label">Comment</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="text" id="editor1" placeholder="Content">{TEXT}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <input type="hidden" name="blogid" value="{BLOGID}">
                    <input type="hidden" name="commentid" value="{COMMENTID}">
                    <button type="submit" class="btn btn-default">{BUTTON}</button>
                </div>
            </div>
        </form>
        <!-- END BLOCK : COMMENTFORM -->


        <!-- START BLOCK : COMMENTROW -->

        <small>Posted By : {USERNAME}</small>
        <p>{TEXT}</p>

        <!-- START BLOCK : ADMIN -->
        <p><a class="btn btn-primary" href="index.php?pageid=15&action=wijzigen&commentid={COMMENTID}">Update</a>
        <a class="btn btn-primary" href="index.php?pageid=15&action=verwijderen&commentid={COMMENTID}">Delete</a></p>
        <!-- END BLOCK : ADMIN -->

        <hr>

        <!-- END BLOCK : COMMENTROW -->

        <!-- END BLOCK : DETAILS -->



    </div><!-- /.blog-post -->
</div>

