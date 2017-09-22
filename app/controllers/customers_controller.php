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

  }
