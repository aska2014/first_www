<?php

trait FileAttachments {


    /**
     * @param $files
     * @return array
     */
    protected function extractFilesIds($files)
    {
        $ids = [];

        // Extract ids from files objects
        foreach($files as $file) {

            if(isset($file['id'])) array_push($ids, $file['id']);
        }

        return $ids;
    }

    /**
     * @param $files
     */
    public function setFilesAttribute($files)
    {
        $ids = $this->extractFilesIds($files);

        // If it exists then extract files ids and synchronize them
        if($this->exists) {
            $this->files()->sync($ids);
        // Else then delay the file attaching after the model is created
        } else {
            $this->created(function($model) use ($ids)
            {
                $model->files()->sync($ids);
            });
        }
    }
}