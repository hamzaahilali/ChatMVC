
<?php
if ($messages != null)
foreach ($messages as $message) {
    var_dump($message);
    if($message.id == $_SESSION['auth']){
    ?>


<div class="outgoing_msg">
    <div class="sent_msg">
        <p>Test which is a new approach to have all
            solutions</p>
        <span class="time_date"> 11:01 AM    |    June 9</span></div>
</div>
    <?php }}?>