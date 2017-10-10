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
          'asiakastunnus' => $row['asiakastunnus'],
          'tila' => $row['tila']
        ));

        return $user;
      }
    }

    // Metodi joka palauttaa kayttajan asiakastiedot
    public static function find_customer($asiakastunnus) {
      $query = DB::connection()->prepare('SELECT * FROM asiakas
        WHERE id = :asiakastunnus');
      $query->execute(array('asiakastunnus' => $asiakastunnus));
      $row = $query->fetch();

      if ($row) {
        $customer = new Customer(array(
          'id' => $row['id'],
          'henkilotunnus' => $row['henkilotunnus'],
          'sukunimi' => $row['sukunimi'],
          'etunimi' => $row['etunimi'],
          'katuosoite' => $row['katuosoite'],
          'postinumero' => $row['postinumero'],
          'postitoimipaikka' => $row['postitoimipaikka'],
          'puhelinnumero' => $row['puhelinnumero'],
          'tila' => $row['tila']
        ));

        return $customer;
      }
    }

    // Metodi palauttaa asikastunnuksen
    public static function find_username($id) {
      $query = DB::connection()->prepare('SELECT kayttajatunnus FROM kayttaja
        WHERE id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();

      if ($row) {
        $user = new User(array(
          'kayttajatunnus' => $row['kayttajatunnus']
        ));
      }

      return $user->kayttajatunnus;
    }

    // Metodi palauttaa asiakkaan nimen
    public static function find_name($asiakastunnus) {
      $query = DB::connection()->prepare('SELECT sukunimi, etunimi FROM asiakas
        WHERE id = :asiakastunnus LIMIT 1');
      $query->execute(array('asiakastunnus' => $asiakastunnus));
      $row = $query->fetch();

      if ($row) {
        $customer = new Customer(array(
          'sukunimi' => $row['sukunimi'],
          'etunimi' => $row['etunimi']
        ));

        $customer_name = $customer->sukunimi . ' ' . $customer->etunimi;

        return $customer_name;
      }
    }

    // Salasanan päivitys
    public static function update_passwd($kayttajatunnus, $salasana) {
      $query = DB::connection()->prepare('UPDATE kayttaja SET salasana = :salasana
        WHERE kayttajatunnus = :kayttajatunnus');
      $query->execute(array('salasana' => $salasana, 'kayttajatunnus' => $kayttajatunnus));
    }



  }
