<?php

namespace Jmardz\PaginatorBundle\Helper;

use Symfony\Component\DependencyInjection\ContainerInterface;

class PaginatorHelper {
    
    protected $container;
    
    public function __construct(ContainerInterface $container) 
    {
        $this->container = $container;
    }
    
    protected function getPaginator()
    {
        return $this->container->get('jmardz.paginator');
    }
    
    public function render($view = null,$options = array())
    {
        $pg = $this->getPaginator();
        
        $defaultOptions = array(
            'currentPage'               => $pg->getCurrentPage(),
            'maxPage'                   => $pg->getMaxPage(),
            'minPage'                   => $pg->getMinPage(),
            'lastPage'                  => $pg->getLastPage(),
            'prevText'                  => '«',
            'nextText'                  => '»',
            'firstText'                 => 'Primero',
            'lastText'                  => 'Ultimo',
            'paginatorContentClass'     => null,
            'firstEnabledClass'         => null,
            'firstDesabledClass'        => null,
            'lastEnabledClass'          => null,
            'lastDesabledClass'         => null,
            'prevEnabledClass'          => null,
            'prevDiabledClass'          => null,
            'nextEnabledClass'          => null,
            'nextDisabledClass'         => null,
            'currentPageClass'          => null
        );
        
        $view = (!is_null($view)) ? $view : 'PaginatorBundle:Paginator:paginator-view-twitter-boostrap.html.twig';
        $options = array_merge($defaultOptions,$options);
        
        return $this->container->get('templating')->render($view,$options);
    }
    
}
