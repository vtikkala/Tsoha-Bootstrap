<?php

  class CustomersController extends BaseController {

    public static function index() {
      $customers = Customer::all();

      View::make('customer/index.html', array('customers'=> $customers));
    }

    public static function create() {
      View::make('customer/new.html');
    }


    public static function show($id) {
      $customer = Customer::find($id);

      // Tätä vielä selvitettävä!
      View::make('customer/show.html');
    }

    public static function store() {
      $params = $_POST;

      $customer = new Customer(array(
      //  'id' =>
        'henkilotunnus' => $params['henkilotunnus'],
        'sukunimi' => $params['sukunimi'],
        'etunimi' => $params['etunimi'],
        'katuosoite' => $params['katuosoite'],
        'postinumero' => $params['postinumero'],
        'postitoimipaikka' => $params['postitoimipaikka'],
        'puhelinnumero' => $params['puhelinnumero'],
        'tila' => 'aktiivi'
      ));

      $customer->save();

      Redirect::to('/customer/' . $customer->id, array('message' => 'Asiakas on lisätty rekisteriin.'));
    }

    // Asiakkaan muokaaminen (lomakkeen esittäminen)
    public static function edit($id) {
      $customer = Customer::find($id);
      View::make('customer/edit.html', array('attributes' => $customer));
    }

    // Asiakkaan muokkaaminen (lomakkeen käsittely)
    public static function update($id) {
      $params = $_POST;

      $attributes = array(
        'id' => $id,
        'henkilotunnus' => $params['henkilotunnus'],
        'sukunimi' => $params['sukunimi'],
        'etunimi' => $params['etunimi'],
        'katuosoite' => $params['katuosoite'],
        'postinumero' => $params['postinumero'],
        'postitoimipaikka' => $params['postitoimipaikka'],
        'puhelinnumero' => $params['puhelinnumero'],
        'tila' => $params['tila']
      );

      $attributes->update();

      Redirect::to('/customer/' . $customer->id, array('message' => 'Asiakkaan tiedot päivitetty rekisteriin.'));
    }

    // Asiakkaan poistaminen
    public static function delete($id) {
      $params = $_POST;

      $attributes = array(
        'id' => $id,
        'henkilotunnus' => $params['henkilotunnus'],
        'sukunimi' => $params['sukunimi'],
        'etunimi' => $params['etunimi'],
        'katuosoite' => $params['katuosoite'],
        'postinumero' => $params['postinumero'],
        'postitoimipaikka' => $params['postitoimipaikka'],
        'puhelinnumero' => $params['puhelinnumero'],
        'tila' => $params['tila']
      );

      $attributes->delete();
    }

  }
