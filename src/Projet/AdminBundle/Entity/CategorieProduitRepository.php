<?php

namespace Projet\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * CategorieProduitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategorieProduitRepository extends EntityRepository
{
    public function getNb() {

        return $this->createQueryBuilder('l')
            ->select('COUNT(l)')
            ->getQuery()
            ->getSingleScalarResult();

    }
    public function getNbLimit($libelle) {

        return $this->createQueryBuilder('l')
            ->select('COUNT(l)')
            ->add("where","l.libelle like '%".$libelle."%'")
            ->getQuery()
            ->getSingleScalarResult();

    }
    public function getList($page=1, $maxperpage=5)
    {
        $q = $this->_em->createQueryBuilder()
            ->select('CategorieProduit')
            ->from('ProjetAdminBundle:CategorieProduit','CategorieProduit');

        $q->setFirstResult(($page-1) * $maxperpage)
            ->setMaxResults($maxperpage);

        return new Paginator($q);
    }
    
    
    
    
    
    
    public function getListAjax($page,$maxperpage=5,$libelle)
    {
        $q = $this->_em->createQueryBuilder()
            ->select('CategorieProduit')
            ->from('ProjetAdminBundle:CategorieProduit','CategorieProduit')
            ->add("where","CategorieProduit.libelle like '%".$libelle."%'");

        $q->setFirstResult(($page-1) * $maxperpage)
            ->setMaxResults($maxperpage);

        return new Paginator($q);
    }
}
