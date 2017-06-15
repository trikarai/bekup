<?php

namespace City\Programme\Description\Infrastructure\DomainModelRepository\City;

use Doctrine\ORM\EntityRepository;
use City\Programme\Description\DomainModel\City\ICityQueryRepository;

class DoctrineCityQueryRepository extends EntityRepository implements ICityQueryRepository{
    public function ofId($id) {
        $criteria = array(
            'id' => $id,
            'isRemoved' => false,
        );
        return $this->findOneBy($criteria);
    }
}
