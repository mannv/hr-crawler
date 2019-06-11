<?php

namespace App\Repositories;

use App\Presenters\CompanyPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Company;
use App\Validators\CompanyValidator;

/**
 * Class CompanyRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CompanyRepositoryEloquent extends BaseRepository implements CompanyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Company::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return CompanyValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->setPresenter(app(CompanyPresenter::class));
    }

    public function createCompany($attributes = [])
    {
        return $this->create($attributes);
    }

    public function needCrawler()
    {
        return $this->findWhere(['is_crawler' => false]);
    }
}
