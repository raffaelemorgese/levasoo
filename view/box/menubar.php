<div class="menubar">
  <?php
    $utente = Session::isSetObj(Session::UTENTE)?Session::getObj(Session::UTENTE):NULL;
    include (Session::isSetObj(Session::UTENTE))?'menu/menusigned.php':'menu/menunotsigned.php';
  ?>
</div>
