<?php

namespace Site\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class FrontendMenuBuilder extends ContainerAware
{
    public function menu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $em = $this->container->get('doctrine.orm.entity_manager');
        $repository = $em->getRepository('SiteMainBundle:Menu');
        $secondmenu = $repository->findAll();
        $menu->addChild('home', array(
            'route' => 'Site_main_homepage'
        ));
        foreach ($secondmenu as $key => $s) {
            $menu->addChild($s->getTitle(), array(
                'route' => 'Site_main_page',
                'routeParameters' => array('slug' => $s->getSlug())
            ));
        }
        $menu->addChild("");
        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        return $menu;
    }
}