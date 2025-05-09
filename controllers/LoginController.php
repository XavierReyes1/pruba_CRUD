<?php

namespace Controller;


use MVC\Router;

class LoginController
{

    public static function login(Router $router)
    {
  
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        

        }
 
        //render a la vista
        $router->render('login/login', [

      
        ]);
    }
    public static function logout()
    {
     
    }
  
   
    
}
