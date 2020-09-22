<?php
class Application {
    public static function process() {
        $controllerName = "Article";
        $task = "index";

        if (!empty($_GET['controller']))
            $controllerName = ucfirst(htmlspecialchars($_GET['controller']));
        if (!empty($_GET['task']))
            $task = htmlspecialchars($_GET['task']);
        $controllerName = "\Controllers\\" . $controllerName;
        $controller = new $controllerName();
        $controller->$task();
    }
}