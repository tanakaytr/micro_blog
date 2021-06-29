<?php

class FavoriteController extends Controller
{

    protected $auth_actions = [
        'index',
        'favorite'
    ];

    public function indexAction()
    {
        $user = $this->session->get('user');

        $favorites = $this->db_manager->get('favorite')->getAll5($user["user_id"]);

        if ($this->request->isPost()) {

            $delete = $this->request->getPost("delete");

            foreach ($delete as $tweet_id) {
                if (isset($favorites["tweet_id"]) && isset($favorites["user_id"])) {
                    $this->db_manager->get('favorite')->deleteByTweetIdAndUserId($tweet_id, $user["user_id"]);
                }
            }
        }

        return $this->render([
            'body' => '',
            'favorites' => $favorites,
            'user' => $user
        ]);
    }

    public function favoriteAction()
    {
        $user = $this->session->get('user');

        if ($this->request->isPost()) {
            $user_id = $this->request->getPost("user_id");
            $tweet_id = $this->request->getPost("tweet_id");
            $this->db_manager->get('follow')->insert($user_id, $tweet_id);

            return $this->redirect('/');
        }
        return $this->render([
            'user' => $user
        ]);
    }
}
