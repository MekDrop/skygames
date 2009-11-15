<div class="userdetails index">
<h2><?php __('Userdetails');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('hardw_mouse');?></th>
	<th><?php echo $paginator->sort('hardw_mousepad');?></th>
	<th><?php echo $paginator->sort('hardw_headset');?></th>
	<th><?php echo $paginator->sort('hardw_graphcard');?></th>
	<th><?php echo $paginator->sort('hardw_memory');?></th>
	<th><?php echo $paginator->sort('hardw_cpu');?></th>
	<th><?php echo $paginator->sort('hardw_monitor');?></th>
	<th><?php echo $paginator->sort('fav_drink');?></th>
	<th><?php echo $paginator->sort('fav_movie');?></th>
	<th><?php echo $paginator->sort('fav_game');?></th>
	<th><?php echo $paginator->sort('fav_music');?></th>
	<th><?php echo $paginator->sort('fav_sport');?></th>
	<th><?php echo $paginator->sort('fav_car');?></th>
	<th><?php echo $paginator->sort('pers_country');?></th>
	<th><?php echo $paginator->sort('pers_city');?></th>
	<th><?php echo $paginator->sort('pers_age');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($userdetails as $userdetail):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $userdetail['Userdetail']['id']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['hardw_mouse']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['hardw_mousepad']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['hardw_headset']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['hardw_graphcard']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['hardw_memory']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['hardw_cpu']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['hardw_monitor']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['fav_drink']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['fav_movie']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['fav_game']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['fav_music']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['fav_sport']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['fav_car']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['pers_country']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['pers_city']; ?>
		</td>
		<td>
			<?php echo $userdetail['Userdetail']['pers_age']; ?>
		</td>
		<td>
			<?php echo $html->link($userdetail['User']['name'], array('controller'=> 'users', 'action'=>'view', $userdetail['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $userdetail['Userdetail']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $userdetail['Userdetail']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $userdetail['Userdetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userdetail['Userdetail']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Userdetail', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
	</ul>
</div>
