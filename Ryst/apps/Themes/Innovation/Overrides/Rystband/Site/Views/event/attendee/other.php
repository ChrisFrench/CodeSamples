
<img src="<?php echo $user->profilePicture();?>">
<?php echo $user->first_name.' '.$user->last_name; ?>
<?php  \Rystband\Models\Connections::makeConnection($user->id, $this->auth->getIdentity()->id); ?>

<?php if(\Rystband\Models\Connections::checkConnection($user->id, $this->auth->getIdentity()->id)) : ?>
Connected
<?php else : ?>
<a href="<?php echo \Rystband\Models\Connections::makeConnectionLink($user->id, $this->auth->getIdentity()->id);?>">Not Connected</a>
<?php endif; ?>
