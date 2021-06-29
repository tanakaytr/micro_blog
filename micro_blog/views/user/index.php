<?php $this->setLayoutVar('title', 'ユーザ情報') ?>
<h2>ユーザ情報更新</h2>
<?php if(!empty($message)): ?>
<div id="message"><?php echo $message; ?></div>
<?php endif; ?>
<?php if(isset($errors) && count($errors) > 0): ?>
<?php echo $this->render('errors', ['errors' => $errors]); ?>
<?php endif; ?>
<form action="<?php echo $base_url; ?>/user" method="post">
<table>
<tr>
<th>ユーザ名</th>
<td><?php echo $this->escape($user['mail']); ?></td>
</tr>
<tr>
<th>ニックネーム</th>
<td><input type="text" name="nickname" value="<?php echo $this->escape($user['nickname']); ?>" /></td>
</tr>
<tr>
<td colspan="2"><input type="submit" value="更新" /></td>
</tr>
</table>
</form>