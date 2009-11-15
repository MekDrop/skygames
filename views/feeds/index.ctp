<div class="feeds index">
<table class="contentpaneopen" style="width: 100%">


	<tr>
		<td style="vertical-align: top; width: 30%"><?php foreach ($items as $itemsOfTheGame): ?>
		<?php if (!$itemsOfTheGame['Game']['id']): ?> <?php if (!empty($itemsOfTheGame['Items'])): ?>
		<table cellpadding="2" cellspacing="2" class="list" width="100%">
			<tr class="altrow">
				<td style='text-align: top; height: 18px'>
				<div class="caption"><?php echo __("General"); ?></div>
				</td>
			</tr>
			<?php
			foreach ($itemsOfTheGame['Items'] as $item):
			?>
			<tr>
				<td style='text-align: top'><b><?php echo $html->link(substr(htmlspecialchars_decode($item['title'], ENT_QUOTES),0,255), $item['link'], array("target" => "_blank")); ?><?php if (strlen($item['title']) > 255) {echo "...";} ?></b>&nbsp;
				</td>
			</tr>
			<tr>
				<td style='text-align: top'><?php echo str_replace("align='right'", "align='left'", str_replace("<img", "<img style='margin: 0px 5px 5px 0px;width:81px;height:54px;'", htmlspecialchars_decode($item['description'], ENT_QUOTES))); ?>
				<br />
				<i><?php echo date("Y-m-d m:h:s",strtotime($item['pubDate'])); ?></i>&nbsp;<?php __("by"); ?>&nbsp;<?php echo $item['source']; ?>&nbsp;
				</td>
			</tr>

			<?php endforeach; ?>
		</table>
		<?php endif; ?> <?php endif; ?> <?php endforeach; ?></td>

		<td style="vertical-align: top; width: 30%"><?php $i = 0; ?> <?php foreach ($items as $itemsOfTheGame): ?>
		<?php if (($i++ % 2 != 0) && $itemsOfTheGame['Game']['id'] > 0): ?> <?php if (!empty($itemsOfTheGame['Items'])): ?>
		<table cellpadding="2" cellspacing="2" class="list" width="100%">
			<tr class="altrow">
				<td style='vertical-align: middle;'>
				<div class="caption" style="vertical-align: middle"><?php echo $html->image($itemsOfTheGame['Game']["icon"]); ?>&nbsp;<?php echo $itemsOfTheGame['Game']["name"]; ?></div>
				</td>
			</tr>
			<?php
			foreach ($itemsOfTheGame['Items'] as $item):
			?>
			<tr>
				<td style='text-align: top'><b><?php echo $html->link(substr(htmlspecialchars_decode($item['title'], ENT_QUOTES),0,255), $item['link'], array("target" => "_blank")); ?><?php if (strlen($item['title']) > 255) {echo "...";} ?></b>&nbsp;
				</td>
			</tr>
			<tr>
				<td style='text-align: top'><?php echo str_replace("align='right'", "align='left'", str_replace("<img", "<img hspace='5px' vspace='5px' style='width:81px;height:54px;'", htmlspecialchars_decode($item['description'], ENT_QUOTES))); ?>
				<br />
				<i><?php echo date("Y-m-d m:h:s",strtotime($item['pubDate'])); ?></i>&nbsp;<?php __("by"); ?>&nbsp;<?php echo $item['source']; ?>&nbsp;
				</td>
			</tr>

			<?php endforeach; ?>
			<tr>
				<td style='text-align: right'><i><?php echo $html->link(__("more", true), array("action" => "game", $itemsOfTheGame['Game']["id"])); ?>...</i>
				</td>
			</tr>
		</table>
		<?php endif; ?> <?php endif; ?> <?php endforeach; ?></td>
		<td style="vertical-align: top; width: 30%"><?php $i = 0; ?> <?php foreach ($items as $itemsOfTheGame): ?>
		<?php if (($i++ % 2 == 0) && $itemsOfTheGame['Game']['id'] > 0): ?> <?php if (!empty($itemsOfTheGame['Items'])): ?>
		<table cellpadding="2" cellspacing="2" class="list" width="100%">
			<tr class="altrow">
				<td style='vertical-align: middle'>
				<div class="caption" style="vertical-align: middle"><?php echo $html->image($itemsOfTheGame['Game']["icon"]); ?>&nbsp;<?php echo $itemsOfTheGame['Game']['name']; ?></div>
				</td>
			</tr>
			<?php
			foreach ($itemsOfTheGame['Items'] as $item):
			?>
			<tr>
				<td style='text-align: top'><b><?php echo $html->link(substr(htmlspecialchars_decode($item['title'], ENT_QUOTES),0,255), $item['link'], array("target" => "_blank")); ?><?php if (strlen($item['title']) > 255) {echo "...";} ?></b>&nbsp;
				</td>
			</tr>
			<tr>
				<td style='text-align: top'><?php echo str_replace("align='right'", "align='left'", str_replace("<img", "<img hspace='5px' vspace='5px' style='width:81px;height:54px;'", htmlspecialchars_decode($item['description'], ENT_QUOTES))); ?>
				<br />
				<i><?php echo date("Y-m-d m:h:s",strtotime($item['pubDate'])); ?></i>&nbsp;<?php __("by"); ?>&nbsp;<?php echo $item['source']; ?>&nbsp;
				</td>
			</tr>

			<?php endforeach; ?>
			<tr>
				<td style='text-align: right'><i><?php echo $html->link(__("more", true), array("action" => "game", $itemsOfTheGame['Game']["id"])); ?>...</i>
				</td>
			</tr>
		</table>
		<?php endif; ?> <?php endif; ?> <?php endforeach; ?></td>

	</tr>

</table>
</div>

