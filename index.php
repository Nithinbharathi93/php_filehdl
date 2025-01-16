<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="index.php">
        <input type="text" name="inpt" placeholder="Add text">
        <button type="submit" name="adding">Add</button>
        <button type="submit" name="peeking">Read</button>
        <button type="submit" name="clearing">Clear</button>
    </form>
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
</body>
</html>