<?php

  class UserController extends BaseController {

    public static function index($kayttajatunnus) {
      $users = User::find($kayttajatunnus);
      $asiakastunnus = $users->asiakastunnus;
      $customers = User::find_customer($asiakastunnus); // hakee asiakkaan tiedot
      $policies = Policy::all($asiakastunnus);

      View::make('user/index.html', array('user' => $users, 'customer' => $customers, 'policies' => $policies)); // tehdään näkymä, josta käyttäjä näkee sopimukset
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

    public static function passwd($kayttajatunnus) {
      $user = User::find($kayttajatunnus);
      View::make('user/passwd.html', array('user' => $user));
    }

    public static function change_passwd($kayttajatunnus) {
      $params = $_POST;
      $user_old = User::find($kayttajatunnus);
      $user_new = User::authenticate($kayttajatunnus, $params['old_password']);

      if(!$user_new) {
        View::make('user/passwd.html', array('error' => 'Väärä käyttäjätunnus tai salasana!',
          'user' => $user_old));
      } else {
        User::update_passwd($kayttajatunnus, $params['new_password']);

        Redirect::to('/' . $user->kayttajatunnus, array('message' => 'Salasana päivitetty'));

      }
    }



  }
