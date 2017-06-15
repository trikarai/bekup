<?php

namespace Personnel\ApplicationService\Personnel;

use Personnel\DomainModel\Personnel\Personnel;
use Personnel\DomainModel\Personnel\ValueObject\PersonnelPassword;
use Personnel\DomainModel\Personnel\DataObject\PersonnelWriteDataObject;

class AddDirectorService extends AddPersonnelServiceAbstract{

    protected function _addPersonnelToRepository(PersonnelWriteDataObject $request) {
        $id = $this->repository->nextIdentity();
        $password = PersonnelPassword::fromNative($request->getPassword());
        $personnel = Personnel::createDirector($id, $request, $password);
        $this->repository->add($personnel);
        return true;
    }

}
