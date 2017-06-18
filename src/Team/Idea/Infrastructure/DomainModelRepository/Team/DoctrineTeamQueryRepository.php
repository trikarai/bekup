<?php

namespace Team\Idea\Infrastructure\DomainModelRepository\Team;

use Doctrine\ORM\EntityRepository;
use Team\Idea\DomainModel\Team\ITeamQueryRepository;

class DoctrineTeamQueryRepository extends EntityRepository implements ITeamQueryRepository{
    public function ofId($id) {
        $criteria = array(
            'id' => $id
        );
        return $this->findOneBy($criteria);
    }
}
