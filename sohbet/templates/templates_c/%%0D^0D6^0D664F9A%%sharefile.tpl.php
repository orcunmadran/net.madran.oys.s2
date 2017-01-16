<?php /* Smarty version 2.6.10, created on 2007-08-08 03:52:20
         compiled from sharefile.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>FlashChat v<?php echo $this->_tpl_vars['data']['version']; ?>
 - <?php echo $this->_tpl_vars['data']['fileshare']; ?>
</title>
		<meta http-equiv=Content-Type content="text/html;  charset=UTF-8">
		<?php echo '
		<script language=JavaScript type=text/javascript>
		<!--// open print window
		function myOnSubmit()
		{
			var fname = document.setup.file.value;
			if( fname == \'\')
			{
				'; ?>

				var msg = '<?php echo $this->_tpl_vars['data']['pls_select_file']; ?>
';
				<?php echo '
				window.alert(msg);
				return false;
			}
			
			'; ?>

			var allowExt = "<?php echo $this->_tpl_vars['data']['allowFileExt']; ?>
";
			<?php echo '
			var ind = fname.lastIndexOf(\'.\');
			if(allowExt != \'\' && ind > 0)
			{
				var ext = fname.substring(ind+1,fname.length).toUpperCase();
				allowExt = \',\' + allowExt + \',\';
				if( allowExt.indexOf(\',\'+ext+\',\') < 0 )
				{
					'; ?>

					var msg = '<?php echo $this->_tpl_vars['data']['ext_not_allowed']; ?>
';
					<?php echo '
					msg = msg.replace(\'FILE_EXT\', ext);
					window.alert(msg);
					return false;
				}
			}
			return true;
		}
		//-->
	</script>
	'; ?>

	</head>

<?php echo '
<style type=text/css>
<!--
body,td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: normal;
	color: ';  echo $this->_tpl_vars['data']['bodyText']; ?>
;<?php echo '
}
.small {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
}
.title {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
}
input {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: normal;
}
select {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: normal;
}
A {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #0000FF;
}
-->
</style>
'; ?>

	<body bgcolor="<?php echo $this->_tpl_vars['data']['publicLogBackground']; ?>
" onLoad="window.focus()" leftmargin=5 topmargin=0 marginwidth=10 marginheight=5>

	<form name="setup" method="post" enctype="multipart/form-data" onSubmit="return myOnSubmit()">


		<table width="100%" height="100%">
		<tr><td valign="middle" align="center">
			<table border="0" cellpadding="4">
				
				<?php if ($this->_tpl_vars['data']['not_errmsg']): ?> <tr><td align=center><?php echo $this->_tpl_vars['data']['errmsg']; ?>
</td></tr><?php endif; ?>

				<tr><td ><?php echo $this->_tpl_vars['data']['win_choose']; ?>
</td></tr>
				<tr><td><input type="hidden" name="MAX_FILE_SIZE1" value="<?php echo $this->_tpl_vars['data']['maxSize']; ?>
">
						<input name="file" type="file" size="45"><br>
						<div class="normal">
							<?php echo $this->_tpl_vars['data']['file_info_size']; ?>

							<?php echo $this->_tpl_vars['data']['file_info_ext']; ?>

						</div>
					</td>
				</tr>
				<tr>
					<td nowrap>
						<?php echo $this->_tpl_vars['data']['win_share_only']; ?>

						<?php echo $this->_tpl_vars['data']['touser']; ?>

					</td>
				</tr>
				<tr>
					<td align="center" nowrap><input name="submit" type="submit" class="input"  value="<?php echo $this->_tpl_vars['data']['win_upl_btn']; ?>
"></td>
				</tr>
			</table>
		</td>
		</tr>
		</table>


		<?php $_from = $this->_tpl_vars['data']['req']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['ordersel']):
?>
			<input type="hidden" name="<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['ordersel']; ?>
">
		<?php endforeach; endif; unset($_from); ?>

	</form>
</body>
</html>