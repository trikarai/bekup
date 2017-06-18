<?php

namespace Team\Idea\Infrastructure\DomainModelRepository\Talent;

use Doctrine\ORM\EntityRepository;
use Team\Idea\DomainModel\Talent\ITalentQueryRepository;

class DoctrineTalentQueryRepository extends EntityRepository implements ITalentQueryRepository{
    public function ofId($id) {
        $criteria = array(
            'id' => $id,
        );
        return $this->findOneBy($criteria);
    }
}
