<?php

/**
 * Upload or Edit Image
 * 
 */
class ManageImage
{

    /**
     * Upload or Edit an image
     * @param object $conn Connection to the database
     * @param object $article Article that needs the upload
     * 
     * @return void Return nothing when successful and an error if not
     */
    public static function uploadImage($conn, $article)
    {
        // Handle errors
        try {
            // #1 Check to see if a file has been uploaded (this is effected by Max post size and max upload size on the server settings)
            if (empty($_FILES)) {
                throw new Exception("Invalid upload");
            }
            // #2 Check for errors codes on the upload input control
            switch ($_FILES['file']['error']) {
                    // This case is for successful uploads
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new Exception('No file uploaded');
                    break;
                case UPLOAD_ERR_INI_SIZE:
                    throw new Exception("Upload file too big, max size 3mb");

                default:
                    throw new Exception('An error has occurred');
                    break;
            }

            // #3 Set the max file upload size using code (Note the server setting is also used and the least of the 2 will be applied) 
            if ($_FILES['file']['size'] > 5000000) {
                throw new Exception("File too big, max size is 1mb", 1);
            }

            // #4 Set allowed upload types (MIME types)
            $mime_types = ['image/gif', 'image/png', 'image/jpeg'];

            // #5 Check validate the file type (not just the extension)
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

            if (!in_array($mime_type, $mime_types)) {
                throw new Exception("Invalid file type, only *.png or *.jpeg or *.git is allowed", 1);
            }

            // #5 Check filename and replace unwanted characters with underscores
            $pathinfo = pathinfo($_FILES['file']['name']);
            $base = $pathinfo['filename'];
            $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);

            // #6 restrict the filename length (This will also be effected with the limit in the database table)
            $base = mb_substr($base, 0, 200);

            // #7 Set the uploaded file name
            $filename = "id" . $article->id . "_" . $base . "." . $pathinfo['extension'];

            // #8 Set the destination where the file will be stored
            $destination = '../uploads/' . $filename;

            // #9 Avoid overwriting files with the same name by adding a suffix with counter
            $i = 1;
            while (file_exists($destination)) {
                // Attempt to create unique file name
                $filename = $base . "_dub_$i." . $pathinfo['extension'];
                // update the destination with the unique file name
                $destination = '../uploads/' . $filename;
                // increment the counter while the name exist
                $i++;
            }

            // #10 Actual uploading (or rather moving the file to the server filing system)
            if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {

                // Set the previous img file to a var
                $previous_image = $article->image_file;

                // #11 Set the filename in the database table
                if ($article->setImageFile($conn, $filename)) {

                    // #12 If a previous image exist then delete it before setting/uploading the new image
                    if ($previous_image) {
                        unlink("../uploads/$previous_image");
                    }
                    // redirect to new image edit page
                    Url::redirect("admin/article.php?id={$article->id}");
                }
            } else {
                throw new Exception("Unable to move uploaded file");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }

    /**
     * Delete a image from the post
     * @param object $conn Connection to the database
     * @param object $article Article that needs the upload
     * 
     * @return void Return nothing when successful
     */
    public static function deleteImage($conn, $article)
    {
        // Process the form
        // Set the previous img file to null
        $previous_image = $article->image_file;

        // set the image_file value to null
        if ($article->setImageFile($conn, null)) {

            // If a previous image exist then delete it
            if ($previous_image) {
                unlink("../uploads/$previous_image");
            }
            // redirect to new image edit page
            Url::redirect("admin/article.php?id={$article->id}");
        }
    }
}
