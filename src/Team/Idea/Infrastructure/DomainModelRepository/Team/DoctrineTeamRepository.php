<?php

namespace Team\Idea\Infrastructure\DomainModelRepository\Team;

use Team\Idea\DomainModel\Team\ITeamRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineTeamRepository extends EntityRepository implements ITeamRepository{
    
//    public function ofTalentId($talentId) {
//        $qb = $this->getEntityManager()->createQueryBuilder();
//        $qb->select('team')
//                ->from('\Team\Idea\DomainModel\Team\Team', 'team')
//                ->leftJoin('team.member', 'm')
//                ->leftJoin('m.talentRDO', 'trdo')
//                ->where($qb->expr()->andX(
//                        $qb->expr()->eq('m.status.status', "'active'"),
//                        $qb->expr()->eq('trdo.id', "'$talentId'")
//                ));
//        try{
//            return $qb->getQuery()->getSingleResult();
//        }  catch (\Doctrine\ORM\NoResultException $e){
//            return null;
//        }
//    }

    public function update() {
        $em = $this->getEntityManager();
        $em->flush();
        $em->clear();
    }

    public function ofId($teamId) {
        $criteria = array(
            'id' => $teamId,
        );
        return $this->findOneBy($criteria);
    }

}