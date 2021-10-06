<!-- Show Errors -->
<?php if (!empty($article->errors)) : ?>
    <ul class="list-unstyled">
        <?php foreach ($article->errors as $error) : ?>
            <li class="text-danger callout-danger">*<?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>


<!-- The form -->
<form class="border rounded bg-white py-5 px-3 custom-form-shaddow" method="post" id="formArticle">
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
        <input class="form-control" name="published_at" id="published_at" value="<?= htmlspecialchars($article->published_at); ?> " autocomplete="off" placeholder="YYYY-MM-DD HH:MM:SS">
    </div>

    <fieldset class="border rounded px-3 mb-2">
        <legend class="h6">Categories</legend>
        <?php foreach ($categories as $category) : ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="category[]" value="<?= $category['id'] ?>" id="category<?= $category['id'] ?>" <?= in_array($category['id'], $category_ids) ? 'checked' : ''; ?>>
                <label class="form-check-label" for="category<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></label>
            </div>
        <?php endforeach ?>
    </fieldset>
    <div class="mb-2 col-md-4 d-grid">
        <button class="btn btn-primary btn-sm px-5"><?= $buttontext; ?></button>
    </div>
</form>