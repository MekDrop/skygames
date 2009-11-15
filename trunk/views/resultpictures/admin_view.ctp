<div class="resultpictures view">
<h2><?php  __('Resultpicture');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $resultpicture['Resultpicture']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $resultpicture['Resultpicture']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $resultpicture['Resultpicture']['desc']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $resultpicture['Resultpicture']['url']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Result'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($resultpicture['Result']['id'], array('controller'=> 'results', 'action'=>'view', $resultpicture['Result']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Resultpicture', true), array('action'=>'edit', $resultpicture['Resultpicture']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Resultpicture', true), array('action'=>'delete', $resultpicture['Resultpicture']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $resultpicture['Resultpicture']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Resultpictures', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Resultpicture', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
	</ul>
</div>
