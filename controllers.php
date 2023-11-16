<?php

/**
 * Includes the configuration file.
 */
include_once 'config/config.php';

/**
 * Includes the configuration file.
 */
function list_action()
{
    $posts  = get_all_posts();
    require('template/list.php');
}

/**
 * Shows a specific post by its ID.
 *
 * @param int $id The ID of the post.
 */

function show_action($id)
{
    $post = get_post_by_id($id);
    require('template/show.php');
}
/**
 * Adds a new post.
 *
 * If the request method is POST, a new post is added.
 * Otherwise, the form for adding a new post is displayed.
 */
function add_action()
{
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        add_post($title, $content);
        $logger = LoggerConfig::getLogger();
        $logger->info('Ajout de définition', [
            'title' => $title,
            'content' => $content,
            'user_ip' => $_SERVER['REMOTE_ADDR']
        ]);
        header('Location: /index.php');
    } else {
        require('template/form.php');
    }
    }

/**
 * Deletes a post by its ID.
 *
 * @param int $id The ID of the post.
 */
function delete_action($id)
{

    delete_post($id);
    header('Location: /index.php');
    exit();
}

/**
 * Updates a post by its ID.
 *
 * If the request method is POST, the post is updated.
 * Otherwise, the form for updating the post is displayed.
 *
 * @param int $id The ID of the post.
 */
function update_action($id)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        update_post($id, $title, $content);
        header('Location: /index.php/show?id=' . $id);
        exit();
    } else {
        $post = get_post_by_id($id);
        require('template/update_form.php');
    }
}
