<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Signup controller
 *
 * PHP version 7.0
 */
class Signup extends \Core\Controller
{

    /**
     *
     *
     * @return void
     */
    public function newAction()
    {
        View::renderTemplate('Signup/new.html');
    }
    /**
     *
     *
     * @return void
     */
    public function createAction()
    {
        $user = new User($_POST);

        $user->save();

        View::renderTemplate('Signup/success.html');

    }
}
