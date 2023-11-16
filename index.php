<?php
/**
 * Main entry point of the application.
 *
 * This script loads the necessary libraries, models, and controllers,
 * and then routes the request based on the URI.
 */

// load and initialize any global libraries
require 'vendor/autoload.php';

// load the Posts model and the controllers
require_once 'model/Posts.php';
require_once 'controllers.php';


/**
 * Routes the request internally based on the URI.
 *
 * If the URI matches a known route, the corresponding action is called.
 * If the URI does not match any known route, a 404 response is sent.
 */
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ('/index.php' === $uri || '/' === $uri) {
    list_action();
} elseif ('/index.php/show' === $uri && isset($_GET['id'])) {
    show_action($_GET['id']);
} elseif ('/index.php/add' === $uri) {
    add_action();
} elseif ('/index.php/delete' === $uri && isset($_GET['id'])) {
    delete_post($_GET['id']);
    header('Location: /');
} elseif ('/index.php/update' === $uri && isset($_GET['id'])) {
    update_action($_GET['id']);
} else {
    header('HTTP/1.1 404 Not Found');
    echo '<html><body><h1>Page Not Found</h1></body></html>';
}