

<div class="list" style="margin: auto;">
<?php echo $form->create('User',array('action'=>'login'));?>
	<table cellspacing="0" cellpadding="0" style="width: 181px; height: 112px; vertical-align: top; text-align: center;margin:auto;" border="0">
			<tr>
				<td style="text-align: left" colspan="2">
					<font class="">&nbsp;&nbsp;&nbsp;<?php __('Username');?>:</font></td>
			</tr>
			<tr>
				<td style="height: 2px;" colspan="2">
				</td>
			</tr>
			<tr>
				<td style="text-align: left;vertical-align:top;" colspan="2">
					&nbsp;&nbsp;
					<?php echo $form->input('login', array("label"=>false,"class"=>"ivestis", "div"=>false)); ?>
					
				</td>
			</tr>
			<tr>
				<td style="height: 2px;" colspan="2">
				</td>
			</tr>
			<tr>
				<td style="text-align: left;vertical-align:top;" colspan="2">
					<font class="">&nbsp;&nbsp;&nbsp;<?php __('Password');?>:</font><br>
				</td>
			</tr>
			<tr>
				<td style="height: 2px;" colspan="2">
				</td>
			</tr>
			<tr>
				<td style="text-align: left;vertical-align:top;" colspan="2">
					&nbsp;&nbsp;
					<?php echo $form->input('passwd', array("label"=>false,"class"=>"ivestis", "div"=>false)); ?>
					
				</td>
			</tr>
			<tr>
				<td style="height: 5px;" colspan="2">
				</td>
			</tr>
			<tr>
				<td style="text-align: right;vertical-align:top;width:56%;">
					
					<?php echo $form->submit(strtoupper(__('Submit', true)), array("class"=>"knopke", "div"=>false)); ?>
				</td>
				<td rowspan="3" style="text-align: center;vertical-align:middle;">
					<span style="font-size:9px"><?php echo $html->link(__("Forgot your password?",true),array("controller" => "users", "action" => "reset")) ?></span>
				</td>
			</tr>
			<tr>
				<td style="height: 5px;">
				</td>
			</tr>
			<tr>
				<td style="text-align: right;vertical-align:top;">
					
					<?php echo $form->button(strtoupper(__('Register', true)), array("class"=>"knopke", "div"=>false, "onclick"=>"window.location='" . $html->url(array('controller'=>'users', 'action'=>'register')) . "'")); ?>					
					
			</tr>
		</table>
<?php echo $form->end();?>

</div>
