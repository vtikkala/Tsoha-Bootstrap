<?php

  class UserController extends BaseController {

    public static function new() {
      View::make('user/new.html');
    }

    public static function create() {
      $params = $_POST;

      $user = new User(array(
        'kayttajatunnus' => $params['kayttajatunnus'],
        'salasana' => $params['salasana'],
        'rooli' => $params['rooli'],
        'asiakastunnus' => $params['asiakastunnus'],
        'tila' => $params['tila']
      ));

      $user->save();
      Redirect::to('/', array('message' => 'Käyttäjä lisätty, kirjaudu uudelleen!'));
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

    public static function logout() {
      $_SESSION['user'] = null;
      Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function index($kayttajatunnus) {
      $user = User::find($kayttajatunnus);
      $user_role = $user->rooli;
      $asiakastunnus = $user->asiakastunnus;
      $customer = User::find_customer($asiakastunnus); // hakee asiakkaan tiedot
      $customers = Customer::all(); // hakee asiakkaan tiedoth
      $policies = Policy::all_customer($asiakastunnus); // hakee asiakkaan sopimukset

      if ($user_role == "asiakas") {
        View::make('user/customer.html', array('user' => $user, 'customer' => $customer, 'policies' => $policies)); // tehdään näkymä, josta käyttäjä näkee sopimukset
      } else {
        View::make('user/index.html', array('user' => $user, 'customers' => $customers, 'policies' => $policies)); // tehdään näkymä, josta käyttäjä näkee sopimukset
      }

    }

    public static function passwd($kayttajatunnus) {
      self::check_logged_in();
      $user = User::find($kayttajatunnus);
      View::make('user/passwd.html', array('user' => $user));
    }

    public static function change_passwd($kayttajatunnus) {
      self::check_logged_in();
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
