<?php
    // Include my config file
    include 'application/sys/config.php';
    
    // Include basic classes that I'm going to need here
    require_once 'application/sys/Router.php';
    require_once 'application/sys/Registry.php';
    require_once 'application/sys/View.php';
    require_once 'application/sys/BaseController.php';
    require_once 'application/sys/BaseRepository.php';
    require_once 'application/sys/BaseModel.php';
    
    // Set up our router and registry
    $router = new Router();
    $registry = new Registry();
    
    // Set up initial values in the registry
    $registry->utils    = $utils;
    $registry->database = $database;
    $registry->styles = $styles;
    $registry->js = $js;
    
    // Route our request
    $router->route($registry);