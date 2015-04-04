<div class="boxlogin boxmessage" >
  <div style="padding-top: 50px;">
    <?php
      $sysMessage = Session::getObj(Session::SYSMSG);
      echo $sysMessage;
    ?>
  </div>
  <div style="padding-top: 80px;">
      <a href="./home" class="button">home</a>
  </div>
</div>