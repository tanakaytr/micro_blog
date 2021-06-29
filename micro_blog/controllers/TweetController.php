<?php

class TweetController extends Controller
{

    protected $auth_actions = [
        'index',
        'tweet',
        'user',
        'show'
    ];

    public function indexAction()
    {
        $tweets = $this->db_manager->get('Tweet')->getAll();

        return $this->render([
            'body' => '',
            'tweets' => $tweets
        ]);
    }

    public function tweetAction()
    {
        $message = "";
        $user = $this->session->get('user');
        $tweet = [];
        $errors = [];

        if ($this->request->isPost()) {
            $tweet["user_id"] = $user["user_id"];
            $tweet["body"] = $this->request->getPost("body");

            if (! strlen($tweet["body"])) {
                $errors[] = "メッセージをを入力";
            } else {
                $this->db_manager->get("tweet")->insert($tweet);

                $this->session->set('tweet', $tweet);
                $message = "メッセージをしました";
            }
        }

        return $this->render([

            'user' => $user,
            'tweet' => $tweet,
            'errors' => $errors,
            'message' => $message
        ]);
    }

    public function userAction()
    {
        $user = $this->session->get('user');
        $user_id = $this->request->getGet("user_id");
        $tweets = $this->db_manager->get('Tweet')->getAll2($user_id);
        return $this->render([
            'body' => '',
            'tweets' => $tweets,
            'user' => $user
        ]);
    }

    public function showAction()
    {
        $tweet_id = $this->request->getGet("tweet_id");

        $tweets = $this->db_manager->get('Tweet')->getAll3($tweet_id);

        return $this->render([
            'body' => '',
            'tweets' => $tweets
        ]);
    }
}