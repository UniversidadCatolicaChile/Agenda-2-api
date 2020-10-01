<?php

/**
 * Edit this file in order to configure additional
 * image sizes for your theme.
 *
 * @see https://developer.wordpress.org/reference/functions/add_image_size/
 *
 * @key string The size name.
 *
 * @param int         $width  The image width.
 * @param int         $height The image height.
 * @param bool|array  $crop   Crop option. Since 3.9, define a crop position with an array.
 * @param bool|string $media  Add to media selection dropdown. Make it also available
 *                            to the media custom field. If string, used as the display name ;)
 */
return [
    'normal' => [469, 435, array( 'center', 'top' )],
    '600_450' => [600, 450, array( 'center', 'top' )],
    '800_600' => [800, 600, array( 'center', 'top' )],
    '800_450' => [800, 450, array( 'center', 'top' )],
    '1280_960' => [1280, 960, array( 'center', 'top' )]
];
