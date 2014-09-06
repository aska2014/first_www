<?php


App::singleton('Permission\Permission', function()
{
    return new \Permission\Permission(Auth::user());
});