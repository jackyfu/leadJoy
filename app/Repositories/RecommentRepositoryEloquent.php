<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RecommentRepository;
use App\Entities\Recomment;
use App\Validators\RecommentValidator;

/**
 * Class RecommentRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RecommentRepositoryEloquent extends BaseRepository implements RecommentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Recomment::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RecommentValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
