<?php

  class CustomersController extends BaseController {

    public static function index() {
      self::check_logged_in();
      $customers = Customer::all();

      View::make('customer/index.html', array('customers'=> $customers));
    }

    public static function create() {
      self::check_logged_in();
      View::make('customer/new.html');
    }


    public static function show($id) {
      self::check_logged_in();
      $customer = Customer::find($id);
      $policies = Policy::all_customer($id); // hakee asiakkaan sopimukset

      View::make('customer/show.html', array('customer' => $customer, 'policies' => $policies));
    }

    public static function store() {
      self::check_logged_in();
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
      self::check_logged_in();
      $customers = Customer::find($id);
      View::make('customer/edit.html', array('customer' => $customers));
    }

    // Asiakkaan muokkaaminen (lomakkeen käsittely)
    public static function update($id) {
      self::check_logged_in();
      $params = $_POST;

      $customer = new Customer(array(
        'id' => $id,
        'henkilotunnus' => $params['henkilotunnus'],
        'sukunimi' => $params['sukunimi'],
        'etunimi' => $params['etunimi'],
        'katuosoite' => $params['katuosoite'],
        'postinumero' => $params['postinumero'],
        'postitoimipaikka' => $params['postitoimipaikka'],
        'puhelinnumero' => $params['puhelinnumero'],
        'tila' => 'aktiivi'
      ));

      $customer->savechanges();

      Redirect::to('/customer/' . $id , array('message' => 'Asiakkaan tiedot päivitetty rekisteriin.'));
    }

    // Asiakkaan muokaaminen (lomakkeen esittäminen), asiakas muokkaa
    public static function cust_edit($id) {
      self::check_logged_in();
      $customers = Customer::find($id);
      $user = User::find_username_for_customer($id);
      View::make('/customer/cust_edit.html', array('customer' => $customers, 'user' => $user));
    }

    // Asiakkaan muokkaaminen (lomakkeen käsittely), asiakas muokkaa
    public static function cust_update($id) {
      self::check_logged_in();
      $params = $_POST;
      $username = User::find_username_for_customer($id);

      $customer = new Customer(array(
        'id' => $id,
    //    'henkilotunnus' => $params['henkilotunnus'],
    //    'sukunimi' => $params['sukunimi'],
    //    'etunimi' => $params['etunimi'],
        'katuosoite' => $params['katuosoite'],
        'postinumero' => $params['postinumero'],
        'postitoimipaikka' => $params['postitoimipaikka'],
        'puhelinnumero' => $params['puhelinnumero']
    //    'tila' => 'aktiivi'
      ));

      $customer->savechanges_customer();

      Redirect::to('/' . $username, array('message' => 'Asiakastietosi päivitetty rekisteriin.'));
    }



    // Asiakkaan poistaminen
    public static function destroy($id) {
      self::check_logged_in();
      $customers = Customer::find($id);
      View::make('customer/destroy.html', array('customer' => $customers));
    }

    public static function delete($id) {
      self::check_logged_in();
      $params = $_POST;
      $customers = Customer::all();

      $customer = new Customer(array(
        'id' => $id,
      ));

      $customer->delete();

      Redirect::to('/customer/' . $id, array('message' => 'Asiakkaan tiedot poistettu.'));
    }

  }
