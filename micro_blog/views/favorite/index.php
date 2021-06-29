お気に入り

<div id="favorites">
<?php foreach($favorites as $favorite): ?>
<?php if(isset($favorite["tweet_id"]) && isset($favorite["user_id"])): ?>
<div class="favorite_content">
		<a
			href="<?php echo $base_url; ?>/tweet/user?user_id=<?php echo $this->escape($favorite['user_id']); ?>">
<?php echo $this->escape($favorite['nickname']); ?></a> <a
			href="<?php echo $base_url; ?>/favorite?user_id=<?php echo $this->escape($favorite["user_id"]); ?>">
			お気に入りに解除</a> <br />
<?php echo $this->escape($favorite['body']); ?>
</div>
	<div>
		<a
			href="<?php echo $base_url; ?>/tweet/show?tweet_id=<?php

        echo $this->escape($favorite['tweet_id']);
        ?>"><?php echo $this->escape($favorite['created_at']); ?></a>
	</div>
	<hr />
	<?php else: ?>
<?php return false; ?>
<?php endif; ?>
<?php endforeach; ?>
	

</div>