<div class="resultdemos view">
<h2><?php  __('Resultdemo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $resultdemo['Resultdemo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $resultdemo['Resultdemo']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $resultdemo['Resultdemo']['desc']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $resultdemo['Resultdemo']['url']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Result'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($resultdemo['Result']['id'], array('controller'=> 'results', 'action'=>'view', $resultdemo['Result']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Resultdemo', true), array('action'=>'edit', $resultdemo['Resultdemo']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Resultdemo', true), array('action'=>'delete', $resultdemo['Resultdemo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $resultdemo['Resultdemo']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Resultdemos', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Resultdemo', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
	</ul>
</div>
