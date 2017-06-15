<?php

namespace Resources\Doctrine;

use Doctrine\ORM\EntityManager;
use Resources\ITransactionalSession;

class DoctrineTransactionalSession implements ITransactionalSession{
    protected $em;
    
    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    public function executeAtomically(callable $operation) {
        return $this->em->transactional($operation);
    }

}
