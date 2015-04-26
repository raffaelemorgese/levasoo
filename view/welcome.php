<?php
  $sysMsg = Session::getObj(Session::SYSMSG);
?>

<div class="boxmessage" >
  <div class="boxlogin shadow" >
    <div style="padding-top: 50px;">
      <img src="<?php echo $sysMsg->getIconUrl();?>" class="img_48_48" />  
      <?php echo $sysMsg->getMessage();?>
    </div>
    <div style="padding:80px;">
      <a href="./home" title="Entra">
        <img src="<?php echo $sysMsg->getParameter('useravatar');?>" class="avatar img_60_60" />
      </a>
    </div>
  </div>
</div>