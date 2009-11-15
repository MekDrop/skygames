<div class="results view">
<h2><?php  __('Result');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $result['Result']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Team1 Score'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $result['Result']['team1_score']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Team2 Score'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $result['Result']['team2_score']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Matchpart'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($result['Matchpart']['title'], array('controller'=> 'matchparts', 'action'=>'view', $result['Matchpart']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Match'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($result['Match']['id'], array('controller'=> 'matches', 'action'=>'view', $result['Match']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Map'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($result['Map']['title'], array('controller'=> 'maps', 'action'=>'view', $result['Map']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Result', true), array('action'=>'edit', $result['Result']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Result', true), array('action'=>'delete', $result['Result']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $result['Result']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Results', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Matchparts', true), array('controller'=> 'matchparts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Matchpart', true), array('controller'=> 'matchparts', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Matches', true), array('controller'=> 'matches', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Match', true), array('controller'=> 'matches', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Maps', true), array('controller'=> 'maps', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Map', true), array('controller'=> 'maps', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Resultdemos', true), array('controller'=> 'resultdemos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Resultdemo', true), array('controller'=> 'resultdemos', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Resultpictures', true), array('controller'=> 'resultpictures', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Resultpicture', true), array('controller'=> 'resultpictures', 'action'=>'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php  __('Related Resultdemos');?></h3>
	<?php if (!empty($result['Resultdemo'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $result['Resultdemo']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $result['Resultdemo']['title'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $result['Resultdemo']['desc'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $result['Resultdemo']['url'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Result Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $result['Resultdemo']['result_id'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $html->link(__('Edit Resultdemo', true), array('controller'=> 'resultdemos', 'action'=>'edit', $result['Resultdemo']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php  __('Related Resultpictures');?></h3>
	<?php if (!empty($result['Resultpicture'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $result['Resultpicture']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $result['Resultpicture']['title'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $result['Resultpicture']['desc'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $result['Resultpicture']['url'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Result Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $result['Resultpicture']['result_id'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $html->link(__('Edit Resultpicture', true), array('controller'=> 'resultpictures', 'action'=>'edit', $result['Resultpicture']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php __('Related Resultdemos');?></h3>
	<?php if (!empty($result['Resultdemo'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Desc'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Result Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($result['Resultdemo'] as $resultdemo):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $resultdemo['id'];?></td>
			<td><?php echo $resultdemo['title'];?></td>
			<td><?php echo $resultdemo['desc'];?></td>
			<td><?php echo $resultdemo['url'];?></td>
			<td><?php echo $resultdemo['result_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'resultdemos', 'action'=>'view', $resultdemo['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'resultdemos', 'action'=>'edit', $resultdemo['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'resultdemos', 'action'=>'delete', $resultdemo['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $resultdemo['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Resultdemo', true), array('controller'=> 'resultdemos', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Resultpictures');?></h3>
	<?php if (!empty($result['Resultpicture'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Desc'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Result Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($result['Resultpicture'] as $resultpicture):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $resultpicture['id'];?></td>
			<td><?php echo $resultpicture['title'];?></td>
			<td><?php echo $resultpicture['desc'];?></td>
			<td><?php echo $resultpicture['url'];?></td>
			<td><?php echo $resultpicture['result_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'resultpictures', 'action'=>'view', $resultpicture['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'resultpictures', 'action'=>'edit', $resultpicture['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'resultpictures', 'action'=>'delete', $resultpicture['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $resultpicture['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Resultpicture', true), array('controller'=> 'resultpictures', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
