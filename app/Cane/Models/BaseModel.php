<?php namespace Cane\Models;

class BaseModel extends \Illuminate\Database\Eloquent\Model {

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