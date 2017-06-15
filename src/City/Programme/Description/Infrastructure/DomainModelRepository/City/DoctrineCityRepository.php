<?php

namespace City\Programme\Description\Infrastructure\DomainModelRepository\City;

use Doctrine\ORM\EntityRepository;
use City\Programme\Description\DomainModel\City\ICityRepository;

class DoctrineCityRepository extends EntityRepository implements ICityRepository{
    public function all() {
        $criteria = array(
            'isRemoved' => false,
        );
        return $this->findBy($criteria);
    }

    public function ofId($id) {
        $criteria = array(
            'id' => $id,
            'isRemoved' => false,
        );
        return $this->findOneBy($criteria);
    }

    public function update() {
        $em = $this->getEntityManager();
        $em->flush();
        $em->clear();
    }

}
