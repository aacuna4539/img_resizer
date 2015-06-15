<?php
/*
* This script relies heavily on the GD library.  Use phpinfo() to check if
* GD was compiled with your version of PHP.  For more on GD, see the official 
* documentation at https://php.net/manual/en/book.image.php
*/

//----I'm using $_GET here for convenience. 
$img_file = $_GET['image'];
$destination = 'my/path_to/images'

/* 
* Percentage as a decimal (for resizing down).  Values > 1 will enlarge the 
* image at the expense of image quality
 */
$percent_to_shrink_by = //---- Some integer ;


/* 
* Set the content type. header() sends a raw HTTP header.  You'll need it if you're 
* going to output directly to the browser. Comment out header() if you get the error 
* "The image 'url/muh_image.jpg' cannot be displayed because it contains errors." 
* Doing so will allow you to read the error messages, once you run the script again.  
 */
header('Content-Type: image/jpeg');

//---- asign values as if in an array with list()
list($width, $height) = getimagesize($img_file);
$new_width = $width * $percent_to_shrink_by;
$new_height = $height * $percent_to_shrink_by;

/*
* We'll need this for imagecopyresampled().  It returns an image 
* identifier representing a black image of the specified size,
* ie. a black square.
 */
$image_ctc = imagecreatetruecolor($new_width, $new_height);

/*
* imagecreatefromjpeg() returns an image identifier representing the 
* image obtained from the given filename. We'll need this for our next function.
 */
$image = imagecreatefromjpeg($img_file);

/*
* imagecopyresampled() copies a rectangular portion of one image to another
* image ($image_ctc in this case), smoothly interpolating pixel values 
* so that, in particular, reducing the size of an image still retains a great deal of clarity. 
 */
imagecopyresampled($image_ctc, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

/*
* Outputs the image to the browser if $destination (second parameter), is NULL.
* Third parameter sets image quality: Integer from 1 (worst) to 100 (best). Keep
* in mind, image quality will affect file size.
 */
//---pick one
imagejpeg($image_ctc, NULL, 100);
imagejpeg($image_ctc, $destination, 100);


