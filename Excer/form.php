<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
<div class="bg-secondary p-4 m-4 lead text-light rounded-3"><?php var_dump($_POST); ?></div>
<?php endif ?>

<!-- HTML Start -->
<form class="col-md-6 border p-3 my-3 custom-form-shaddow" method="post">
    <fieldset class="mb-3">
        <legend>Post Details</legend>
        <div class="form-group mb-3">
            <label class="form-label visually-hidden" for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" placeholder="Title" required>
        </div>
        
        <div class="form-floating">
            <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
            <label for="content">Content</label>
        </div>
    </fieldset>
    <fieldset class="mb-3">
        <legend>Attributes</legend>
        <div class="form-check">
            <label class="form-check-label" for="visible">Visible</label>
            <input class="form-check-input" type="checkbox" name="visible" id="visible" value="Yes">
        </div>
    </fieldset>

    <fieldset class="mb-3">
        <legend>Color</legend>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="color" id="color_red">
            <label class="form-check-label" for="color_red">
                Red
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="color" id="color_green" checked>
            <label class="form-check-label" for="color_green">
                Green
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="color" id="color_blue" checked>
            <label class="form-check-label" for="color_blue">
                Blue
            </label>
        </div>
    </fieldset>

    <div class="d-grid">
        <button class="btn btn-success">Send</button>
    </div>
</form>