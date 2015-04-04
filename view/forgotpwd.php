
<div class="boxlogin">
    <br/>
    <div class="boxtitle">
      RECUPERO PASSWORD
    </div>

    <div class="formlogin">
      <form id="frmFrgtPass" name="Login" action="sendpwd" method="POST">
          <p>
              Inserire email dove ricevere la password:<br/>
              <input type="text" name="email" value="" size="40" class="login required"/>
          </p>
          <input type="submit" value="Recupera password" name="recuperapwd" class="button" onclick="return validateAll($('#frmFrgtPass'),'.login.required');" />
      </form>
    </div>
</div>
