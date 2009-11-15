<ul class="auto" >
        <?php foreach($users as $user): ?>
        	<li class="auto"  onmouseover="this.style.cursor='pointer'" ><?php echo $user['User']['name']; ?></li>
        <?php endforeach; ?>
</ul> 