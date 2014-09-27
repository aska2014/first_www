<?php

use Aska\BMS\Models\Project;
use Aska\BMS\Models\ProjectComment;
use Aska\Drive\Models\Drive;
use Aska\Drive\Models\File;
use Aska\Media\Models\Image;
use Aska\Membership\Models\User;


///// BMS Observers
ProjectComment::observe(App::make('Aska\BMS\Observers\ProjectCommentObserver'));
Project::observe(App::make('Aska\BMS\Observers\ProjectObserver'));


//// Membership Observers
User::observe(App::make('Aska\Membership\Observers\UserObserver'));


//// Drive Observers
Drive::observe(App::make('Aska\Drive\Observers\DriveObserver'));
File::observe(App::make('Aska\Drive\Observers\FileObserver'));


//// Media Observers
Image::observe(App::make('Aska\Media\Observers\ImageObserver'));