<?php
class UserRepository extends DbRepository{
    public function insert($mail, $password, $nickname){
        $password = $this->hashPassword($password);
        $now = new Datetime();
        $sql = "
            INSERT INTO user(mail, password, nickname, created_at)
                VALUES(:mail, :password, :nickname, :created_at)
        ";
        $stmt = $this->execute($sql, [
            ':mail' => $mail,
            ':password' => $password,
            ':nickname' => $nickname,
            ':created_at' => $now->format('Y-m-d H:i:s'),
        ]);
    }
    public function hashPassword($password){
        return sha1($password . 'SecretKey');
    }
    
    public function fetchByUserMail($mail){
        $sql = "SELECT * FROM user WHERE mail = :mail";
        return $this->fetch($sql, [
            ':mail' => $mail
        ]);
    }
    public function isUniqueUserMail($mail){
        $sql = "SELECT COUNT(user_id) as count FROM user WHERE mail = :mail";
        $row = $this->fetch($sql,[
            ':mail' => $mail
        ]);
        if($row['count'] === '0'){
            return true;
        }
        return false;
    }
    public function update($user){
        $sql = "UPDATE user SET nickname = :nickname WHERE user_id = :user_id";
        $stmt = $this->execute($sql, $user);
    }
    public function fetchByUserId($user_id){
        $sql = "SELECT * FROM user WHERE user_id = :user_id";
        return $this->fetch($sql, [
            ':user_id' => $user_id
        ]);
    }
}
