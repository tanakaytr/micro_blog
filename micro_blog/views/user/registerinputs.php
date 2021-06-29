<table>
<tr>
<th>メールアドレス(ユーザID)</th>
<td><input type="text" name="mail" value="<?php echo $this->escape($mail); ?>" /></td>
</tr>
<tr>
<th>パスワード</th>
<td><input type="password" name="password" value="<?php echo $this->escape($password); ?>" /></td>
</tr>
<tr>
<th>パスワード（再確認）</th>
<td><input type="password" name="password2" value="<?php echo $this->escape($password2); ?>" /></td>
</tr>
<tr>
<th>ニックネーム</th>
<td><input type="text" name="nickname" value="<?php echo $this->escape($nickname); ?>" /></td>
</tr>
</table>