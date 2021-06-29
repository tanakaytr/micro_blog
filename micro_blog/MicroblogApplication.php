<?php

class MicroblogApplication extends Application
{

    protected $login_action = [
        'user',
        'login'
    ];

    public function getRootDir()
    {
        return dirname(__FILE__);
    }

    protected function registerRoutes()
    {
        return [
            '/' => [
                'controller' => 'tweet',
                'action' => 'index'
            ],
            '/tweet' => [
                'controller' => 'tweet',
                'action' => 'tweet'
            ],

            '/tweet/:action' => [
                'controller' => 'tweet'
            ],

            '/user' => [
                'controller' => 'user',
                'action' => 'index'
            ],
            '/user/:action' => [
                'controller' => 'user'
            ],

            
            '/follow' => [
                'controller' => 'follow',
                'action' => 'index'
            ],
            '/follow/:action' => [
                'controller' => 'follow',
            ],
            '/favorite' => [
                'controller' => 'favorite',
                'action' => 'index'
            ],
            '/favorite/:action' => [
                'controller' => 'favorite'
            ]
        ];
    }

    protected function configure()
    {
        $this->db_manager->connect('master', [
            'dsn' => 'mysql:dbname=micro_blog;host=localhost;charset=utf8',
            'user' => 'root',
            'password' => ''
        ]);
    }
}