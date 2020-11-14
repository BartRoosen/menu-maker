<?php


namespace Services;


class SessionService
{
    public function setValue(array $sessionValues)
    {
        $this->start();

        foreach ($sessionValues as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    public function getValue($key)
    {
        $this->start();

        if (isset($_SESSION[$key])) {

            return $_SESSION[$key];
        }

        return false;
    }

    public function getUsersRole()
    {
        $this->start();

        if (isset($_SESSION['login'], $_SESSION['role']) && true === $_SESSION['login']) {
            return $_SESSION['role'];
        }

        return false;
    }

    public function authorizationCheck($level)
    {
        $this->start();

        if (isset($_SESSION['login'], $_SESSION['role']) && true === $_SESSION['login']) {
            if ($level <= (int)$_SESSION['role']) {

                return true;
            }
        }

        session_destroy();

        header('location: ./login');

        return false;
    }

    public function getUserId()
    {
        $this->start();

        return $this->getValue('userId');
    }

    private function start()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function logout()
    {
        $this->start();
        session_destroy();
    }

//    public function setAnchor()
//    {
//        $test = 1;
//        $this->start();
//
//        $this->setValue([$_POST['anchorKey'] => $_POST['productAnchor']]);
//    }

    public function getAnchor($anchorKey)
    {
        $anchor = null;
        $this->start();

        if (isset($_SESSION[$anchorKey])) {
            $anchor = $_SESSION[$anchorKey];
            unset($_SESSION[$anchorKey]);
        }

        return $anchor;
    }

    public function getLanguage()
    {
        $this->start();
        $lang = $this->getValue('lang');
        if ($lang) {

            return $lang;
        }

        return 'nl';
    }
}