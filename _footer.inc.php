<?php $array_empresa = GenericSql::getEmpresa($database); ?>
<!-- footer -->
<center>
<div align="center" class="footer">
	<a href="<?php echo HTTP . SERVER_NAME . DIR; ?>/privacy"><?=LBL_PRIVACY;?></a> | <a href="<?php echo HTTP . SERVER_NAME . DIR; ?>/terms"><?=LBL_TERMS_CONDITIONS;?></a> | <a href="<?php echo HTTP . SERVER_NAME . DIR; ?>/contact"><?=LBL_CONTACT_US;?></a><br />
	COPYRIGHT &copy; <?php echo date('Y') . ' - ' . strtoupper($array_empresa['0']['nome_fantasia']); ?>. ALL RIGHTS RESERVED<br><br>
	<div style="height:5px; overflow:hidden;"></div>

	<div style="width:100%;">
		<div style="width:32%;float:left">&nbsp;</div>
		<div style="width:32%;float:left">
			<img src="https://placehold.it/120x120" height="60" > <!-- http://placehold.it/170x60 -->
			<img src="<?php echo HTTP . SERVER_NAME . DIR; ?>/images/logo/<?php echo $array_empresa['0']['logotipo'];?>" height="60">
		</div>
		<div style="width:32%;float:left">
			<img src="<?php echo HTTP . SERVER_NAME . DIR; ?>/images/icons/grey/lock.png" height="32"><br /><small><?php echo LBL_SAFE_ENVIRONMENT; ?></small>
		</div>
	</div>

	<div style="height:15px; overflow:hidden;"></div>
</div>
</center>
<!-- footer -->
