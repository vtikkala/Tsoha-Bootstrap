<?php

  $routes->get('/:kayttajatunnus', function($kayttajatunnus) {
    UserController::index($kayttajatunnus);
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

  $routes->get('/customer/:id/edit', function($id) {
    CustomersController::edit($id);
  });

  $routes->post('/customer/:id/edit', function($id) {
    CustomersController::update($id);
  });

  $routes->get('/customer/:id/destroy', function($id) {
    CustomersController::destroy($id);
  });

  $routes->post('/customer/:id/destroy', function($id) {
    CustomersController::delete($id);
  });

  $routes->get('/user/login', function() {
    UserController::login();
  });

  $routes->post('/user/login', function() {
    UserController::handle_login();
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
