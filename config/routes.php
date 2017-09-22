<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/customer', function() {
    CustomersController::index();
  });

  $routes->post('/customer', function() {
    CustomersController::store();
  });

  $routes->get('/customer/new', function() {
    CustomersController::create();
  });


  $routes->get('/customer/:id', function($id) {
    CustomersController::show($id);
  });
  

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/search', function() {
    HelloWorldController::search();
  });

  /*

  $routes->get('/customer/create', function() {
    HelloWorldController::create_customer();
  });

  $routes->get('/customer/modify', function() {
    HelloWorldController::modify_customer();
  });

  */

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
