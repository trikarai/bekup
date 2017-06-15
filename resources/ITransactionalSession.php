<?php

namespace Resources;

interface ITransactionalSession {

    /**
     * @param callable $operation
     * @return mixed
     */
    function executeAtomically(callable $operation);
}
