<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBaseController extends AbstractController
{
    public function renderDefault()
    {
        return [
            'title' => 'Значение по умолчанию для админки',
        ];
    }
}
