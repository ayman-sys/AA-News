<?php
if (isset($_SESSION['reply'])) {
$alert_type = $_SESSION['reply'][0][0];
$alert_msg = $_SESSION['reply'][0][1];
?>
<div class="alert alert-<?php echo $alert_type; ?>  alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <?php echo $alert_msg; ?> </div>
<?php
unset($_SESSION['reply']);
}

?>
