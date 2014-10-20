 <div class="pushdown" style="padding:10px;margin-top:10px;">
		<legend></legend>
        <?php  if(!empty($message)) { ?>
        <?php echo $message; ?>
        <?php }?>
        <br>
        <?php
         $session_event = \Dsc\System::instance()->get( 'session' )->get('session_event');

         if(empty($session_event)) { ?>
            <form method="post" name="checkin" action="/montreal/set/checkin/session">
               <label>nom de session</label> <input name="session_event" id="">
                <button type="submit">Save</button>
            </form>
        <?php } else {
            echo 'Tap bandes pour les v&#233;rifier dans <i style="color:#666;">' .$session_event .'</i>';
        

        }; ?>     


</div>
<div id="footer"></div>