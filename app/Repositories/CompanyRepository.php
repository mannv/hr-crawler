<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CompanyRepository.
 *
 * @package namespace App\Repositories;
 */
interface CompanyRepository extends RepositoryInterface
{
    public function createCompany($attributes = []);

    public function needCrawler();
}
