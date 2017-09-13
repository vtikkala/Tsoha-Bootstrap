<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/search', function() {
    HelloWorldController::search();
  });

  $routes->get('/customer/create', function() {
    HelloWorldController::create_customer();
  });

  $routes->get('/customer/modify', function() {
    HelloWorldController::modify_customer();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
