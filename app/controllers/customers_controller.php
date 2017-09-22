<?php

  class CustomersController extends BaseController {

    public static function index(){
      $customers = Customer::all();

      View::make('customer/index.html', array('customers'=> $customers));
    }

    /*public static function show($id) {
      $customer = Customer::find($id);

      // Tätä vielä selvitettävä!
      View::make('customer/show.html, 'customer'=> $customer);
    }
    */

  }
