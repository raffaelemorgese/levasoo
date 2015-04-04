
<div class="boxlogin">
  <br/>
  <?php
    //Controlla utente loggato
    if(Session::isSetObj(Session::UTENTE)) 
    { $utente = Session::getObj(Session::UTENTE);
      ?>
    <div class="formlogin">
        <div style="text-align:center;">
            <img src="<?php echo $utente->getAvatarImage();?>" class="avatar" />
        </div>
        <div class="boxtitle">
    <?php
        print "[Utente: ".$utente->getNome()." ".$utente->getCognome()."]";
        //*** MENU UTENTE LOGGATO ***
    ?>
        </div>
        <p>
            <a href="./loaduser">Modifica profilo</a>    
        </p>
        <p>
            <a href="./userlogout">Logout</a>    
        </p>
    </div>
    <?php
    } else {
    ?>
    
    <div style="text-align:center">
      <img src="../view/box/img/login1.png" />
    </div>
    
    <div class="formlogin">
      <form id="frmLogin" name="Login" action="userlogin" method="POST" >
        <p>
          Username:<br/>
          <input type="text" name="username" value="" size="40" class="login required"/>
        </p>
        <p>
          Password:<br/>
          <input type="password" name="password" value="" size="40" class="login required"/>
        </p>
        <input type="submit" value="Login" name="login" class="button" onclick="return validateAll($('#frmLogin'),'.login.required');"/>
      </form>

      <div>
          <br/>
          <br/>
          <a href="./newuser">Nuovo utente</a> | <a href="./forgotpwd">Recupero password</a>
      </div>
    </div>
    <?php } ?>
</div>
