<?php 
//you have access to 4 objects
//$tag
//$event
//$experience
//$attendee
?>
Hi <?php echo $attendee->first_name ?>,<br>
<br>
We just wanted to thank you again for attending the session:<br>
<br>
<?php echo $eventsession['session_name']; ?><br>
<br>
That took place at the <strong>iTech2014 IT Infrastructure and Cloud Conference in Toronto</strong>.<br>
<br>
If you would like more information about this session, or this topic, please do not hesitate to contact:<br>
<br>
<?php if(@$eventsession['contact']) : ?>
Contact: <?php echo $eventsession['contact']; ?><br>
<br>
<?php endif; ?>
<?php if(@$eventsession['contact_email']) : ?>
Email: <?php echo $eventsession['contact_email']; ?><br>
<br>
<?php endif; ?>
<?php if(@$eventsession['company']) : ?>
Company: <?php echo $eventsession['company']; ?><br>
<br>
<?php endif; ?>
<?php if(@$eventsession['website']) : ?>
Website: <?php echo $eventsession['website']; ?><br>
<br>
<?php endif; ?>


Thank you,<br>
iTech Customer Service Team<br>
<a href="http://www.itechconference.ca">www.itechconference.ca</a>