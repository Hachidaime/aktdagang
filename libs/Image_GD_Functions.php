<?php
function image_get_info($file) {
  if (!is_file($file)) {
    return FALSE;
  }

  $details = FALSE;
  $data = @getimagesize($file);
  $file_size = @filesize($file);

  if (isset($data) && is_array($data)) {
    $extensions = array('1' => 'gif', '2' => 'jpg', '3' => 'png');
    $extension = array_key_exists($data[2], $extensions) ?  $extensions[$data[2]] : '';
    $details = array('width'     => $data[0],
                     'height'    => $data[1],
                     'extension' => $extension,
                     'file_size' => $file_size,
                     'mime_type' => $data['mime']);
  }

  return $details;
}

/**
 * GD2 toolkit functions
 * With the minimal requirements of PHP 4.3 for Drupal, we use the built-in version of GD.
 */

/**
 * Verify GD2 settings (that the right version is actually installed).
 *
 * @return boolean
 */
function image_gd_check_settings() {
  if ($check = get_extension_funcs('gd')) {
    if (in_array('imagegd2', $check)) {
      // GD2 support is available.
      return TRUE;
    }
  }
  return FALSE;
}

/**
 * Scale an image to the specified size using GD.
 */
function image_gd_resize($source, $destination, $width, $height) {
  if (!file_exists($source)) {
    return FALSE;
  }

  $info = image_get_info($source);
  if (!$info) {
    return FALSE;
  }

  $im = image_gd_open($source, $info['extension']);
  if (!$im) {
    return FALSE;
  }
  
  //Turn on the ratio
  $source_image_width =  $info['width'];
  $source_image_height =  $info['height'];
  $thumbnail_image_width = $width;
  $thumbnail_image_height = $height;

  
  $source_aspect_ratio = $source_image_width / $source_image_height;
  $thumbnail_aspect_ratio = $width / $height;

  if ( $source_image_width <= $thumbnail_image_width && $source_image_height <= $thumbnail_image_height )
  {
   $width = $source_image_width;
   $height = $source_image_height;
  }
  elseif ( $thumbnail_aspect_ratio > $source_aspect_ratio )
  {
   $width = ( int ) ( $thumbnail_image_height * $source_aspect_ratio );
  }
  else
  {
   $height = ( int ) ( $thumbnail_image_width / $source_aspect_ratio );
  }

  $res = imageCreateTrueColor($width, $height);
  if ($info['extension'] == 'png') {
    $transparency = imagecolorallocatealpha($res, 0, 0, 0, 127);
    imagealphablending($res, FALSE);
    imagefilledrectangle($res, 0, 0, $width, $height, $transparency);
    imagealphablending($res, TRUE);
    imagesavealpha($res, TRUE);
  }
  
  
  
  imageCopyResampled($res, $im, 0, 0, 0, 0, $width, $height, $info['width'], $info['height']);
  $result = image_gd_close($res, $destination, $info['extension']);

  imageDestroy($res);
  imageDestroy($im);

  return $result;
}

/**
 * Rotate an image the given number of degrees.
 */
function image_gd_rotate($source, $destination, $degrees, $bg_color = 0) {
  if (!function_exists('imageRotate')) {
    return FALSE;
  }

  $info = image_get_info($source);
  if (!$info) {
    return FALSE;
  }

  $im = image_gd_open($source, $info['extension']);
  if (!$im) {
    return FALSE;
  }

  $res = imageRotate($im, $degrees, $bg_color);
  $result = image_gd_close($res, $destination, $info['extension']);

  return $result;
}

/**
 * Crop an image using the GD toolkit.
 */
function image_gd_crop($source, $destination, $x, $y, $width, $height) {
  $info = image_get_info($source);
  if (!$info) {
    return FALSE;
  }

  $im = image_gd_open($source, $info['extension']);
  $res = imageCreateTrueColor($width, $height);
  imageCopy($res, $im, 0, 0, $x, $y, $width, $height);
  $result = image_gd_close($res, $destination, $info['extension']);

  imageDestroy($res);
  imageDestroy($im);

  return $result;
}

/**
 * GD helper function to create an image resource from a file.
 */
function image_gd_open($file, $extension) {
  $extension = str_replace('jpg', 'jpeg', $extension);
  $open_func = 'imageCreateFrom'. $extension;
  if (!function_exists($open_func)) {
    return FALSE;
  }
  return $open_func($file);
}

/**
 * GD helper to write an image resource to a destination file.
 */
function image_gd_close($res, $destination, $extension) {
  
  $extension = str_replace('jpg', 'jpeg', $extension);
  $close_func = 'image'. $extension;
  if (!function_exists($close_func)) {
    return FALSE;
  }
  if ($extension == 'jpeg') {
    return $close_func($res, $destination, IMAGE_JPEG_QUALITY);
  }
  else {
    return $close_func($res, $destination);
  }
}
?>
