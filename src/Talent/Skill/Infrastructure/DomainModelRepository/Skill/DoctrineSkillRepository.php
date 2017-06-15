<?php

namespace Talent\Skill\Infrastructure\DomainModelRepository\Skill;

use Talent\Skill\DomainModel\Skill\ISkillRepository;
use Doctrine\ORM\EntityRepository;
use Talent\Skill\DomainModel\Skill\Skill;

class DoctrineSkillRepository extends EntityRepository implements ISkillRepository{
    public function add(Skill $skill) {
        $em = $this->getEntityManager();
        $em->persist($skill);
        $em->flush();
        $em->clear();
    }

    public function all() {
        $criteria = array(
            'isRemoved' => false
        );
        return $this->findBy($criteria);
    }

    public function nextIdentity() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function ofId($id) {
        $criteria = array(
            'isRemoved' => false,
            'id' => $id
        );
        return $this->findOneBy($criteria);
    }

    public function ofName($name) {
        $criteria = array(
            'isRemoved' => false,
            'name' => $name
        );
        return $this->findOneBy($criteria);
    }

    public function update() {
        $em = $this->getEntityManager();
        $em->flush();
//        $em->clear();
    }

}
