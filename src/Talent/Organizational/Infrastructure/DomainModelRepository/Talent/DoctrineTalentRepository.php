<?php

namespace Talent\Organizational\Infrastructure\DomainModelRepository\Talent;

use Doctrine\ORM\EntityRepository;
use Talent\Organizational\DomainModel\Talent\ITalentRepository;

class DoctrineTalentRepository extends EntityRepository implements ITalentRepository{
    public function ofId($id) {
        $criteria = array(
            'id' => $id,
        );
        return $this->findOneBy($criteria);
    }

    public function update() {
        $em = $this->getEntityManager();
        $em->flush();
        $em->clear();
    }

//put your code here
}
