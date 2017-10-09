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

  }
