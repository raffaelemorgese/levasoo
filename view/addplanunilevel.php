<?php
  $ul = new Unilevel();
?>
<div class="boxcommonform">
  <br/>
  <div class="boxtitle">
    CREAZIONE PIANO UNILEVEL
  </div>

  <div class="formlogin">
    <div class="boxtitle boxsponsor">
        <img src="<?php echo UriDispatch::getFullUri('view/box/img/puzzle.png');?>" class="avatar img_100_100" />  
    </div>
    <form id="frmAddPlanUnilevel" name="frmAddPlanUnilevel" action="<?php echo UriDispatch::getFullUri("user/planunilevelsave");?>" method="POST">
      <input type="hidden" name="idntwrkr" value="{SNIPPET::idntwrkr}" />
      <table border="0">
        <tr>
          <td width="8%"><p>Liv.</p></td>
          <td width="69%"><p>Descrizione</p></td>
          <td width="17%"><p>Provvigione</p></td>
          <td width="6%"></td>
        </tr>
        <tr>
          <td><p><?php echo $ul->getLevels()+1;?></p><input type="hidden" name="level" value="<?php echo $ul->getLevels()+1;?>"/></td>
          <td><p><input type="text" name="desc" value="" class="login required" /></p></td>
          <td><p><input type="text" name="comm" value="" class="login required" style="width:80px;"/> %</p></td>
          <td><p style="padding-left:60px;"><button type="submit" name="salva" title="Aggiungi" class="buttonimage" onclick="return validateAll($('#frmAddPlanUnilevel'),'.login.required');"><img src="<?php echo UriDispatch::getFullUri('view/box/img/addicon.png'); ?>" class="img_36_36"/></button></p></td>
        </tr>
        <?php
          $plan = $ul->getPlan();
          foreach ($plan as $lvl) {?>
          <tr>
            <td><p><?php echo $lvl[Unilevel::MAP_LEVEL];?></p></td>  
            <td><p><?php echo $lvl[Unilevel::MAP_DESCRIPTION];?></p></td>  
            <td><p style="text-align:right;"><?php echo number_format($lvl[Unilevel::MAP_COMMISSION],2);?> %</p></td>  
            <td><p style="padding-left:60px;"><button type="submit" name="salva" title="Elimina" class="buttonimage" onclick="return validateAll($('#frmAddPlanUnilevel'),'.login.required');"><img src="<?php echo UriDispatch::getFullUri('view/box/img/delicon.png'); ?>" class="img_36_36"/></button></p></td>
          </tr>
        <?php }?>
      </table>
    </form>
  </div>
</div>
