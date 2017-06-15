<?php

namespace Superclass\Infrastructure\DomainModelRepository\Talent;

use Doctrine\ORM\EntityRepository;
use Superclass\DomainModel\Talent\ITalentRdoRepository;

class DoctrineTalentRdoRepository extends EntityRepository implements ITalentRdoRepository{

    public function all() {
        return $this->findAll();
    }

    public function ofCity($cityId) {
        $criteria = array(
            'cityId' => $cityId
        );
        return $this->findBy($criteria);
    }

    public function ofId($id) {
        $criteria = array(
            'id' => $id
        );
        return $this->findOneBy($criteria);
    }
}
