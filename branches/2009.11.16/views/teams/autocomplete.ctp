<ul class="auto" >
        <?php foreach($teams as $team): ?>
        	<li class="auto" onmouseover="this.style.cursor='pointer'" ><?php echo $team['Team']['name']; ?></li>
        <?php endforeach; ?>
</ul> 