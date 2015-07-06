<!DOCTYPE html>
<html>
<head>
    <?php echo $this->tag->getTitle(); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $this->assets->outputCss('style'); ?>
    <?php echo $this->assets->outputJs('js'); ?>
    

    
</head>
<body>

<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Fireball</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo $this->url->get('dashboard/'); ?>">Dashboard</a></li>
                <li><a href="<?php echo $this->url->get('projects/'); ?>">Projects</a></li>
                <li><a href="<?php echo $this->url->get('account/'); ?>">Account</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $this->url->get('index/signout'); ?>">Signout</a></li>
            </ul>

        </div>
    </div>
</div>

<?php echo $this->flash->output(); ?>



    <div class="jumbotron">
        <h1>Dashboard</h1>
        <p>
            Welcome User!
        </p>
    </div>



</body>
</html>