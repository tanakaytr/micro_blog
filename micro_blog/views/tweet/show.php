<?php $this->setLayoutvar('title', '個別つぶやき画面') ?>

<div id="tweets">
<?php foreach($tweets as $tweet): ?>
<?php echo $this->render('tweet/tweet', ['tweet' => $tweet]); ?>
<?php endforeach; ?>
</div>