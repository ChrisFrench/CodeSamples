
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 well well-sm">
            <legend>
                <i class="glyphicon glyphicon-globe"></i>
                Login
            </legend>
            <form action="" method="post" class="form" role="form">
                <input class="form-control" name="login-username" placeholder="Courriel" type="email" /> 
                <input class="form-control" name="login-password" placeholder="mot de passes" type="password" /> 
                <br />
                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            </form>
            <?php /* if(class_exists('Hybrid_Auth')) : ?>
            <?php echo $this->renderLayout('Users/Site/Views::login/hybrid.php'); ?>  
            <?php endif; */ ?>
        </div>
    </div>
</div>