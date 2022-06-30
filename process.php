<?php
include("common/db_conn.php");
$errors = [];
$data = [];

function getFullHost()
{
    $protocole = $_SERVER['REQUEST_SCHEME'].'://';
    $host = $_SERVER['HTTP_HOST'] . '/';
    $project = explode('/', $_SERVER['REQUEST_URI'])[1];
    return $protocole . $host . $project;
}

if (empty($_POST['url'])) {
    $errors['url'] = 'Image URL is required.';
}

if (empty($_POST['degree'])) {
    $errors['degree'] = 'Degree is required.';
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $url    = $_POST['url'];
    $degree = (int)$_POST['degree'];
    $project = getFullHost()."/";
    $folderPath = "images/";
    // Assign image file to variable
    $image = $url;
    $fileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $fileNewName = pathinfo($image, PATHINFO_FILENAME);
    $sourceProperties = getimagesize($image);
    $imageType = $sourceProperties[2];
    // Rotate code
    switch ($imageType) {
    case IMAGETYPE_PNG:
        $imageResourceId = imagecreatefrompng($image); 
        $targetLayer = imagerotate($imageResourceId, $degree, 0);
       $finalName = $degree . "-degree-" . $fileNewName . uniqid() . ".jpg";
        $upload = imagejpeg($targetLayer, $folderPath . $finalName);
        break;
    case IMAGETYPE_GIF:
        $imageResourceId = imagecreatefromgif($image); 
        $targetLayer = imagerotate($imageResourceId, $degree, 0);
        $finalName = $degree . "-degree-" . $fileNewName . uniqid() . ".jpg";
        $upload = imagejpeg($targetLayer, $folderPath . $finalName);
        break;
    case IMAGETYPE_JPEG:
        $imageResourceId = imagecreatefromjpeg($image); 
        $targetLayer = imagerotate($imageResourceId, $degree, 0);
        $finalName = $degree . "-degree-" . $fileNewName . uniqid() . ".jpg";
        $upload = imagejpeg($targetLayer, $folderPath . $finalName);
        break;
    default:
        $upload = FALSE;;
        break;
    }              

    if($upload){

        $mysqli -> query("INSERT INTO `images`(`NAME`, `ORIGINAL_IMAGE`, `ROTATED_DEGREE`, `ROTATED_IMAGE`) VALUES ('$finalName', '$image', '$degree', ' $project$folderPath$finalName')");
        if($mysqli){
            $data['success'] = TRUE;
            $data['message'] = 'Rotated Image save Success.';
        }else{
            $data['success'] = FALSE;
            $data['message'] = 'Failed to insert into database!';
        }
    }else{
        $data['success'] = FALSE;
        $data['message'] = 'Invalid Image URL!';
    }
}

echo json_encode($data);