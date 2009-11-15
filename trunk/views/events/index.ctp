
<?php
$paginator->options(
array(
                    'url'=>array ('org_id' => (!empty($this->data['Event']['org_id']) ? $this->data['Event']['org_id'] : ''), 'game_id' => (!empty($this->data['Event']['game_id']) ? $this->data['Event']['game_id'] : ''))
));
?>

<div class="events index">

<div class="events index"><?php echo $form->create('Event', array('action' => 'index'));?>

<table>
	<tr>
		<td><?php echo $form->label('Event.org_id', __('Organization', true)); ?>
		<?php echo $form->select('org_id', $orgs, (!empty($this->data['Event']['org_id']) ? $this->data['Event']['org_id'] : ''), array('class' => 'ivestis'), __('All',true));	?>
		</td>

		<td><?php echo $form->label('Event.game_id', __('Game', true));?> <?php echo $form->select('game_id', $games, (!empty($this->data['Event']['game_id']) ? $this->data['Event']['game_id'] : ''), array(), __('All',true)); ?>
		</td>

		<td style="width: 20px">&nbsp;</td>

		<td style="vertical-align: bottom"><?php echo $form->submit(strtoupper(__('Filter', true)));?>
		</td>
	</tr>
</table>

		<?php echo $form->end();?></div>
<br />
<br />
<table cellpadding="5" cellspacing="5" class="list" style="width: 650px">

<?php
$i = 0;
foreach ($events as $event):
$class = null;
if ($i++ % 2 != 0) {
	$class = ' class="altrow"';
}
?>
	<tr class="altrow">


		<td style="text-align: center; width: 20px"><?php echo $html->image($event['Game']['icon']); ?>
		</td>
		<td><?php echo $html->link($event['Event']['name'], '/event/' . $event['Event']['id'] . ':' . slug($event['Event']['name'])); ?>
		</td>
		<td style="text-align: center; width: 30px"><?php
		if ($event['Event']['teamsize'] == '1')
		{
			__("1on1");
		}
		elseif ($event['Event']['teamsize'] == '2')
		{
			__("2on2");
		}
		elseif ($event['Event']['teamsize'] == '5')
		{
			__("5on5");
		}
		else
		{
			__("5on5");
		}
		?></td>
		<td style="text-align: center; width: 30px"><?php
		echo $event['Event']['teamcount'];
		?></td>

		<td rowspan="2" style="text-align: center; width: 75px"><?php if ($event['Event']['status'] == 'signup'):?>
		<?php if ($event['Eventtype']['restrict'] == '0'):?>
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="vertical-align: middle;"><?php echo $html->image('/img/event/sign.png') ?>
				</td>
				<td style="vertical-align: middle;"><?php echo $html->link(__("Sign-up", true), array('controller'=> 'events', 'action'=>'sign', $event['Event']['id'])); ?>
				</td>
			</tr>
		</table>
		<?php else: ?> <?php __("VIP"); ?> <?php endif; ?> <?php endif; ?> <?php if ($event['Event']['status'] == 'active'):?>
		<?php __("Active"); ?> <?php endif; ?> <?php if ($event['Event']['status'] == 'finished'):?>
		<?php __("Finished"); ?> <?php endif; ?> <?php if ($event['Event']['status'] == 'closed'):?>
		<?php __("Stoped"); ?> <?php endif; ?></td>

	</tr>
	<tr>
		<td colspan="4">
		<table cellpadding="1" cellspacing="1" class="list eventslst">
			<tr>
				<td style="width: 25%"><b><?php __('Created'); ?>:</b> <?php echo substr($event['Event']['created'],0,10); ?>
				</td>
				<td style="width: 2.5%">&nbsp;</td>
				<td style="width: 25%"><b><?php __('Start'); ?>:</b>  <?php echo (empty($event['Event']['startdate']) ? "-" : substr($event['Event']['startdate'],5,11)); ?>
				</td>
				<td style="width: 2.5%">&nbsp;</td>
				<td style="width: 20%"><b><?php __('End'); ?>:</b>  <?php echo (empty($event['Event']['enddate']) ? "-" : substr($event['Event']['enddate'],5,5)); ?>
				</td>
				<td style="width: 2%">&nbsp;</td>
				<td style="width: 23%; white-space: nowrap;"><b><?php __('Administrator'); ?>:</b> <span style="white-space: nowrap;"><?php echo $event['User']['name']; ?></a>
				</td>
			</tr>
		</table>
		</td>

	</tr>

	<?php endforeach; ?>
	<tr>
		<td style="text-align: center" colspan="32"><br />
		<div class="paging index"><?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
		| <?php echo $paginator->numbers();?> <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
		</div>
		</td>
	</tr>
</table>
<br />

</div>
<br />
<br />

<div class="related">
<div class="caption"><?php __('Admin statistics');?></div>
<br />

	<?php echo $this->renderElement('statistics_org',array ('org_id' => (!empty($this->data['Event']['org_id']) ? $this->data['Event']['org_id'] : ''), 'game_id' => (!empty($this->data['Event']['game_id']) ? $this->data['Event']['game_id'] : '')));?>

</div>
<br />
<br />
