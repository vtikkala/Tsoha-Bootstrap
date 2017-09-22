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
          'etunimi' => $row['sukunimi'],
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
          'etunimi' => $row['sukunimi'],
          'katuosoite' => $row['katuosoite'],
          'postinumero' => $row['postinumero'],
          'postitoimipaikka' => $row['postitoimipaikka'],
          'puhelinnumero' => $row['puhelinnumero'],
          'tila' => $row['tila']
        ));

        return $customer;
      }



    }



  }
