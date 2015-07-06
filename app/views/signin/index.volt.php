<!DOCTYPE html>
<html>
<head>
    <?php echo $this->tag->getTitle(); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $this->assets->outputCss('style'); ?>
    <?php echo $this->assets->outputJs('js'); ?>
    
    <?php echo $this->assets->outputCss('additional'); ?>

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
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $this->url->get('signin'); ?>">Signin</a></li>
                <li><a href="<?php echo $this->url->get('signin/register'); ?>">Register</a></li>
            </ul>

        </div>
    </div>
</div>

<?php echo $this->flash->output(); ?>


<form class="form-signin" method="post" action="<?php echo $this->url->get('signin/doSignin'); ?>">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" >
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign in">
        <input type="hidden" name="<?php echo $this->security->getTokenKey(); ?>" value="<?php echo $this->security->getToken(); ?>"/>
      </form>



</body>
</html>