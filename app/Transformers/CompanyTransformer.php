<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Company;

/**
 * Class CompanyTransformer.
 *
 * @package namespace App\Transformers;
 */
class CompanyTransformer extends TransformerAbstract
{
    /**
     * Transform the Company entity.
     *
     * @param \App\Entities\Company $model
     *
     * @return array
     */
    public function transform(Company $model)
    {
        $attributes = $model->toArray();
        $attributes['base_url'] = $attributes['source'] . $attributes['base_url'];
        return $attributes;
    }
}
