<?php

  class Policy extends BaseModel {

    // Attribuutit
    public $id, $sopimustunnus, $tuotetunnus, $vakuutuksenottaja, $vakuutettu1,
      $vakuutettu2, $tila, $turvansuuruus, $vakuutusmaksu;

    // Konstruktori
    public function __construct($attributes) {
      parent::__construct($attributes);
    }

    // Metodi joka palauttaa kaikki asiakkaan sopimukset
    public static function all($asiakastunnus) {
      $query = DB::connection()->prepare('SELECT * FROM sopimus
        WHERE vakuutuksenottaja = :asiakastunnus');
      $query->execute(array('asiakastunnus' => $asiakastunnus));
      $rows = $query->fetchAll();
      $policies = array();

      foreach ($rows as $row) {
        $policies[] = new Policy(array(
          'id' => $row['id'],
          'sopimustunnus' => $row['sopimustunnus'],
          'tuotetunnus' => $row['tuotetunnus'],
          'vakuutuksenottaja' => $row['vakuutuksenottaja'],
          'vakuutettu1' => $row['vakuutettu1'],
          'vakuutettu2' => $row['vakuutettu2'],
          'tila' => $row['tila'],
          'turvansuuruus' => $row['turvansuuruus'],
          'vakuutusmaksu' => $row['vakuutusmaksu']
        ));

        return $policies;
      }
    }

    // Metodi palauttaa halutun sopimuksen tiedot
    public static function find($id) {
      $query = DB::connection()->prepare('SELECT * FROM sopimus  WHERE id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();

      if($row) {
        $vakuutuksenottaja = $row['vakuutuksenottaja'];
        $vakuutettu1 = $row['vakuutettu1'];
        $vakuutettu2 = $row['vakuutettu2'];

        $policy = new Policy(array(
          'id' => $row['id'],
          'sopimustunnus' => $row['sopimustunnus'],
          'tuotetunnus' => $row['tuotetunnus'],
          'vakuutuksenottaja' => $row['vakuutuksenottaja'],
          'vakuutettu1' => $row['vakuutettu1'],
          'vakuutettu2' => $row['vakuutettu2'],
          'tila' => $row['tila'],
          'turvansuuruus' => $row['turvansuuruus'],
          'vakuutusmaksu' => $row['vakuutusmaksu']
        ));

        $query = DB::connection()->prepare('SELECT sukunimi, etunimi FROM asiakas WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $vakuutuksenottaja));
        $row = $query->fetch();

        if($row) {
          $policy->vakuutuksenottaja = $row['sukunimi'] . " " . $row['etunimi'];
        }

        $query = DB::connection()->prepare('SELECT sukunimi, etunimi FROM asiakas WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $vakuutettu1));
        $row = $query->fetch();

        if($row) {
          $policy->vakuutettu1 = $row['sukunimi'] . " " . $row['etunimi'];
        }

        $query = DB::connection()->prepare('SELECT sukunimi, etunimi FROM asiakas WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $vakuutettu2));
        $row = $query->fetch();

        if($row) {
          $policy->vakuutettu2 = $row['sukunimi'] . " " . $row['etunimi'];
        }

        return $policy;
      }
    }

  }
