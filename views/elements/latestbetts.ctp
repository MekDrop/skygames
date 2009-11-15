<?php
$betts = $this->requestAction('betts/latest/' . $match_id);
?>
<?php if (count($betts) > 0): ?>

<table cellpadding="1" cellspacing="1" class="list">
<?php

foreach ($betts as $bett):

?>
	<tr>

		<td><?php echo $bett['Team']['name']; ?></td>


		<td class="altrow">$<?php echo $bett['Bett']['sum']; ?></td>

		<td><i><?php echo $bett['User']['name']; ?></i></td>

		<?php if ($bett['Bett']['won'] > 0): ?>
		<td style="text-align: right">&nbsp;+ <font color="green">$<?php echo $bett['Bett']['won'] - $bett['Bett']['sum']; ?></font>
		</td>
		<?php endif; ?>
	</tr>
	<?php endforeach; ?>

</table>
	<?php else: ?>

	<?php __("No betts"); ?>

	<?php endif; ?>