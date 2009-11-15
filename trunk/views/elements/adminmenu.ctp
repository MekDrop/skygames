<ul>
<?php
$menus = $this->requestAction('adminmenus/index');
foreach($menus as $menu):
	?>
	<li>
	<?php
	echo $html->link($menu['Adminmenu']['title'],  $menu['Adminmenu']['link']);    
	//$html->link(__('New Group', true), array('action'=>'add'));
	?>
	</li>
	<?php
endforeach; 
?>
</ul>