<?php

namespace App\Repositories\Admin;

use App\Models\Faq;

class FaqRepository extends BaseAdminRepository
{
    protected $model = Faq::class;

    public function getLastPosition()
    {
        return $this->getModel()->max('position') + 1;
    }
}
