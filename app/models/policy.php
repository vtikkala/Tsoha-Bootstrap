<?php

  class Policy extends BaseModel {

    // Attribuutit
    public $id, $sopimustunnus, $tuotetunnus, $vakuutuksenottaja, $vakuutettu1,
      $vakuutettu2, $tila, $turvansuuruus, $vakuutusmaksu, $tuotenimi, $sukunimi, $etunimi;

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
          'turvansuuruus' => $row['turvansuuruus'],
          'vakuutusmaksu' => $row['vakuutusmaksu']
        ));

        return $policies;
      }
    }

    // Metodi joka palauttaa tiedot asiakkaan sopimuksista
    public static function all_customer($asiakastunnus) {
      $query = DB::connection()->prepare('SELECT sopimus.id, tuote.tuotenimi, sopimus.sopimustunnus,
        asiakas.sukunimi, asiakas.etunimi, sopimus.turvansuuruus, sopimus.vakuutusmaksu, sopimus.tila FROM sopimus LEFT JOIN asiakas
        ON sopimus.vakuutuksenottaja = asiakas.id LEFT JOIN tuote ON sopimus.tuotetunnus = tuote.tuotetunnus WHERE sopimus.vakuutuksenottaja
        = :asiakastunnus');
      $query->execute(array('asiakastunnus' => $asiakastunnus));
      $rows = $query->fetchAll();
      $policies = array();

      foreach ($rows as $row) {
        $policies[] = new Policy(array(
          'id' => $row['id'],
          'tuotenimi' => $row['tuotenimi'],
          'sopimustunnus' => $row['sopimustunnus'],
          'sukunimi' => $row['sukunimi'],
          'etunimi' => $row['etunimi'],
          'turvansuuruus' => $row['turvansuuruus'],
          'vakuutusmaksu' => $row['vakuutusmaksu'],
          'tila' => $row['tila']
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

    public function save() {
      $query = DB::connection()->prepare('INSERT INTO sopimus (sopimustunnus, tuotetunnus, vakuutuksenottaja, vakuutettu1,
      vakuutettu2, tila, turvansuuruus, vakuutusmaksu) VALUES (:sopimustunnus, :tuotetunnus, :vakuutuksenottaja,
      :vakuutettu1, :vakuutettu2, :tila, :turvansuuruus, :vakuutusmaksu) RETURNING id');

      $query->execute(array('sopimustunnus' => $this->sopimustunnus, 'tuotetunnus' => $this->tuotetunnus,
      'vakuutuksenottaja' => $this->vakuutuksenottaja, 'vakuutettu1' => $this->vakuutettu1, 'vakuutettu2' => $this->vakuutettu2,
      'tila' => $this->tila, 'turvansuuruus' => $this->turvansuuruus, 'vakuutusmaksu' => $this->vakuutusmaksu));

      $row = $query->fetch();
      $this->id = $row['id'];
    }


    public function savechanges_customer() {
      $query = DB::connection()->prepare('UPDATE sopimus SET turvansuuruus = :turvansuuruus, vakuutusmaksu = :vakuutusmaksu WHERE id = :id');
      $query->execute(array('id' => $this->id,'turvansuuruus' => $this->turvansuuruus, 'vakuutusmaksu' => $this->vakuutusmaksu));
    }

    public function destroy() {
      $query = DB::connection()->prepare('UPDATE sopimus SET tila = :tila WHERE id = :id');
      $query->execute(array('id' => $this->id, 'tila' => $this->tila));
    }


  }
