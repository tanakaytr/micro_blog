<?php

class FollowRepository extends DbRepository
{

    public function insert($follow)
    {
        $sql = "INSERT INTO follow (user_id, following_user_id)
                VALUES (:user_id, :following_user_id)";

        $stmt = $this->execute($sql, $follow);
    }

    public function getAll4($user_id)
    {
        $sql = "SELECT u.user_id, u.nickname, f.following_user_id FROM user as u
         LEFT JOIN follow as f on u.user_id = f.following_user_id and f.user_id = :user_id
         LEFT JOIN (SELECT u.user_id, count(f.following_user_id) count FROM user u left join follow f on u.user_id = f.following_user_id where u.user_id != :user_id GROUP BY u.user_id) as t1
         ON u.user_id = t1.user_id
         LEFT JOIN (SELECT u.user_id, count(f.user_id) count FROM user u left join follow f on u.user_id = f.user_id WHERE u.user_id != :user_id GROUP BY u.user_id) as t2
         ON u.user_id = t2.user_id 
         WHERE u.user_id != :user_id
       ";
        return $this->fetchAll($sql, [
            'user_id' => $user_id
        ]);
    }
    public function getFollow($follow_id){
        $sql = "SELECT follow_id, user_id, following_user_id FROM follow 
                WHERE follow_id = :follow_id";
        return $this->fetch($sql, [
            "follow_id" => $follow_id
        ]);
    }

    public function isFollowing($user_id, $following_user_id)
    {
        $sql = "
         select count(follow_id) as count from follow 
         where user_id = :user_id and following_user_id = :following_user_id
         ";
        $row = $this->fetch($sql, [
            ':following_user_id' => $following_user_id,
            ':user_id' => $user_id
        ]);

        if ($row['count'] !== "0") {
            return true;
        }
        return false;
    }
}