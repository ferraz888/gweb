

// template update_form.php
<?php $title = 'Update Posts' ?>
<?php ob_start(); ?>

<form method="post">
    <label for="title">Titre:</label><br>
    <input type="text" id="title" name="title" value="<?= $post['title'] ?>"><br>
    <label for="content">Contenu:</label><br>
    <textarea id="content" name="content"><?= $post['content'] ?></textarea><br>
    <input type="submit" value="Soumettre">
</form>

<?php $content = ob_get_clean() ?>
<?php include 'base.php'?>