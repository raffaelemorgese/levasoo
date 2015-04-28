<div class="menubar">
  <?php
    include (Session::isSetObj(Session::UTENTE))?'menu/menusigned.php':'menu/menunotsigned.php';
  ?>
</div>
