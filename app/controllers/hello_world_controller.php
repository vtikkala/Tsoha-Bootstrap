<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      echo 'Tämä on etusivu!';
      // View::make('home.html');
    }

    public static function login(){
      View::make('suunnitelmat/login.html');
    }

    public static function search(){
      View::make('suunnitelmat/search.html');
    }

    public static function create_customer(){
      View::make('suunnitelmat/create_customer.html');
    }

    public static function modify_customer(){
      View::make('suunnitelmat/modify_customer.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      // echo 'Hello World!';
      View::make('helloworld.html');
    }
  }
