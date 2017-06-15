<?php

namespace Superclass\Infrastructure\DomainModelRepository\City;

use Doctrine\ORM\EntityRepository;
use Superclass\DomainModel\City\ICityRdoRepository;

class DoctrineCityRdoRepository extends EntityRepository implements ICityQueryRepository{
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

}
