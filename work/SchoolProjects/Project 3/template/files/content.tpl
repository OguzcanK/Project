<div id="carousel-example-generic" class="carousel slide"  data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="..." alt="...">
            <div class="carousel-caption">
                ...
            </div>
        </div>
        <div class="item">
            <img src="..." alt="...">
            <div class="carousel-caption">
                ...
            </div>
        </div>
        ...
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="col-sm-8 blog-main">

    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">Data</li>
    </ol>
    <div class="blog-post">
        <h2 class="blog-post-title">Welcome to my portofolio</h2>

        <p>Here you can see everyting I have been up to. You can chat about some projects or blog posts if you register. </p>
        <hr>
        <p>If you would like to get in contact with me, please E-mail at <a href="mailto:#">oguz_66tr@hotmail.com</a>. Please klik on the button in what you are intrested:
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Who am I <abbr title="attribute"><span class="glyphicon glyphicon-question-sign"></span> </abbr>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <h3>Hey, my name is Oguzcan Karakoc</h3> and I am a student at Zadkine and I'm learning for application developer. Currently I am 17 years old and my gender is Man. I live in holland, but my homeland is turkey. At the moment I am looking for work.
                        The town I live in is Rotterdam, it has one of the biggest docks of the world. The city itself is very modern and it keeps up with all the technology. I am really healthy and quite smart. For more
                        info about me please download my CV <a href="#">here</a> or come and look at my blogs or projects.
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            My work experience <abbr title="attribute"><span class="glyphicon glyphicon-question-sign"></span> </abbr>
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        Well, it looks like you're interested in my work experience.
                        At the moment I haven't had any real experience, all the experience I got from programming is from school. The programming languages I know are:
                        <blockquote>
                            HTML/Css<br />
                            PHP<br />
                            Javascript<br />
                        </blockquote>
                        I have worked at Albert Heijn and an internship a Duimdrop (BSW)
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            What does this site have <abbr title="attribute"><span class="glyphicon glyphicon-question-sign"></span> </abbr>
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        This site is made for a schoolproject. The website had to include :
                        <blockquote>
                            <ol>
                                <li>A registration form where you will be a registered user.</li>
                                <li>A login where you can log on as a user or admin.</li>
                                <li>A blog page where you can find a list of blogs</li>
                                <li>A blog detail page, where you see first blog post, accompanied by the comments that have been given. Also here as logged in user must be able to give a comment.</li>
                                <li>A product page, where you can find a list of products.</li>
                                <li>A product detail page, where you see one product, accompanied by the comments that have been given. Also here as logged in user must be able to give a comment.</li>
                                <li>An forgot password section, where you can leave an address to reset your login details.</li>
                            </ol>
                            Management section:
                            <ol>
                                <li>A user admin, where your users can add, edit, delete and search.
                                    Also, you should be able to use an admin role.</li>
                                <li>A blog admin, with blogs you can add, edit, delete and search.</li>
                                <li>A project admin, which projects you can add, edit, delete and search.</li>
                                <li>A comment admin where your comments can edit, delete and search.</li>
                            </ol>
                            Requirements for the website:
                            <ol>
                                <li>Everything is communicated to the database must PDO</li>
                                <li>the layout of the functionality will need to be separated in the file by means of the template parser.</li>
                            </ol>
                        </blockquote>
                    </div>
                </div>
        </div>
        </div>
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

