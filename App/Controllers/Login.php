<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Login controller
 *
 * PHP version 7.0
 */
class Login extends \Core\Controller
{

    /**
     *
     *
     * @return void
     */
    public function newAction()
    {
        View::renderTemplate('Search/new.html');
    }

    /**
     *
     *
     * @return void
     */
    public function createAction()
    {
        $user = User::findBySchool($_POST['school']);

        View::renderTemplate('School/index.html', ['users' => $user]);
        // var_dump($user);
    }
}
