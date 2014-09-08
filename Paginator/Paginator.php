<?php

namespace Jmardz\PaginatorBundle\Paginator;

use Doctrine\ORM\Query;

class Paginator {
    
    protected $itemsPerPage;
    
    protected $maxPage;
    
    protected $minPage;
    
    protected $currentPage;
    
    protected $lastPage;
    
    public function paginate($page, Query $query, $itemsPerPage = 10)
    {   
        if(!is_numeric($page))
        {
            throw new \Exception('Valor no numerico para la paginacion');
        }
        
        $this->currentPage = (int)$page;      
        $this->itemsPerPage = $itemsPerPage;
        
        $this->calLastPage(count($query->getResult()));
        $this->calRange();
        
        $query->setFirstResult($this->offset())
              ->setMaxResults($this->itemsPerPage);    
        
        return $query->getResult();
    }
    
    public function setItemsPerPage($itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;
    }
    
    public function getCurrentPage()
    {
        return $this->currentPage;
    }
    
    public function getLastPage()
    {
        return $this->lastPage;
    }
    
    public function getMinPage()
    {
        return $this->minPage;
    }
    
    public function getMaxPage()
    {
        return $this->maxPage;
    }
    
    private function calRange($range = 5)
    {
        if(($this->currentPage-$range) < 1)
        {
            $this->minPage = 1;
            $this->maxPage = $range;
            
            if($range > $this->lastPage)
            {
                $this->maxPage = $this->lastPage;                
            }           
        }
        else if(($this->currentPage+$range) > $this->lastPage)
        {
            $this->minPage = $this->lastPage - ($range-1);
            $this->maxPage = $this->lastPage;
        }
        else{        
            if(($range%2) != 0)
            {
                $range = round(($range/2),0,PHP_ROUND_HALF_DOWN);                
                $min = $this->currentPage - $range;
                $max = $this->currentPage + $range;
            }else{
                $range = ($range/2);
                $min = ($this->currentPage - $range) + 1;
                $max = ($this->currentPage + $range);
            }
            
            $this->minPage = $min;
            $this->maxPage = $max;            
        }
    }
    
    /*
     * Calcula el numero de la ultima pagina
     */
    private function calLastPage($cantResult)
    {
        $this->lastPage = (int)ceil($cantResult/$this->itemsPerPage);
    }
    
    /*
     *  Desplazamiento de la paginacion.
     */
    private function offset()
    {
        return intval(($this->currentPage-1)*$this->itemsPerPage);
    }    
    
}
