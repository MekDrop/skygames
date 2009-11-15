<?php
 echo $javascript->link('prototype');
 echo $javascript->link('scriptaculous');
?>




<div class="servers index">


<div class="servers view" style="text-align:left;vertical-align:middle;">
<?php echo $form->create('Server', array('action' => 'index'));?>
	<table border="0" style="border-collapse: collapse;">
		<tr>
			<td>
				<label class='horizontal'><?php __('Game'); ?></label>
			</td>
			<td>
				<?php echo $form->input('game_id', array('label' => false, 'value' => $game_id, 'onchange' => "getElementById('ServerIndexForm').submit()")); ?>
			</td>
			<td style="padding-left: 30px;">
				<label class='horizontal'><?php __('Sort by'); ?></label>
			</td>
			<td>
				<?php echo $form->select(__('sort', true), array('ms' => __('ms', true), 'players' => __('players', true)), $sort, array('onchange' => "getElementById('ServerIndexForm').submit()")); ?>
			</td>
			<td style="padding-left: 30px;">
				<label class='horizontal'><?php __('Refresh at'); ?></label>
			</td>
			<td>
				<?php echo $form->select(__('refresh', true), array(__('0', true) => '-', '15' => __('15 sec', true), '30' => __('30 sec', true), '60' => __('1 minute', true)), $refresh, array('onchange' => "getElementById('ServerIndexForm').submit()"), false); ?>
			</td>
		</tr>
	</table>		 
<?php echo $form->end();?>
</div>

<br/>

 <?php
 	if ($refresh)
 
 	echo $ajax->remoteTimer(
	 array(
	 'url' => array( 'controller' => 'servers', 'action' => 'monitor', $game_id, $sort),
	 'update' => 'monitor', 
	 'indicator' => 'loading', 'frequency' => $refresh
	 )
 	);
 ?>

<div id="loading" style="display: none;text-align:center">
    <?php echo $html->image('ajax-loader.gif'); ?>
</div> 


<?php echo $ajax->div('monitor'); ?>
<!-- For initial monitor data -->
<?php
	echo $this->renderElement('monitor', array('cache' => false));
?>
<?php echo $ajax->divEnd('monitor'); ?>

<br/>
<br/>

<table cellspacing="0" cellpadding="0">
		<tr>
			<td style="vertical-align: middle;">
				<?php echo $html->image('/img/servers/refresh.png') ?>
			</td>
			<td style="vertical-align: middle;">
				<?php echo $ajax->link(__('Refresh', true), array( 'controller' => 'servers', 'action' => 'monitor', $game_id, $sort),
	 													array('update' => 'monitor', 'indicator' => 'loading'));?>
			</td>																
		</tr>
</table>
</div>


