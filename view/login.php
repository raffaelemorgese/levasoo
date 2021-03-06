
<div style="text-align:center;">
  <img src="<?php echo UriDispatch::getBaseUri();?>view/box/img/levasoo.png" style="height:150px;" />
</div>
<div class="boxlogin shadow">
  <br/>
  <?php
    //Controlla utente loggato
    if(Session::isSetObj(Session::UTENTE)) 
    { $utente = Session::getObj(Session::UTENTE);
      ?>
    <div class="formlogin">
        <div style="text-align:center;">
            <img src="<?php echo $utente->getAvatarUrl();?>" class="avatar img_60_60" />
        </div>
        <div class="boxtitle">
    <?php
        print "[Utente: ".$utente->getNome()." ".$utente->getCognome()."]";
        //*** MENU UTENTE LOGGATO ***
    ?>
        </div>
        <div style="margin:20px;">
          <p>
              <a href="./loaduser" class="fancybox fancybox.iframe" >Modifica profilo</a>    
          </p>
          <p>
              <a href="<?php echo UriDispatch::getFullUri('user/adduseravatar');?>" class="fancybox fancybox.iframe" >Immagine profilo</a>    
          </p>
          <p>
              <a href="../team/viewallteam">Visualizza team</a>    
          </p>
          <p>
              <a href="./userlogout">Logout</a>    
          </p>
        </div>
    </div>
    <?php
    } else {
    ?>
    
    <div style="text-align:center">
      <img src="../view/box/img/login1.png" />
    </div>
  
    <div style="text-align:center;">
      <a href="userfblogin">
          <img src="../view/box/img/fb.png" class="img_48_48" title="Login con Facebook"/>
      </a>
    
      <a href="usergologin">
          <img src="../view/box/img/go.png" class="img_48_48" title="Login con Google"/>
      </a>
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
          <a href="<?php echo UriDispatch::getFullUri('user/newuser/0/non/applicabile/'.Utente::encode(Utente::getDefaultAvatarUrl()));?>">Nuovo utente</a> | 
          <a href="<?php echo UriDispatch::getFullUri('user/forgotpwd');?>">Recupera password</a>
      </div>
    </div>
    <?php } ?>
</div>
