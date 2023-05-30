<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\View;

include __DIR__ .'../../utils/helper.php';

class HomeController
{
    public function index(): View
    {
        return View::make('index');
    }

    public function upload(): View
    {
        // to make test easier, adjust the exponent to '0', so the max will be something like 2 bytes, assuming your php.ini is 2Mb.
        $upload_max_bytes = pow(1024,2) * (int)(str_replace('M', '', ini_get('upload_max_filesize')));

        // Reject the uploaded file if larger than the php.ini upload_max_filesize setting
        if ((int)$_FILES["user_upload"]["size"] > $upload_max_bytes) {

            echo "<span class='file-save-message'>"
                . ( $_FILES["user_upload"]["name"] )
                . "<br /><br /> has a file size of: "
                . number_format( (int)$_FILES["user_upload"]["size"], 0, '', ' ')
                . " bytes <br /> ⇢ this file is "
                . number_format((int)($_FILES["user_upload"]["size"]) - (($upload_max_bytes)),0,'',' ')
                . " bytes more than the maximum file size limit of <strong>"
                . number_format((int) $upload_max_bytes,0,'',' ')
                . " bytes </strong><br /></span>";

            echo messageInterval(4000);
            exit;
        }

        $mime_types = ["application/csv", "text/csv"];

        $filePath = STORAGE_PATH . '/' . $_FILES['user_upload']['name'];

        if ( ! in_array($_FILES["user_upload"]["type"], $mime_types)) {

            echo "<span class='file-save-message'>"
                    . ( $_FILES["user_upload"]["type"] )
                    . "  ⇢ invalid file type"
                    . "</span>";

            echo messageInterval(2000);
            exit;
        }

        if ( move_uploaded_file($_FILES["user_upload"]["tmp_name"], $filePath)) {

            echo "<p class='file-save-message'> 👌🏼 " . $_FILES['user_upload']['name'] . " uploaded successfully.</p>";

        } else {

            echo "<p class='file-save-message'>⛔️ Failed to upload: " . $_FILES['user_upload']['name'] . ".</p>";
        }

        echo messageInterval(2000);

        return View::make('index' );

    }
}
