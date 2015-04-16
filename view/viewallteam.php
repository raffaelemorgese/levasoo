<?php
  $utente = new Utente();
?>
<div class="container">

  <ul>
    <li><a href="#"><img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> My team</a> 
      <?php $id = 100; $pname = 'raffaele'; $psrnm = 'morgese'; $pavatar = Utente::encode($utente->getAvatarUrl()); 
        include 'panelmanageuser.php'; ?>  
      <ul>
        <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.1 </a>
          <ul>
            <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.1.1 </a></li>
            <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.1.2 </a></li>
            <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.1.3 </a></li>
            <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.1.4 </a></li>
          </ul>
        </li>
        <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.2 </a>
          <ul>
            <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.2.1 </a></li>
            <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.2.2 </a></li>
            <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.2.3 </a></li>
            <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.2.4 </a></li>
          </ul>
        </li>
        <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.3 </a>
          <ul>
            <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.3.1 </a></li>
            <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.3.2 </a></li>
            <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.3.3 </a></li>
            <li><a href="#"> <img src="<?php print $utente->getAvatarUrl();?>" class="avatar img_36_36" /> Level 1.3.4 </a></li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>
    
</div>
