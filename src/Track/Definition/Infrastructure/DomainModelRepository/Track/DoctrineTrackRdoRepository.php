<?php

namespace Track\Definition\Infrastructure\DomainModelRepository\Track;

use Track\Definition\DomainModel\Track\ITrackRdoRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineTrackRdoRepository extends EntityRepository implements ITrackRdoRepository{
    public function all() {
        $criteria = array(
            'isRemoved' => false,
        );
        return $this->findBy($criteria);
    }

    public function ofId($id) {
        $criteria = array(
            'isRemoved' => false,
            'id' => $id
        );
        return $this->findOneBy($criteria);
    }

//put your code here
}
