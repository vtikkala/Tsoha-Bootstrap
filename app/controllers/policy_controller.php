<?php

  class PolicyController extends BaseController {

    public static function show($id) {
      $policies = Policy::find($id);

      View::make('policy/cust_view.html', array('policy' => $policies));
    }


  }
