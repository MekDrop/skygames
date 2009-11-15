<?php
/* SVN FILE: $Id: default.ctp 6311 2008-01-02 06:33:52Z phpnut $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.console.libs.templates.skel.views.layouts
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version			$Revision: 6311 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-02 00:33:52 -0600 (Wed, 02 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		<?php __('Welcome to skygames admin page'); ?>
		<?php echo $title_for_layout;?>
	</title>
	<?php
		echo $html->charset();
		echo $html->meta('icon');

		echo $html->css('cake.generic');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container" style= "vertical-align: top;">
		<table width="100%" style= "vertical-align: top;">
			<tr>
				<div id="header" style="text-align:right;">
					 <?php __('Loged in as');?> <i><?php echo $user_name;?></i>, <?php __('last visit');?>: <i><?php echo $user_lastvisit;?></i>
				</div>
			</tr>
			<tr>
				<td  width="15%">
					<div id="content" style= "text-align: left;">
						<?php echo $this->renderElement('adminmenu');?> 
					</div>
				</td>
				<td width="85%" style= "vertical-align: top;">
					
					<div id="content" style= "text-align: left;">
						<?php
							if ($session->check('Message.flash')):
									$session->flash();
							endif;
						?>
			
						<?php echo $content_for_layout;?>
			
					</div>
				</td>
			</tr>
		</table>
		
	</div>
	<?php echo $cakeDebug?>
	
</body>
</html>