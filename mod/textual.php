<?php

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function textual($textual_title, $textual_bar, $textual_data, $textual_button, $textual_button_link) {
        echo "<div class='center size'>";
        if ($textual_title != NULL) {
            echo "<p><h3 class='text-center'>$textual_title</h3></p>";
        }

        if ($textual_bar) {
            echo "<hr>";
        }

        foreach ($textual_data as $i) {
            echo "<p class='text-center infoLocation mt-3 '>$i</p>";
        }

        if ($textual_button != NULL && $textual_button_link != NULL) {
            echo "<a class='btn btn-outline-primary btn-lg align-self-center' href='?p=$textual_button_link'>$textual_button</a>";
        }
        echo "</div>";
    }

}