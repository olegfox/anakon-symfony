<?php

namespace Site\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class PageController extends Controller
{

    public function indexAction($slug)
    {
        $page = $this->getDoctrine()
            ->getRepository('SiteMainBundle:Menu')->findOneBySlug($slug);
        $params = array(
            "page" => $page
        );
        return $this->render('SiteMainBundle:Page:index.html.twig', $params);

    }
}
