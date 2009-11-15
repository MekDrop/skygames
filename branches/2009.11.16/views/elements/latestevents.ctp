
<div>
<h3><?php __('Events');?></h3>

</div>

<?php
$events = $this->requestAction('events/latest');
?>

<div>
<table cellpadding="1" cellspacing="0">
<?php
$i = 0;
foreach ($events as $event):
?>
	<tr>
		<td><?php echo $html->image($event['Game']['icon']); ?></td>
		<td><?php echo $html->link($event['Event']['name'], '/event/' . $event['Event']['id'] . ':' . slug($event['Event']['name'])); ?>
		</td>
		<td><?php if ($event['Event']['status'] == 'signup'):?> <?php echo $html->link(__("Sign-up", true), array('controller'=> 'events', 'action'=>'sign', $event['Event']['id'])); ?>
		<?php endif; ?> <?php if ($event['Event']['status'] == 'active'):?> <?php echo $html->link(__("Active", true), array('controller'=> 'events', 'action'=>'view', $event['Event']['id'])); ?>
		<?php endif; ?> <?php if ($event['Event']['status'] == 'finished'):?>
		<?php echo $html->link(__("Finished", true), array('controller'=> 'events', 'action'=>'view', $event['Event']['id'])); ?>
		<?php endif; ?> <?php if ($event['Event']['status'] == 'closed'):?> <?php echo $html->link(__("Stoped", true), array('controller'=> 'events', 'action'=>'view', $event['Event']['id'])); ?>
		<?php endif; ?></td>

	</tr>
	<?php endforeach; ?>
	<!-- 
				<?php if($othAuth->group("level") >= 200): ?>
				<tr>
				<td colspan="3" style="text-align:center">
				<?php echo $html->link(__("Add event", true), array('controller'=> 'events', 'action'=>'add')); ?>
				</td>
				</tr>
				<?php endif; ?>
			 -->
</table>
</div>

