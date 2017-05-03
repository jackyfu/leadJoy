<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Recomment;

/**
 * Class RecommentTransformer
 * @package namespace App\Transformers;
 */
class RecommentTransformer extends TransformerAbstract
{

    /**
     * Transform the \Recomment entity
     * @param \Recomment $model
     *
     * @return array
     */
    public function transform(Recomment $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
