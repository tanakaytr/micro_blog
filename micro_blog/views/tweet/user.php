<?php $this->setLayoutvar('title', '個別ユーザつぶやき画面') ?>


<div id="tweets">
つぶやき
<?php foreach($tweets as $tweet): ?>
<?php echo $this->render('tweet/tweet', ['tweet' => $tweet]); ?>
<?php endforeach; ?>
</div>