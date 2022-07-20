<?php

namespace App\Repositories\Admin;

use App\Models\Banner;

class BannerRepository extends BaseAdminRepository
{
    protected $model = Banner::class;

    public function getLastPosition()
    {
        return $this->getModel()->max('position') + 1;
    }
}
