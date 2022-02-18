<?php

require "../vendor/autoload.php";

$abstractController = new \App\Abstracts\AbstractController();
$_auth = new \App\Controllers\AuthController();
$abstractController->addModule("auth", $_auth);

$_session = $_auth->get_session();
if(!empty($_session)){
  	$_me = new \App\Controllers\UserController($_session);
  	$abstractController->addModule("user", $_me);
}

$router = new \Bramus\Router\Router();

$router->setBasePath("/php_avance/mvc");
$router->get("/", function() { $controller = new \App\Controllers\HomeController(); $controller->index(); });

$router->get("/home", function() { $controller = new \App\Controllers\HomeController(); $controller->index(); });

$router->get("/products", function() { $controller = new \App\Controllers\ProductController(); $controller->index(); });
$router->get("/product/{productId}", function($productId) { $controller = new \App\Controllers\ProductController(); $controller->show($productId); });
$router->post("/product/{productId}", function($productId) { $controller = new \App\Controllers\ProductController(); $controller->show($productId); });

$router->get("/contact", function() { $controller = new \App\Controllers\ContactController(); $controller->index(); });
$router->post("/contact", function() { $controller = new \App\Controllers\ContactController(); $controller->index(); });

$router->get("/basket", function() { $controller = new \App\Controllers\BasketController(); $controller->index(); });
$router->post("/basket", function() { $controller = new \App\Controllers\BasketController(); $controller->index(); });

$router->get("/login", function() { $controller = new \App\Controllers\AuthController(); $controller->login(); });
$router->post("/login", function() { $controller = new \App\Controllers\AuthController(); $controller->login(); });

$router->get("/register", function() {  $controller = new \App\Controllers\AuthController(); $controller->register(); });

$router->get("/logout", function() {  $controller = new \App\Controllers\AuthController(); $controller->logout(); });

$router->get("/settings", function() { $controller = new \App\Controllers\UserController(); $controller->settings(); });

$router->get("/purchases", function() { $controller = new \App\Controllers\UserController(); $controller->purchases(); });

$router->set404(function() { $controller = new \App\Controllers\HomeController(); $controller->error404();});
$router->run();