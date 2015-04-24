<?php
  $utente = new Utente();
  $tm = new Team();
  $rteam = $tm->getParentRootTeam();
  $nrteam = $tm->getNoParentRootTeam();
?>
<div class="container">

  <ul>
    <li id="<?php echo BASE_PARENT_ROOT;?>" class="hasSubmenu"><a href="#"><img src="<?php echo Team::getAvatarUrl();?>" class="avatar img_36_36" /> My team</a>
      <?php $id = 0; $pname = 'applicabile'; $psrnm = 'non'; $pavatar = Utente::encode($utente->getAvatarUrl()); 
        include 'paneladdntwrkr.php'; ?>
      <ul>
      <?php
        foreach ($rteam as $t) {
          $basestring='<li id="'.$t['id'].'" class="hasSubmenu"><a href="#" class="toogle"><img src="'.$utente->getAvatarUrl().'" class="avatar img_36_36" />'.$t['cognome'].' '.$t['nome'].'</a>';
          $id = $t['id']; $pname = $t['nome']; $psrnm = $t['cognome']; $pavatar = Utente::encode($utente->getAvatarUrl()); 
          echo $basestring; include 'panelmodntwrkr.php'; include 'paneladdntwrkr.php'; include 'paneladdntwrkrsale.php'; 
          echo '<ul id="'.$t['id'].'_ul"></ul></li>';
        }   
        foreach ($nrteam as $t) {
          $basestring='<li id="'.$t['id'].'_li" class="hasSubmenu hasLeftborder"><a href="#" class="toogle"><img src="'.$utente->getAvatarUrl().'" class="avatar img_36_36" />'.$t['cognome'].' '.$t['nome'].'</a>';
          $id = $t['id']; $pname = $t['nome']; $psrnm = $t['cognome']; $pavatar = Utente::encode($utente->getAvatarUrl()); 
          $js1 = '<script type="text/javascript"> $(document).ready(function() {$("#'.$t['parent'].'_ul").append(\'';
          echo $js1.$basestring; include 'panelmodntwrkr.php'; include 'paneladdntwrkr.php'; include 'paneladdntwrkrsale.php';
          echo '</li><ul id="'.$t['id'].'_ul"></ul>\');});</script>';
        }?>    
        <li style="display:none">
      </ul>
    </li>
  </ul>
    
</div>


<?php  
//      $js = '<script type="text/javascript">';
//      $js.= '$(document).ready(function() {';
//      $js.= '$("#18_ul").append(\'<li class="hasSubmenu" style="border-left-width: 1px; border-left-style: solid; border-left-color: gray;"><a href="#"> + <img src="'.$utente->getAvatarUrl().'" class="avatar img_36_36" />Pappa e ciccia</a></li><ul id="98_ul"></ul>\'); ';
//      $js.= '$("#98_ul").append(\'<li class="hasSubmenu" style="border-left-width: 1px; border-left-style: solid; border-left-color: gray;"><a href="#"> + <img src="'.$utente->getAvatarUrl().'" class="avatar img_36_36" />Pappa e ciccia</a></li><ul id="99_ul"></ul>\'); ';
//      $js.= '$("#99_ul").append(\'<li class="hasSubmenu" style="border-left-width: 1px; border-left-style: solid; border-left-color: gray;"><a href="#"> + <img src="'.$utente->getAvatarUrl().'" class="avatar img_36_36" />Pappa e ciccia</a></li><ul id="100_ul"></ul>\'); ';
//      $js.= '});';
//      $js.= '</script>';
//      //***
//      echo $js;
      
?>