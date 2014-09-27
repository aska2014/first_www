<?php namespace Aska;

use App;

class BaseModel extends \Illuminate\Database\Eloquent\Model {

    /**
     * @param BaseModel $model
     * @return bool
     */
    public function same($model)
    {
        return $model->getClass() == $this->getClass() && $model->id == $this->id;
    }

    /**
     * Get language
     */
    protected function getAppLanguage()
    {
        return App::make('Aska\Language')->get();
    }

    /**
     * @param $attribute
     * @return mixed
     */
    protected function getLanguageAttribute($attribute)
    {
        return $this->attributes[$this->getAppLanguage().'_'.$attribute];
    }

    /**
     * Get current class name
     * Used in relations instead of writing the whole path name.
     */
    public static function getClass()
    {
        return get_called_class();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Relations\HasMany $relation
     * @param array $inputs
     * @return void
     */
    protected function syncMany(\Illuminate\Database\Eloquent\Relations\HasMany $relation, array $inputs)
    {

        $ids = [];

        foreach($inputs as $input)
        {
            if(isset($input['id'])) {
                // Get related by id
                $related = $relation->getRelated()->find($input['id']);

                // Update related if exists
                if($related) $related->update($input);

                // If it doesn't exist unset id to be created
                else unset($input['id']);
            }

            if(!isset($input['id'])) {

                // Create related
                $related = $relation->create($input);
            }

            if($related && $related->exists) array_push($ids, $related->id);
        }

        // Delete all stages attached to this project
        if(empty($ids)) $relation->delete();

        // Delete other relations that are not connected to this model
        else $relation->whereNotIn('id', $ids)->delete();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Relations\BelongsToMany $relation
     * @param array $inputs
     */
    protected function syncManyToMany(\Illuminate\Database\Eloquent\Relations\BelongsToMany $relation, array $inputs)
    {
        $ids = [];

        // Extract ids from inputs
        foreach($inputs as $input)
        {
            if(isset($input['id'])) array_push($ids, $input['id']);
        }

        $relation->sync($ids);
    }
}