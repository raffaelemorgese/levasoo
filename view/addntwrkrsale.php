<!-- DATEPICKER -->
<script type="text/javascript" src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo UriDispatch::getBaseUri();?>view/box/lib/datepicker/ui.datepicker-it.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<!-- DATEPICKER -->
<!-- DATEPICKER -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#datepickerId').datepicker({ dateFormat: 'dd/mm/yy' });
  });
</script>
<!-- DATEPICKER -->
<div class="boxlogin">
  <br/>
  <div class="boxtitle">
    DETTAGLIO NUOVA VENDITA
  </div>

  <div class="formlogin">
    <div class="boxtitle boxsponsor">
      Consulente: <img src="{SNIPPET::avatar}" class="avatar img_36_36" /> {SNIPPET::fullname}  
    </div>
    <form id="frmAddNtwrkrSale" name="frmAddNtwrkrSale" action="<?php echo UriDispatch::getFullUri("user/ntwrkrsalesave");?>" method="POST">
      <input type="hidden" name="idntwrkr" value="{SNIPPET::idntwrkr}" />
      <p>
        * Data:<br/>
        <input id="datepickerId" type="text" name="datepicker" value="<?php echo date("d/m/Y");?>" class="login required"/>
      </p>
      <p>
        * Importo:<br/>
        <input type="text" name="importo" value="" class="login required"/>
      </p>
      <p>
        <input type="checkbox" name="iva" value="iva" checked="checked" class="img_24_24"/> incluso IVA
      </p>
      <input type="submit" value="Salva" name="salva" class="button" onclick="return validateAll($('#frmAddNtwrkrSale'),'.login.required');" />
    </form>
  </div>
</div>
