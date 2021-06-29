<?php

class FollowController extends Controller
{

    protected $auth_actions = [
        'index',
        'follow'
    ];

    public function indexAction()
    {
        $user = $this->session->get('user');

        $follows = $this->db_manager->get('follow')->getAll4($user["user_id"]);

        return $this->render([

            'follows' => $follows
        ]);
    }

    public function followAction()
    {
        $user = $this->session->get('user');
        
        if ($this->request->isPost()) {
            $follow = $this->request->getPost('follow');

            if (!isset($follow["user_id"]) && !isset($follow["following_user_id"])) {

                $this->db_manager->get('follow')->insert($follow);
                $this->session->set("message", "フォローしました。");
                return $this->redirect('/');
            }
        }
        return $this->render([
            'user' => $user,
            'follow' => $follow
        ]);
    }
}