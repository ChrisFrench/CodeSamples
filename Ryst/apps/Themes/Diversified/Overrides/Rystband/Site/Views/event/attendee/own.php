<fieldset>
    <legend>My Account</legend>
    <a href="<?php echo $PARAMS[0]; ?>/logout" class="btn">Logout</a>
  </fieldset>
<?php echo \Dsc\System::instance()->get( 'session' )->get( 'home'); ?>