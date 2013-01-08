<?php if ($type == 'errors_count') { 
/* for the Menu counter */    
?>
<span class='awaiting-mod count-<?php echo $message; ?>'>
    <span class='sq_count pending-count'><?php echo $message; ?></span>
</span>
<?php }else{ ?>
<div class="<?php echo $type; ?> sq_message">
  
  <p>
    <strong><?php echo $message; ?></strong>
  </p>

</div>
<?php } ?>