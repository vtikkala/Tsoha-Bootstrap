<?php

  $routes->get('/', function() {
    UserController::login();
  });

//  $routes->get('/user/login', function() {
//    UserController::login();
//  });

  $routes->post('/user/login', function() {
    UserController::handle_login();
  });

  $routes->post('/logout', function() {
    UserController::logout();
  });

  $routes->get('/user/:kayttajatunnus', function($kayttajatunnus) {
    UserController::index($kayttajatunnus);
  });

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

  $routes->get('/customer/:id/cust_edit', function($id) {
    CustomersController::cust_edit($id);
  });

  $routes->post('/customer/:id/cust_edit', function($id) {
    CustomersController::cust_update($id);
  });


  $routes->get('/customer/:id/destroy', function($id) {
    CustomersController::destroy($id);
  });

  $routes->post('/customer/:id/destroy', function($id) {
    CustomersController::delete($id);
  });

  $routes->get('/user/:kayttajatunnus/passwd', function($kayttajatunnus) {
    UserController::passwd($kayttajatunnus);
  });

  $routes->post('/user/:kayttajatunnus/passwd', function($kayttajatunnus) {
    UserController::change_passwd($kayttajatunnus);
  });

  $routes->get('/policy/new', function() {
    PolicyController::new();
  });

  $routes->post('/policy/new', function() {
    PolicyController::create();
  })

  $routes->get('/policy/:id', function($id) {
    PolicyController::show($id);
  });

  $routes->get('/policy/:id/cust_edit', function($id) {
    PolicyController::cust_edit($id);
  });

  $routes->post('/policy/:id/cust_edit', function($id) {
    PolicyController::cust_update($id);
  });

  $routes->get('/policy/:id/destroy', function($id) {
    PolicyController::destroy($id);
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
