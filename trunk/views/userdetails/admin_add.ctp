<div class="userdetails form">
<?php echo $form->create('Userdetail');?>
	<fieldset>
 		<legend><?php __('Add Userdetail');?></legend>
	<?php
		echo $form->input('hardw_mouse');
		echo $form->input('hardw_mousepad');
		echo $form->input('hardw_headset');
		echo $form->input('hardw_graphcard');
		echo $form->input('hardw_memory');
		echo $form->input('hardw_cpu');
		echo $form->input('hardw_monitor');
		echo $form->input('fav_drink');
		echo $form->input('fav_movie');
		echo $form->input('fav_game');
		echo $form->input('fav_music');
		echo $form->input('fav_sport');
		echo $form->input('fav_car');
		echo $form->input('pers_country');
		echo $form->input('pers_city');
		echo $form->input('pers_age');
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Userdetails', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
	</ul>
</div>
