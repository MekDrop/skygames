<div class="adminmenus view">
<h2><?php  __('Adminmenu');?></h2>
<dl>
<?php $i = 0; $class = ' class="altrow"';?>
	<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
	<dd <?php if ($i++ % 2 == 0) echo $class;?>><?php echo $adminmenu['Adminmenu']['id']; ?>
	&nbsp;</dd>
	<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
	<dd <?php if ($i++ % 2 == 0) echo $class;?>><?php echo $adminmenu['Adminmenu']['title']; ?>
	&nbsp;</dd>
	<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Link'); ?></dt>
	<dd <?php if ($i++ % 2 == 0) echo $class;?>><?php echo $adminmenu['Adminmenu']['link']; ?>
	&nbsp;</dd>
</dl>
</div>
<div class="actions">
<ul>
	<li><?php echo $html->link(__('Edit Adminmenu', true), array('action'=>'edit', $adminmenu['Adminmenu']['id'])); ?>
	</li>
	<li><?php echo $html->link(__('Delete Adminmenu', true), array('action'=>'delete', $adminmenu['Adminmenu']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $adminmenu['Adminmenu']['id'])); ?>
	</li>
	<li><?php echo $html->link(__('List Adminmenus', true), array('action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Adminmenu', true), array('action'=>'add')); ?>
	</li>
</ul>
</div>
