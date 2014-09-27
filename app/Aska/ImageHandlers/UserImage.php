<?php namespace Aska\ImageHandlers;

use Aska\Membership\Models\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class UserImage extends ModelImage {

    /**
     * Set profile image
     */
    public function setProfileImage(UploadedFile $file, User $user)
    {
        $path = 'albums/profile/user'.$user->id.'.jpg';

        // Fit image and move to profile images path then set profile image attribute
        Image::make($file)->fit(400, 400)->save(public_path($path));

        return $user->profileImage()->create(compact('path'));
    }

} 