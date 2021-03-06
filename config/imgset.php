<?php ob_start(); ?>
<?php

function createThumbnail($srcFile, $destFile, $width, $quality = 150)
{
        $thumbnail = '';

        if (file_exists($srcFile)  && isset($destFile))
        {
                $size        = getimagesize($srcFile);
                $w           = number_format($width, 0, ',', '');
                $h           = number_format(($size[1] / $size[0]) * $width, 0, ',', '');

                $thumbnail =  copyImage($srcFile, $destFile, $w, $h, $quality);
        }

        // return the thumbnail file name on sucess or blank on fail
        return basename($thumbnail);
}


function copyImage($srcFile, $destFile, $w, $h, $quality = 150)
{
    $tmpSrc     = pathinfo(strtolower($srcFile));
    $tmpDest    = pathinfo(strtolower($destFile));
    $size       = getimagesize($srcFile);

    if ($tmpDest['extension'] == "gif" || $tmpDest['extension'] == "jpg")
    {
       $destFile  = substr_replace($destFile, 'jpg', -3);
       $dest      = imagecreatetruecolor($w, $h);
       imageantialias($dest, TRUE);
    } elseif ($tmpDest['extension'] == "png") {
       $dest = imagecreatetruecolor($w, $h);
       imageantialias($dest, TRUE);
    } else {
      return false;
    }

    switch($size[2])
    {
       case 1:       //GIF
           $src = imagecreatefromgif($srcFile);
           break;
       case 2:       //JPEG
           $src = imagecreatefromjpeg($srcFile);
           break;
       case 3:       //PNG
           $src = imagecreatefrompng($srcFile);
           break;
       default:
           return false;
           break;
    }

    imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);

    switch($size[2])
    {
       case 1:
       case 2:
           imagejpeg($dest,$destFile, $quality);
           break;
       case 3:
           imagepng($dest,$destFile);
    }
    return $destFile;

}

function uploadProductImage($inputName, $uploadDir)
{
	$image     = $_FILES[$inputName];
	$imagePath = '';
	$thumbnailPath = '';
	
	// if a file is given
	if (trim($image['tmp_name']) != '') {
		$ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];

		// generate a random new file name to avoid name conflict
		$imagePath = md5(rand() * time()) . ".$ext";
		
		list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 

		// make sure the image width does not exceed the
		// maximum allowed width
		if (LIMIT_PRODUCT_WIDTH && $width > MAX_PRODUCT_IMAGE_WIDTH) {
			$hasil    = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_PRODUCT_IMAGE_WIDTH);
			$imagePath = $hasil;
		} else {
			$hasil = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
		}	
		
		
		
	}

	
	return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
}

function uploadProductvideo($inputName, $uploadDir)
{
	$image     = $_FILES[$inputName];
	$imagePath = '';
	$thumbnailPath = '';
	
	// if a file is given
	if (trim($image['tmp_name']) != '') {
		$ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];

		// generate a random new file name to avoid name conflict
		$imagePath = md5(rand() * time()) . ".$ext";
		
		list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 

		// make sure the image width does not exceed the
		// maximum allowed width
	
			$hasil = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
	
		
		
		
	}

	
	return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
}
?>
<?php ob_flush();  ?>
