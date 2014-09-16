<?php

$path = dirname(__FILE__).'/../client/app/scripts';

foreach(glob($path.'/*.js') as $file)
{
    $file = str_replace($path, '', $file);

    echo '<script src="scripts'.$file.'"></script>'."\n";
}
foreach(glob($path.'/*/*.js') as $file)
{
    $file = str_replace($path, '', $file);

    echo '<script src="scripts'.$file.'"></script>'."\n";
}
foreach(glob($path.'/*/*/*.js') as $file)
{
    $file = str_replace($path, '', $file);

    echo '<script src="scripts'.$file.'"></script>'."\n";
}