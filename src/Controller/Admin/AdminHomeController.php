<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminHomeController extends AdminBaseController
{
    #[Route('admin', name: 'admin_home')]
    public function index()
    {
        $forRender = parent::renderDefault();
        return $this->render('admin/index.html.twig', $forRender);
    }
}
