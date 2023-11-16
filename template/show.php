

<?php $title = $post['title'] ?>

<?php ob_start(); ?>
    <h1><?= $post['title'] ?></h1>
    <p><?= $post['created_at'] ?></p>
    <p>
        <?= $post['content'] ?>
    </p>

<?php $content = ob_get_clean() ?>
    <?php include 'base.php'?>