<?php

namespace Personnel\Infrastructure\DomainModelRepository\Personnel;

use Doctrine\ORM\EntityRepository;
use Personnel\DomainModel\Personnel\DataObject\IPersonnelRdoRepository;

class DoctrinePersonnelRdoRepository extends EntityRepository implements IPersonnelRdoRepository{
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
