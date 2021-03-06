<?php

  class Customer extends BaseModel {

    // Attribuutit
    public $id, $henkilotunnus, $kayttajatunnus, $sukunimi, $etunimi, $katuosoite,
    $postinumero, $postitoimipaikka, $puhelinnumero, $tila;

    // Konstruktori
    public function __construct($attributes) {
      parent::__construct($attributes);
    }

    // Metodi joka palauttaa kaikki asiakkaat
    public static function all() {
      $query = DB::connection()->prepare('SELECT * FROM asiakas');
      $query->execute();
      $rows = $query->fetchAll();
      $customers = array();

      foreach ($rows as $row) {
        $customers[] = new Customer(array(
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
      }

      return $customers;
    }

    // Metodi joka palauttaa pyydetyn asiakkaan
    public static function find($id) {
      $query = DB::connection()->prepare('SELECT * FROM asiakas WHERE id = :id LIMIT 1');
      $query->execute(array('id' => $id));
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

    public function save() {
      $query = DB::connection()->prepare('INSERT INTO asiakas (henkilotunnus, sukunimi, etunimi, katuosoite,
      postinumero, postitoimipaikka, puhelinnumero, tila) VALUES (:henkilotunnus, :sukunimi, :etunimi,
      :katuosoite, :postinumero, :postitoimipaikka, :puhelinnumero, :tila) RETURNING id');

      $query->execute(array('henkilotunnus' => $this->henkilotunnus, 'sukunimi' => $this->sukunimi,
      'etunimi' => $this->etunimi, 'katuosoite' => $this->katuosoite, 'postinumero' => $this->postinumero,
      'postitoimipaikka' => $this->postitoimipaikka, 'puhelinnumero' => $this->puhelinnumero, 'tila' => $this->tila));

      $row = $query->fetch();
      $this->id = $row['id'];
    }

    public function savechanges() {
      $query = DB::connection()->prepare('UPDATE asiakas SET henkilotunnus = :henkilotunnus, sukunimi = :sukunimi, etunimi = :etunimi,
      katuosoite = :katuosoite, postinumero = :postinumero, postitoimipaikka = :postitoimipaikka, puhelinnumero = :puhelinnumero,
      tila = :tila WHERE id = :id');

      $query->execute(array('id' => $this->id, 'henkilotunnus' => $this->henkilotunnus, 'sukunimi' => $this->sukunimi,
      'etunimi' => $this->etunimi, 'katuosoite' => $this->katuosoite, 'postinumero' => $this->postinumero,
      'postitoimipaikka' => $this->postitoimipaikka, 'puhelinnumero' => $this->puhelinnumero, 'tila' => $this->tila));
    }

    public function savechanges_customer() {
      $query = DB::connection()->prepare('UPDATE asiakas SET katuosoite = :katuosoite, postinumero = :postinumero,
        postitoimipaikka = :postitoimipaikka, puhelinnumero = :puhelinnumero WHERE id = :id');

      $query->execute(array('id' => $this->id,'katuosoite' => $this->katuosoite, 'postinumero' => $this->postinumero,
      'postitoimipaikka' => $this->postitoimipaikka, 'puhelinnumero' => $this->puhelinnumero));
    }

    public function delete() {
      $query = DB::connection()->prepare('DELETE FROM asiakas WHERE id = :id');
      $query->execute(array('id' => $this->id));
    }

  }
