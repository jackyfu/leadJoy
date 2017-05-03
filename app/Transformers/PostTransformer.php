<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Post;

/**
 * Class PostTransformer
 * @package namespace App\Transformers;
 */
class PostTransformer extends TransformerAbstract
{

    /**
     * Transform the \Post entity
     * @param \Post $model
     *
     * @return array
     */
    public function transform(Post $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
