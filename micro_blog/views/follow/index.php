<?php $this->setLayoutVar('title', 'ユーザ一覧画面') ?>

<table>
	<tr>
		<th>ユーザ名</th>
		<th>フォロー数</th>
		<th>フォロワー数</th>
		<th>フォロー</th>
	</tr>
<?php foreach($follows as $follow): ?>
<tr>
		<td><a
			href="<?php echo $base_url; ?>/tweet/user?user_id=<?php echo $this->escape($follow['user_id']); ?>">
<?php echo $this->escape($follow['nickname']); ?></a></td>

		<td>
		<?php
    if ($follow["user_id"] === NULL) {
        echo "0";
    } else {
        echo $follow["user_id"];
    }
    ?>
		</td>

		<td>
		<?php
    if ($follow["following_user_id"] === NULL) {
        echo "0";
    } else {
        echo $follow["following_user_id"];
    }
    ?>
		</td>
		<td>
<?php if(isset($follow["user_id"]) && isset($follow["following_user_id"])): ?>
			<p>フォローしました</p>
			<?php else: ?>
			<form
				action="<?php echo $base_url; ?>/tweet/index"
				method='post'>

				<input type="submit" value="フォローしたい" />
			</form>
<?php endif; ?>

		</td>
	</tr>

<?php endforeach; ?>
</table>