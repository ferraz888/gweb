<?php 
/**
 * FILEPATH: /c:/xampp/htdocs/model/Posts.php
 * 
 * This file contains functions to interact with the 'posts' table in the 'mvc_post_crud' database.
 * 
 * Functions:
 * - connect_to_db(): creates a new PDO connection to the database.
 * - disconnect_db(&$connection): closes the PDO connection.
 * - get_all_posts(): retrieves all posts from the 'posts' table.
 * - get_post_by_id($id): retrieves a post from the 'posts' table by its ID.
 * - add_post($title, $content): adds a new post to the 'posts' table.
 * - delete_post($id): deletes a post from the 'posts' table by its ID.
 * - update_post($id, $title, $content): updates a post in the 'posts' table by its ID.
 */


/**
 * Establishes a new PDO connection to the database.
 *
 * @return PDO The database connection object.
 */
    function connect_to_db() {
        $connection = new PDO("mysql:host=localhost;dbname=mvc_post_crud;charset=utf8mb4", "root", '');
        return $connection;
    }

    /**
 * Closes the PDO connection.
 *
 * @param PDO $connection The database connection object.
 * @return null
 */
    function disconnect_db(&$connection) {
        return $connection = null;
    }

/**
 * Retrieves all posts from the 'posts' table.
 *
 * @return array An array of all posts.
 */
    function get_all_posts(){

        $connection = connect_to_db();

        $result = $connection->query("SELECT * FROM posts");

        $posts = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = $row;
        }

        disconnect_db($connection);
        return $posts;
    }

/**
 * Retrieves a post from the 'posts' table by its ID.
 *
 * @param int $id The ID of the post.
 * @return array An associative array of the post's details.
 */
    function get_post_by_id($id){

        $connection = connect_to_db();

        $query = 'SELECT created_at, title, content FROM posts WHERE id=:id';
        $statement = $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return $row;
    }
/**
 * Adds a new post to the 'posts' table.
 *
 * @param string $title The title of the post.
 * @param string $content The content of the post.
 * @return int The ID of the newly inserted post.
 */
    function add_post($title, $content) {

        
        $connection = connect_to_db();

        $query = 'INSERT INTO posts (title, content) VALUES (:title, :content)';
        $statement = $connection->prepare($query);
        $statement->bindValue(':title', $title, PDO::PARAM_STR);
        $statement->bindValue(':content', $content, PDO::PARAM_STR);
        $statement->execute();

        $lastInsertId = $connection->lastInsertId();

        disconnect_db($connection);

        return $lastInsertId;
    }

/**
 * Deletes a post from the 'posts' table by its ID.
 *
 * @param int $id The ID of the post.
 */
    function delete_post($id) {

        
        $connection = connect_to_db();

        $query = 'DELETE FROM posts WHERE id=:id';
        $statement = $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        disconnect_db($connection);
    }

/**
 * Updates a post in the 'posts' table by its ID.
 *
 * @param int $id The ID of the post.
 * @param string $title The new title of the post.
 * @param string $content The new content of the post.
 */
    function update_post($id, $title, $content) {
        $connection = connect_to_db();

        $query = 'UPDATE posts SET title=:title, content=:content WHERE id=:id';
        $statement = $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':title', $title, PDO::PARAM_STR);
        $statement->bindValue(':content', $content, PDO::PARAM_STR);
        $statement->execute();

        disconnect_db($connection);
    }

