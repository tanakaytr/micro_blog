<?php

class UserController extends Controller
{

    protected $auth_actions = [
        'index',
        'logout'
    ];

    public function registerAction()
    {
        if ($this->session->isAuthenticated()) {
            return $this->redirect('/');
        }
        $mail = "";
        $password = "";
        $password2 = "";
        $nickname = "";
        $errors = [];

        if ($this->request->isPost()) {
            $token = $this->request->getPost('_token');
            if (! $this->checkCsrfToken('user/register', $token)) {
                return $this->redirect('/user/register');
            }
            $mail = $this->request->getPost('mail');
            $password = $this->request->getPost('password');
            $password2 = $this->request->getPost('password2');
            $nickname = $this->request->getPost('nickname');

            if (! strlen($mail)) {
                $errors[] = 'ユーザーIDを入力!';
            } else if (! $this->db_manager->get('User')->isUniqueUserMail($mail)) {
                $errors[] = 'ユーザIDは既に使用!';
            }
            if (! strlen($password)) {
                $errors[] = 'パスワード絶対。';
            }
            if (! strlen($password2)) {
                $errors[] = '第二のパスワード必要。絶対。';
            } elseif ($_POST['password'] !== $_POST['password2']) {
                $errors[] = "合ってない、やり直し。";
            }
            if (! strlen($nickname)) {
                $errors[] = 'ニックネームは必要不可欠';
            }
            if (count($errors) === 0) {
                $this->db_manager->get('User')->insert($mail, $password, $nickname);
                $this->session->setAuthenticated(true);

                $user = $this->db_manager->get('User')->fetchByUserMail($mail);
                $this->session->set('user', $user);

                return $this->redirect('/');
            }
        }
        return $this->render([
            'mail' => $mail,
            'password' => $password,
            'password2' => $password2,
            'nickname' => $nickname,
            'errors' => $errors,
            '_token' => $this->generateCsrfToken('user/register')
        ], 'register');
    }

    public function indexAction()
    {
        $message = "";
        $user = $this->session->get('user');
        $errors = [];
        if ($this->request->isPost()) {
            $data["user_id"] = $user["user_id"];
            $data["nickname"] = $this->request->getPost("nickname");

            if (! strlen($data["nickname"])) {
                $errors[] = "ニックネームを入力sinasai";
            } else {
                $this->db_manager->get("User")->update($data);
                
                $user = $this->db_manager->get('User')->fetchByUserId($data["user_id"]);

                $this->session->set('user', $user);
                $message = "更新しました";
            }
        }
        return $this->render([
            'user' => $user,
            'message' => $message,
            'errors' => $errors
        ]);
    }

    public function loginAction()
    {
        if ($this->session->isAuthenticated()) {
            return $this->redirect('/');
        }
        $mail = "";
        $password = "";
        $errors = [];

        if ($this->request->isPost()) {
            $token = $this->request->getPost('_token');
            if (! $this->checkCsrfToken('user/login', $token)) {
                return $this->redirect('/user/login');
            }
            $mail = $this->request->getPost('mail');
            $password = $this->request->getPost('password');
            if (! strlen($mail)) {
                $errors[] = "ユーザIDを入力";
            }
            if (! strlen($password)) {
                $errors[] = 'パスワードを入力！';
            }
            if (count($errors) === 0) {
                $user_repository = $this->db_manager->get('User');
                $user = $user_repository->fetchByUserMail($mail);

                if (! $user || ($user['password'] !== $user_repository->hashPassword($password))) {
                    $errors[] = 'ユーザIDかパスワードがおかしい';
                } else {
                    $this->session->setAuthenticated(true);
                    $this->session->set('user', $user);
                    return $this->redirect('/');
                }
            }
        }
        return $this->render([
            'mail' => $mail,
            'password' => $password,
            'errors' => $errors,
            '_token' => $this->generateCsrfToken('user/login')
        ]);
    }

    public function logoutAction()
    {
        $this->session->clear();
        $this->session->setAuthenticated(false);
        return $this->redirect('/user/login');
    }
}
