<?php $title = 'List of Posts' ?>

<?php ob_start() ?>

<main class="container d-flex flex-column">
    <span class="d-flex justify-content-center">
        <h1>List of Posts</h1>
</span>
    <a href="/index.php/add" class='btn btn-primary mt-5 ' >add</a>
    <div class="d-flex justify-content-center flex-wrap mt-5  container">

        <?php foreach ($posts as $post) : ?>
            <a href="index.php/show?id=<?= $post['id'] ?>">
                <div class="card m-1 bg-light shadow-lg rounded" style="min-width: 13rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $post['title'] ?></h5>
                        <p>Created on: <?= $post['created_at'] ?></p>
                        <a href="index.php/delete?id=<?= $post['id'] ?>" class="btn btn-danger">Delete</a>
                        <a href="index.php/update?id=<?= $post['id'] ?>" class="btn btn-primary">Update</a>
                    </div>
                </div>
            </a>
        <?php endforeach ?>
    </div>

    <?php $content = ob_get_clean() ?>



    <?php include 'base.php' ?>