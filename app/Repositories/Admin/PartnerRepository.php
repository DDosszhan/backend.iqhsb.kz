<?php

namespace App\Repositories\Admin;

use App\Models\Partner;

class PartnerRepository extends BaseAdminRepository
{
    protected $model = Partner::class;

    public function getLastPosition()
    {
        return $this->getModel()->max('position') + 1;
    }
}
