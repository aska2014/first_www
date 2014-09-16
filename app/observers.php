<?php

\Cane\Models\Drive\Drive::observe(App::make('Cane\Observers\DriveObserver'));
\Cane\Models\Drive\File::observe(App::make('Cane\Observers\FileObserver'));
\Cane\Models\Company\ProjectComment::observe(App::make('Cane\Observers\ProjectCommentObserver'));
\Cane\Models\Company\Project::observe(App::make('Cane\Observers\ProjectObserver'));
\Cane\Models\Membership\User::observe(App::make('Cane\Observers\UserObserver'));
