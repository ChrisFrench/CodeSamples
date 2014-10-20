 <header class="bg-dark border" data-load="/header"></header>
    <div class="container">
  
    <div class="grid">
      <div class="row">
        <div class="span12" style="padding-top:45px;">
		<legend>Select Your Role</legend>
            <?php foreach ($roles as $role) : ?>
                <div id="role" style="text-align:center;">
                    <a href="/active/role/<?php echo $role['id'] ?>" class="button large inverse fg-white" style="width:80%; margin-bottom:25px;background:rgba(0,0,0,0.6)!important">
                        <?php echo $role['name']; ?>
                    </a>
 
                </div>


            <?php endforeach; ?>
                <div id="role" style="text-align:center;">
        		<a href="/logout" class="button large inverse fg-white" style="width:80%; margin-bottom:25px;background:rgba(229,10,10,0.6)!important">Logout</a>
                </div>
             

        </div>
      </div>
    </div>
   
        <div class="page-footer">
            <div class="page-footer-content">

                <!--<div data-load="header.html"></div>-->
            </div>
        </div>
    </div>