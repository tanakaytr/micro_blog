<?php

class TweetRepository extends DbRepository
{

    public function getModel()
    {
        return [
            "user_id" => "",
            "body" => "",
            "tweet_id" => ""
        ];
    }

    public function getAll()
    {
        $sql = "SELECT u.user_id, u.nickname, t.body, t.created_at, t.tweet_id
                FROM user as u
                LEFT JOIN tweet as t
                ON u.user_id = t.user_id ORDER BY created_at DESC
        ";
        return $this->fetchAll($sql);
    }

    public function getAll2($user_id)
    {
        $sql = "SELECT u.user_id, u.nickname, t.body, t.created_at, t.tweet_id
                FROM user as u
                LEFT JOIN tweet as t
                ON u.user_id = t.user_id WHERE t.user_id = :user_id ORDER BY created_at DESC
        ";
        return $this->fetchAll($sql, [
            "user_id" => $user_id
        ]);
    }

    public function getAll3($tweet_id)
    {
        $sql = "SELECT u.user_id, u.nickname, t.body, t.created_at, t.tweet_id
                FROM user as u
                LEFT JOIN tweet as t
                ON u.user_id = t.user_id WHERE t.tweet_id = :tweet_id ORDER BY created_at DESC
        ";
        return $this->fetchAll($sql, [
            'tweet_id' => $tweet_id
        ]);
    }

    public function getTweet($tweet_id)
    {
        $sql = "SELECT
                user_id, body
                FROM tweet WHERE tweet_id = :tweet_id
        ";

        return $this->fetch($sql, [
            "tweet_id" => $tweet_id
        ]);
    }

    public function insert($tweet)
    {
        $sql = "INSERT INTO tweet
                (user_id, body, created_at)
                VALUES
                (:user_id, :body, now())
        ";

        $stmt = $this->execute($sql, $tweet);
    }
}