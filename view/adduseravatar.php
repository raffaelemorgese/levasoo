<?php
  $user = Session::getObj(Session::UTENTE);
?>
<div class="boxcommonform">
  <br/>
  <div class="boxtitle">
    IMMAGINE DEL PROFILO
  </div>
  <div >
    <div class="boxaddavatar" >
      <img src="<?php echo $user->getAvatarUrl();?>" class="avatar img_200_200" />
    </div>

    <div class="formlogin">
      <form action="<?php echo UriDispatch::getFullUri("user/useravatarsave");?>" method="post" name="frmAddUserAvatar" enctype="multipart/form-data">
        <input type="file" name="browse" title="Sfoglia" class="login required"/>
        <br /> 
        <input type="submit" name="submit" value="Salva" class="button" onclick="return validateAll($('#frmAddUserAvatar'),'.login.required');"/> 
      </form>         
    </div>    
    
  </div>
</div>