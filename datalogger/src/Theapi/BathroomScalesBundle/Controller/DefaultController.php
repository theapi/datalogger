<?php

namespace Theapi\BathroomScalesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TheapiBathroomScalesBundle:Default:index.html.twig');
    }
}
