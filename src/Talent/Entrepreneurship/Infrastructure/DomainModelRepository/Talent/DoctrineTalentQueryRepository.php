<?php

namespace Talent\Entrepreneurship\Infrastructure\DomainModelRepository\Talent;

use Talent\Entrepreneurship\DomainModel\Talent\ITalentQueryRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineTalentQueryRepository extends EntityRepository implements ITalentQueryRepository {
    public function ofId($id) {
        $criteria = array(
            'id' => $id,
        );
        return $this->findOneBy($criteria);
    }
}
