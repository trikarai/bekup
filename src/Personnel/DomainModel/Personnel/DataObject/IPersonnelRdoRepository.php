<?php

namespace Personnel\DomainModel\Personnel\DataObject;

interface IPersonnelRdoRepository {
    /**
     * @param type $id
     * @return PersonnelReadDataObject
     */
    function ofId($id);
    
    /**
     * @return PersonnelReadDataObject
     */
    function all();
}
