<?php

namespace App\Presenters;

use App\Transformers\RecommentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RecommentPresenter
 *
 * @package namespace App\Presenters;
 */
class RecommentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RecommentTransformer();
    }
}
