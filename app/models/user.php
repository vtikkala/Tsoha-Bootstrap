<?php

  class User extends BaseModel {

    // Attribuutit
    public $id, $kayttajatunnus, $salasana, $rooli, $asiakastunnus, $tila, $user;

    // Konstruktori
    public function __construct($attributes) {
      parent::__construct($attributes);
    }

    // Käyttäjän autentikointi
    public static function authenticate($kayttajatunnus, $salasana) {
      $query = DB::connection()->prepare('SELECT * FROM kayttaja
        WHERE kayttajatunnus = :kayttajatunnus LIMIT 1');
      $query->execute(array('kayttajatunnus' => $kayttajatunnus));
      $row = $query->fetch();

      if ($row) {
        $user = new User(array(
          'id' => $row['id'],
          'kayttajatunnus' => $row['kayttajatunnus'],
          'salasana' => $row['salasana'],
          'rooli' => $row['rooli'],
          'asiakastunnus' => $row['rooli'],
          'tila' => $row['tila']
        ));

        //return $user;


        if ($user) {
          $user_name = $user->kayttajatunnus;
          $user_password = $user->salasana;

          if ($kayttajatunnus == $user_name and $salasana == $user_password) {
            return $user;
          }
        }

      }
    }

    // Metodi joka palauttaa halutun käyttäjän
    public static function find($kayttajatunnus) {
      $query = DB::connection()->prepare('SELECT * FROM kayttaja
        WHERE kayttajatunnus = :kayttajatunnus LIMIT 1');
      $query->execute(array('kayttajatunnus' => $kayttajatunnus));
      $row = $query->fetch();

      if ($row) {
        $user = new User(array(
          'id' => $row['id'],
          'kayttajatunnus' => $row['kayttajatunnus'],
          'salasana' => $row['salasana'],
          'rooli' => $row['rooli'],
          'asiakastunnus' => $row['rooli'],
          'tila' => $row['tila']
        ));

        return $user;
      }
    }

  }
