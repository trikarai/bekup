<?php

namespace Team\Profile\Infrastructure\DomainModelRepository\Team;

use Team\Profile\DomainModel\Team\ITeamRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineTeamRepository extends EntityRepository implements ITeamRepository{
    public function all() {
        return $this->findAll();
    }

    public function allWithinCityId($cityId) {
        $criteria = array(
            'cityRDO.id' => $cityId
        );
        return $this->findBy($criteria);
    }

    public function nextIdentity() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }
/*
    public function ofTalentId($talentId) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('team')
                ->from('\Team\Profile\DomainModel\Team\Team', 'team')
                ->leftJoin('team.members', 'm')
                ->leftJoin('m.talent', 'tln')
                ->where($qb->expr()->andX(
                        $qb->expr()->eq('m.status', "'active'"),
                        $qb->expr()->eq('tln.id', "'$talentId'")
                ));
        try{
            return $qb->getQuery()->getSingleResult();
        }  catch (\Doctrine\ORM\NoResultException $e){
            return null;
        }
    }
 * 
 */

    public function ofId($id) {
        $criteria = array(
            'id' => $id
        );
        return $this->findOneBy($criteria);
    }

    public function ofNameWithinCityId($name, $cityId) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('tm')
                ->from('\Team\Profile\DomainModel\Team\Team', 'tm')
                ->leftJoin('tm.cityRDO', 'cityRdo')
                ->where($qb->expr()->andX(
                        $qb->expr()->eq('tm.name', "'{$name}'"),
                        $qb->expr()->eq('cityRdo.id', "'{$cityId}'")
                ));
        try{
            return $qb->getQuery()->getSingleResult();
        }catch(\Doctrine\ORM\NoResultException $e){
            return null;
        }
    }

    public function update() {
        $em = $this->getEntityManager();
        $em->flush();
        $em->clear();
    }
}
