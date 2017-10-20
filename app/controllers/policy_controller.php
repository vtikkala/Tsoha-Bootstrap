<?php

  class PolicyController extends BaseController {

    public static function new() {
      self::check_logged_in();

      View::make('policy/new.html');
    }

    public static function create() {
      $params = $_POST;
      $customer = $params['vakuutuksenottaja'];

      $policy = new Policy(array(
        'sopimustunnus' => $params['sopimustunnus'],
        'tuotetunnus' => $params['tuotetunnus'],
        'vakuutuksenottaja' => $params['vakuutuksenottaja'],
        'vakuutettu1' => $params['vakuutettu1'],
        'vakuutettu2' => $params['vakuutettu2'],
        'tila' => $params['tila'],
        'turvansuuruus' => $params['turvansuuruus'],
        'vakuutusmaksu' => $params['vakuutusmaksu']
      ));

      $policy->save();

      Redirect::to('/customer/' . $customer, array('message' => 'Sopimus on lisätty rekisteriin.'));
    }

    public static function show($id) {
      self::check_logged_in();
      $policies = Policy::find($id);

      View::make('policy/cust_view.html', array('policy' => $policies));
    }

    public static function cust_edit($id) {
      self::check_logged_in();
      $policies = Policy::find($id);

      View::make('policy/cust_edit.html', array('policy' => $policies));
    }

    public static function cust_update($id) {
      self::check_logged_in();
      $params = $_POST;

      $policy = new Policy(array(
        'id' => $id,
        'turvansuuruus' => $params['turvansuuruus'],
        'vakuutusmaksu' => $params['vakuutusmaksu']
      ));

      $policy->savechanges_customer();

      Redirect::to('/policy/' . $id, array('message' => 'Sopimustietosi päivitetty rekisteriin.'));
    }

    public static function destroy($id) {
      self::check_logged_in();

      $policy = new Policy(array(
        'id' => $id,
        'tila' => 'päättynyt'
      ));

      $policy->destroy();

      Redirect::to('/policy/' . $id, array('message' => 'Sopimustietosi päivitetty rekisteriin.'));
    }


  }
