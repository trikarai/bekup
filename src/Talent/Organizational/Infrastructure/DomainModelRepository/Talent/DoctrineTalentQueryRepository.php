<?php

namespace Talent\Organizational\Infrastructure\DomainModelRepository\Talent;

use Doctrine\ORM\EntityRepository;
use Talent\Organizational\DomainModel\Talent\ITalentQueryRepository;

class DoctrineTalentQueryRepository extends EntityRepository implements ITalentQueryRepository{
    public function ofId($id) {
        $criteria = array(
            'id' => $id,
        );
        return $this->findOneBy($criteria);
    }

//put your code here
}
