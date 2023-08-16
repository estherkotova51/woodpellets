<?php
// ----------------------- RESIZE FUNCTION -----------------------
// Function for resizing any jpg, gif, or png image files
function ak_img_resize($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    } else {
           $h = $w / $scale_ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
        $img = imagecreatefromgif($target);
    } elseif($ext =="png"){ 
        $img = imagecreatefrompng($target);
    }elseif($ext =="webp"){ 
        $img = imagecreatefromwebp($target);
    }elseif($ext =="jpeg") { 
        $img = imagecreatefromjpeg($target);
    }elseif($ext =="jpg") { 
        $img = imagecreatefromjpeg($target);
    }
     $tci = imagecreatetruecolor($w, $h);
        
    // Set the background color of image 
    $background_color = imagecolorallocate($tci,  255, 255, 255); 
        
    // Fill background with above selected color 
    imagefill($tci, 0, 0, $background_color);

    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    if ($ext == "gif"){ 
        imagegif($tci, $newcopy);
    }elseif($ext =="png"){ 
        imagepng($tci, $newcopy);
    }elseif($ext =="jpeg") { 
        imagejpeg($tci, $newcopy, 100);
    }elseif($ext =="jpg") { 
        imagejpeg($tci, $newcopy, 100);
    }elseif($ext =="webp") { 
        imagewebp($tci, $newcopy, 100);
    }
}
// -------------- THUMBNAIL (CROP) FUNCTION ---------------
// Function for creating a true thumbnail cropping from any jpg, gif, or png image files
function ak_img_thumb($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $src_x = ($w_orig / 2) - ($w / 2);
    $src_y = ($h_orig / 2) - ($h / 2);
    $ext = strtolower($ext);
    $img = "";
    if ($ext == "gif"){ 
        $img = imagecreatefromgif($target);
    }elseif($ext =="png"){ 
        $img = imagecreatefrompng($target);
    }elseif($ext =="webp"){ 
        $img = imagecreatefromwebp($target);
    }elseif($ext =="jpeg") { 
        $img = imagecreatefromjpeg($target);
    }elseif($ext =="jpg") { 
        $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    imagecopyresampled($tci, $img, 0, 0, $src_x, $src_y, $w, $h, $w, $h);

                
        // Set the background color of image 
        $background_color = imagecolorallocate($tci,  255, 255, 255); 
            
        // Fill background with above selected color 
        imagefill($tci, 0, 0, $background_color);

    if ($ext == "gif"){ 
        imagegif($tci, $newcopy);
    }elseif($ext =="png"){ 
        imagepng($tci, $newcopy);
    }elseif($ext =="webp"){ 
        imagewebp($tci, $newcopy);
    }elseif($ext =="jpeg") { 
        imagejpeg($tci, $newcopy, 100);
    }elseif($ext =="jpg") { 
        imagejpeg($tci, $newcopy, 100);
    }
}
// ----------------------- IMAGE CONVERT FUNCTION -----------------------
// Function for converting GIFs and PNGs to JPG upon upload
function ak_img_convert_to_jpg($target, $newcopy, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $ext = strtolower($ext);
    $img = "";
    if ($ext == "gif"){ 
        $img = imagecreatefromgif($target);
    } elseif($ext =="png"){ 
        $img = imagecreatefrompng($target);
    }elseif($ext =="jpeg"){ 
        $img = imagecreatefromjpeg($target);
    }elseif($ext =="jpg"){ 
        $img = imagecreatefromjpeg($target);
    }elseif($ext =="webp"){ 
        $img = imagecreatefromwebp($target);
    }
    $tci = imagecreatetruecolor($w_orig, $h_orig);

    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w_orig, $h_orig, $w_orig, $h_orig);
    imagewebp($tci, $newcopy, 100);
}
// ----------------------- IMAGE WATERMARK FUNCTION -----------------------
// Function for applying a PNG watermark file to a file after you convert the upload to JPG
function ak_img_watermark($target, $wtrmrk_file, $newcopy) { 
    $watermark = imagecreatefrompng($wtrmrk_file); 
    imagealphablending($watermark, false); 
    imagesavealpha($watermark, true); 
    $img = imagecreatefromwebp($target);
    $img_w = imagesx($img); 
    $img_h = imagesy($img); 
    $wtrmrk_w = imagesx($watermark); 
    $wtrmrk_h = imagesy($watermark); 
    $dst_x = ($img_w / 2) - ($wtrmrk_w / 2); // For centering the watermark on any image
    $dst_y = ($img_h / 2) - ($wtrmrk_h / 2); // For centering the watermark on any image
    imagecopy($img, $watermark, $dst_x, $dst_y, 0, 0, $wtrmrk_w, $wtrmrk_h); 
    imagewebp($img, $newcopy, 60); 
    imagedestroy($img); 
    imagedestroy($watermark); 
} 

function ak_img_watermark2($target, $wtrmrk_file, $newcopy) { 
    $watermark = imagecreatefrompng($wtrmrk_file); 
    imagealphablending($watermark, false); 
    imagesavealpha($watermark, true); 
    $img = imagecreatefromwebp($target);
    $img_w = imagesx($img); 
    $img_h = imagesy($img); 
    $wtrmrk_w = imagesx($watermark); 
    $wtrmrk_h = imagesy($watermark); 
    $dst_x = ($img_w / 2) - ($wtrmrk_w / 2); // For centering the watermark on any image
    $dst_y = ($img_h / 2) - ($wtrmrk_h / 2); // For centering the watermark on any image
    imagecopy($img, $watermark, $dst_x, $dst_y, 0, 0, $wtrmrk_w, $wtrmrk_h); 
    imagewebp($img, $newcopy, 100); 
    imagedestroy($img); 
    imagedestroy($watermark); 
}
?>