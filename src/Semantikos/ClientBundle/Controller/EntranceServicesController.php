<?php

namespace Semantikos\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EntranceServicesController extends Controller
{
    public function indexAction()
    {
        return $this->render('SemantikosClientBundle:Default:index.html.twig');
    }
}
