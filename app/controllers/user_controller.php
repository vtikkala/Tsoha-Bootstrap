<?php

  class UserController extends BaseController {

    public static function index($kayttajatunnus) {
      $users = User::find($kayttajatunnus); // miten haetaan käyttäjä?

      View::make('user/index.html', array('user' => $users)); // tehdään näkymä, josta käyttäjä näkee sopimukset
    }

    public static function login() {
      View::make('user/login.html');
    }

    public static function handle_login() {
      $params = $_POST;

      $user = User::authenticate($params['username'], $params['password']);

      if(!$user) {
        View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!',
          'username' => $params['username']));
      } else {
        $_SESSION['user'] = $user->id;

        Redirect::to('/' . $user->kayttajatunnus, array('message' => 'Tervetuloa takaisin ' . $user->kayttajatunnus . "!"));
      }
    }

  }
