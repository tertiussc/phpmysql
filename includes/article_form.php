<!-- Show Errors -->
<?php if (!empty($article->errors)) : ?>
    <ul class="list-unstyled">
        <?php foreach ($article->errors as $error) : ?>
            <li class="text-danger callout-danger">*<?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if (!empty($id)) : ?>
    <p class="callout-info"><small>
            Your post with ID: <?= $id; ?> has been added.
        </small></p>
<?php endif; ?>

<!-- The form -->
<form class="border rounded bg-white py-5 px-3 custom-form-shaddow" method="post" action="">
    <div class="mb-2">
        <label class="form-label visually-hidden" for="title">Title</label>
        <input class="form-control" type="text" name="title" id="name" placeholder="Title" value="<?= htmlspecialchars($article->title) ?>">
    </div>

    <div class="mb-2 form-floating">
        <textarea class="form-control" name="content" id="content" cols="30" rows="10"><?= htmlspecialchars($article->content); ?></textarea>
        <label for="content">Comments</label>
    </div>

    <div class="mb-2 col-md-4">
        <label class="form-label" for="published_at">Publication data and time</label>
        <input class="form-control" type="text" name="published_at" id="published_at" value="<?= htmlspecialchars($article->published_at); ?>" placeholder="YYYY-MM-DD HH:MM:SS">
    </div>
    <div class="mb-2 col-md-4 d-grid">
        <button class="btn btn-primary btn-sm px-5"><?= $buttontext; ?></button>
    </div>
</form>