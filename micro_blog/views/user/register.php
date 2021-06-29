<?php $this->setLayoutVar('title', '新規ユーザ登録') ?>
<h2>新規ユーザ登録</h2>
<form action="<?php echo $base_url; ?>/user/register" method="post">
<input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />
<?php if(isset($errors) && count($errors) > 0): ?>
<?php echo $this->render('errors', ['errors' => $errors]); ?>
<?php endif; ?>
<?php echo $this->render('user/registerinputs',
    [
        'mail' => $mail,
        'password' => $password,
        'password2' => $password2,
        'nickname' => $nickname,
    ]
    ); ?>
<p><input type="submit" value="登録" /></p>
</form>