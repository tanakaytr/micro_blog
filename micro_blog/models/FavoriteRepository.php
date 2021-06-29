<?php

class FavoriteRepository extends DbRepository
{

    public function getAll5($user_id)
    {
        $sql = "SELECT v.user_id, u.nickname, t.body, t.created_at, v.tweet_id FROM user as u
                LEFT JOIN tweet as t ON u.user_id = t.user_id 
                LEFT JOIN favorite as v ON u.user_id = v.user_id and t.tweet_id = v.tweet_id
                WHERE u.user_id = :user_id ORDER BY created_at DESC
        ";
        return $this->fetchAll($sql, [
            ':user_id' => $user_id,
        ]);
    }

    public function insert($user_id, $tweet_id)
    {
        $sql = "INSERT INTO favorite (user_id, tweet_id)
         VALUES (:user_id, :tweet_id)
         ";
        $stmt = $this->execute($sql, [
            ':user_id' => $user_id,
            ':tweet_id' => $tweet_id
        ]);
    }
    public function deleteByTweetIdAndUserId($tweet_id, $user_id){
        $sql = "DELETE FROM favorite
         WHERE tweet_id = :tweet_id AND user_id = :user_id";
        $data = [
            "tweet_id" => $tweet_id,
            "user_id" => $user_id
        ];
        $this->execute($sql, $data);
    }
}
