<?php
$popup = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if file was uploaded without errors
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $uploadDir = 'photo/';
        $filename = basename($_FILES['foto']['name']);
        $targetFile = $uploadDir . $filename;

        // Check file type
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileType, $allowedTypes)) {
            // Move the uploaded file
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {
                echo "File uploaded successfully";
            } else {
                echo "Error moving the uploaded file.";
            }
        } else {
            echo "Unsupported file type.";
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="asset/css/style.css">
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <label for="foto">INSERT FOTO</label>
        <input type="file" name="foto" id="foto" width="500px" height="100%">
        <button type="submit" name="submit">Change</button>
    </form>

    <img id="image" src="<?php if(isset($targetFile)){ echo $targetFile; } ?>" draggable="false" alt="Image">
    <canvas id="canvas"></canvas>
    <div id="color"></div>
    <script src="asset/js/script.js"></script>
</body>
</html>