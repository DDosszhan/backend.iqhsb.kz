<?php

namespace App\Exceptions;

use Exception;
use StarterKit\Core\Http\Utils\ResponseBuilder;
use StarterKit\Core\Ui\Attributes\Modal;

class ItemNotFoundException extends Exception
{
    public function render()
    {
        $response = new ResponseBuilder();
        $response->showAlert('Ошибка!', 'Элемент не найден');
        $response->closeModal(Modal::LARGE);
        return $response->makeJson();
    }
}
