<div class="tweet">
	<div class="tweet_content">
		<a
			href="<?php echo $base_url; ?>/tweet/user?user_id=<?php echo $this->escape($tweet['user_id']); ?>">
<?php echo $this->escape($tweet['nickname']); ?></a>

<?php if(isset($favorite["tweet_id"]) && isset($favorite["user_id"])): ?>
<?php echo ""; ?>
<?php else: ?>
<a
			href="<?php echo $base_url; ?>/favorite/index?user_id=<?php echo $this->escape($tweet["user_id"]); ?>">
			お気に入りに追加</a>
<?php endif; ?>
<br />
<?php echo $this->escape($tweet['body']); ?>
</div>
	<div>
		<a
			href="<?php echo $base_url; ?>/tweet/show?tweet_id=<?php

echo $this->escape($tweet['tweet_id']);
?>"><?php echo $this->escape($tweet['created_at']); ?></a>
	</div>
	<hr />
</div>