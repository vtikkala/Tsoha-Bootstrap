<?php

  class BaseController{

    public static function get_user_logged_in(){
      // Katsotaan onko user-avain sessiossa
      if(isset($_SESSION['user'])) {
        $user_id = $_SESSION['user'];

        // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
        $user = User::find($user_id);

        return $user;
      }
      // Käyttäjä ei ole kirjautunut sisään
      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

  }
