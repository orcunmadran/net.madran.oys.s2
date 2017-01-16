<?php /* Smarty version 2.6.10, created on 2007-08-08 02:52:30
         compiled from uninstall.tpl */ ?>
<?php $this->assign('title', "Un-install"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<center>
	<?php if ($this->_tpl_vars['_REQUEST']['installed'] == 2): ?>
		FlashChat is un-installed succesfully.
	<?php elseif ($this->_tpl_vars['_REQUEST']['installed'] == 3): ?>
		<font color="red">FlashChat is not installed.</font>
	<?php else: ?>
	<h4>Un-install</h4>
	<form name="uninstall" action="uninstall.php" method="post">
	<table border="0" cellspacing="8">
		<tr>
			<td colspan="3" valign="TOP">
				Remove all FlashChat tables from MySQL. This option will allow you to re-run the installer.<br>
				You may need to re-upload the "install_files" folder and the install.php file before re-install.<br>
				The following tables will be permanently removed:<br>
			</td>
		</tr>
		<tr>
			<td width="80">&nbsp;</td>
			<td>
			<font color="Red"><b>
				<?php $_from = $this->_tpl_vars['_REQUEST']['tables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['ordersel']):
?>
					<?php echo $this->_tpl_vars['ordersel']; ?>
<br>
				<?php endforeach; endif; unset($_from); ?>
			</b></font>
			</td>
		</tr>
		<tr>
			<td colspan="2">				
				<input type="checkbox" id="CB_AGREE" name="CB_AGREE" onclick="javascript:my_getbyid('continue').disabled=!my_getbyid('CB_AGREE').checked" id="agree_id">
				I understand that these actions are not reversible.
			</td>	
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" id="continue" name="continue" onclick="javascript: decision('Are you sure?!? This action is NOT reversible!', 'uninstall.php?action=1')" value="Continue" disabled>
				<input type="submit" name="cancel" value="Cancel">
			</td>
		</tr>
	</table>
	</form>
	<?php endif; ?>
</center>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>