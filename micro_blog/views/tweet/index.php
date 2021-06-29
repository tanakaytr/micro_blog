<?php $this->setLayoutvar('title', 'ホーム') ?>
<h2>ホーム</h2>
<?php echo "今、何をしているの？";?>
<br />
<?php if(!empty($message)): ?>
<div id="message"><?php echo $message; ?></div>
<?php endif; ?>
<?php if(isset($errors) && count($errors) > 0): ?>
<?php echo $this->render('errors', ['errors' => $errors]); ?>
<?php endif; ?>
<form action="<?php echo $base_url; ?>/tweet" method="post">
<textarea name="body" rows="10" cols="120"></textarea>
<p><input type="submit" value="つぶやきたい" /></p>
</form>

<div id="tweets">
<?php foreach($tweets as $tweet): ?>
<?php if(isset($tweet["tweet_id"])): ?>
<?php echo $this->render('tweet/tweet', ['tweet' => $tweet]); ?>
<?php else: ?>
<?php return false; ?>
<?php endif; ?>
<?php endforeach; ?>
</div>