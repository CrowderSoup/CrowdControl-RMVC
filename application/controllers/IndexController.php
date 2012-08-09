<?php

    /* Prevent Direct Access to this file */
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }

    class IndexController extends BaseController
    {
        public function index($URIdata)
        {
            if(!empty($URIdata) && is_array($URIdata))
                $this->view->data = $URIdata;

            $users = $this->repository->getAllUsers();

            foreach ($users as $user) {
                if ($user->uName == "aaron") {
                    $upEmail = $this->repository->updateUserEmail($user->pkid, "irishladd@gmail.com");
                } else {
                    $del = $this->repository->deleteUser($user->pkid);
                }
            }

            $ins = $this->repository->insertNewUser("Kenz", "ImCute", "mekenzie.burton@gmail.com");

            if ($ins) {
                $users = $this->repository->getAllUsers();
            }

            $this->view->users = $users;

            $this->view->pageTitle = 'Home';

            $this->view->show('header');
            $this->view->show('index');
            $this->view->show('footer');
        }
    }
