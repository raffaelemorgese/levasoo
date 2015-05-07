<div>
  <a href="<?php echo UriDispatch::getBaseUri().'user/login';?>" title="home">
      <img src="<?php echo UriDispatch::getBaseUri().'view/box/img/homepage.png';?>" class="img_36_36" />
  </a>
  <a href="<?php echo UriDispatch::getFullUri('team/viewallteam');?>" style="padding-left:20px;">
    il mio team
  </a>
  <a href="<?php echo UriDispatch::getFullUri('user/addplanunilevel');?>" style="padding-left:20px;" class="fancybox fancybox.iframe">
    piano Unilevel
  </a>
  <div class="avatarmenubar">
    <img src="<?php echo $utente->getAvatarUrl();?>" class="avatar img_48_48" title="<?php echo $utente->getNome()." ".$utente->getCognome();?>" />
  </div>
</div>
