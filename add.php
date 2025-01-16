<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $datum = $_POST['inpt'] ?? '';
        if (isset($_POST['adding'])) {
            file_put_contents('data.txt', $datum);
            echo "content added successfully";
        } elseif (isset($_POST['peeking'])) {
            $content = file_get_contents('data.txt');
            echo $content;
        } elseif (isset($_POST['clearing'])) {
            echo "";
        }
    } 
    ?>