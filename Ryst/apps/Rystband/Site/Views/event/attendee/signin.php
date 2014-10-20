<?php echo \Dsc\System::instance()->renderMessages(); ?>
    <?php if(@$SESSION['user']) {
      $user = $SESSION['user'];
    } ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=0" />
 <script src='/dash/js/jquery.js' type='text/javascript'></script>
  <link rel="stylesheet" href="/own/profile/css/profile.css">

<style type="text/css">

 #background {
     margin-left:-20px;
     margin-top:-20px;
     padding-right:30px;
     padding-bottom:30px;
     height:100%;
     width:100%;
     background:url(<?php echo(@$user->{'social.facebook.profile.photoURL'}); ?>) no-repeat;
     background-size:cover;
     
    -moz-filter: blur(14px);
    -o-filter: blur(14px);
    -ms-filter: blur(14px);
     filter: blur(14px);
     opacity: 0.6;
     z-index:-10000;
 }
 #photo {

	opacity:0;
	-webkit-transition: all .5s ease-in-out; 
	display:block;
	position:absolute;
	margin: 0;
	padding:0;

	-webkit-box-shadow:0 2px 5px rgba(0,0,0,0.5) , 0 6px 0 rgba(255,255,255,0.4) inset;
	-moz-box-shadow:0 2px 5px rgba(0,0,0,0.5) , 0 6px 0 rgba(255,255,255,0.4) inset;
	box-shadow:0 2px 5px rgba(0,0,0,0.5) , 0 6px 0 rgba(255,255,255,0.4) inset;	
	-webkit-box-shadow: inset 0px 0px 63px 3px rgba(101, 63, 90, 0.8);
	border:6px solid rgba(255,255,255,0.4);	
	-webkit-border-radius:100%;
	background-size:100%!important;
	background-position:center;
	background:rgba(255,255,255,.2);
       background:url('<?php echo(str_replace("150","250",@$user->{'social.facebook.profile.photoURL'}));?>') no-repeat;
       z-index:10;
 }
</style>


</head>
<body style="">
 <div class="pushdown" style="padding:10px;margin-top:10px;">
		<form method="post" action="<?php echo $PARAMS[0]; ?>/login">
			<fieldset>
                <legend>Customer Info </legend><br>
                                        <label>First Name</label>
                                        <div class="input-control text" data-role="input-control">
                                            <input name="first_name" type="text" placeholder="First name" >
                                        </div>
                                        <label>Last Name</label>
                                        <div class="input-control text" data-role="input-control">
                                            <input name="last_name" type="text" placeholder="Last name"   >
                                        </div>
                        
                        
                                        <label>Phone</label>
                                        <div class="input-control text" data-role="input-control">
                                            <input name="phone" type="text" placeholder="Phone"  >
                                        </div>	
		<br/><br/>
		                                
                                        <input type="hidden" name="submitType" value="save_confirm";>      
                                        <input type="submit" value="Login" class="btn">
                                    </fieldset>
                                </form>
	    </div>
	  </div>
	</div>
   

        <div class="page-footer">
            <div class="page-footer-content">
                <!--<div data-load="header.html"></div>-->
            </div>
        </div>
    </div>
 <div id="glass"><p class="logo">RYST</p></div>  