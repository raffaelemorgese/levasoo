<?php 
    $utente = Session::getObj(Session::NETWORKER);
?>
<div class="boxlogin">
    <br/>
    <div class="boxtitle">
        AGGIORNA CONSULENTE
    </div>
    
    <div class="formlogin">
      <form id="frmUpdUser" name="Login" action="<?php echo UriDispatch::getFullUri('user/ntwrkrupdate');?>" method="POST">
          <p>
              * Nome:<br/>
              <input type="text" name="nome" value="<?php echo $utente->getNome(); ?>" size="40" class="login required"/>
          </p>
          <p>
              * Cognome:<br/>
              <input type="text" name="cognome" value="<?php echo $utente->getCognome(); ?>" size="40" class="login required"/>
          </p>
          <p>
              * Email:<br/>
              <input type="text" name="email" value="<?php echo $utente->getEmail(); ?>" size="40" class="login required"/>
          </p>
          <p>
              * Username:<br/>
              <input type="text" name="username" value="<?php echo $utente->getUsername(); ?>" size="40" class="login required"/>
          </p>
          <p>
              * Password:<br/>
              <input type="password" name="password" value="<?php echo $utente->getPassword(); ?>" size="40" class="login required"/>
          </p>
          <input type="submit" value="Salva" name="salva" class="button" onclick="return validateAll($('#frmUpdUser'),'.login.required');"/>
      </form>
    </div>
</div>
