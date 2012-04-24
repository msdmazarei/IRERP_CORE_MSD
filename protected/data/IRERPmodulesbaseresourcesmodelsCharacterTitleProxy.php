<?php

namespace Proxy;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class IRERPmodulesbaseresourcesmodelsCharacterTitleProxy extends \IRERP\modules\baseresources\models\CharacterTitle implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }
    
    
    public function getTitle()
    {
        $this->__load();
        return parent::getTitle();
    }

    public function setTitle($v)
    {
        $this->__load();
        return parent::setTitle($v);
    }

    public function setDescription($v)
    {
        $this->__load();
        return parent::setDescription($v);
    }

    public function DoctrineLoad()
    {
        $this->__load();
        return parent::DoctrineLoad();
    }

    public function GetGeneralConfiguration()
    {
        $this->__load();
        return parent::GetGeneralConfiguration();
    }

    public function AddSaveValidation($ValidationID, $ValidationFunction)
    {
        $this->__load();
        return parent::AddSaveValidation($ValidationID, $ValidationFunction);
    }

    public function RemoveSaveValidation($ValidationID)
    {
        $this->__load();
        return parent::RemoveSaveValidation($ValidationID);
    }

    public function AddDeleteValidation($ValidationID, $ValidationFunction)
    {
        $this->__load();
        return parent::AddDeleteValidation($ValidationID, $ValidationFunction);
    }

    public function RemoveDeleteValidation($ValidationID)
    {
        $this->__load();
        return parent::RemoveDeleteValidation($ValidationID);
    }

    public function AddAddToMemberValidation($ValidationID, $ValidationFunction)
    {
        $this->__load();
        return parent::AddAddToMemberValidation($ValidationID, $ValidationFunction);
    }

    public function RemoveAddToMemberValidation($ValidationID)
    {
        $this->__load();
        return parent::RemoveAddToMemberValidation($ValidationID);
    }

    public function AddRemoveFromMemberValidation($ValidationID, $ValidationFunction)
    {
        $this->__load();
        return parent::AddRemoveFromMemberValidation($ValidationID, $ValidationFunction);
    }

    public function RemoveRemoveFromMemberValidation($ValidationID)
    {
        $this->__load();
        return parent::RemoveRemoveFromMemberValidation($ValidationID);
    }

    public function setHelpField($v)
    {
        $this->__load();
        return parent::setHelpField($v);
    }

    public function getHelpField()
    {
        $this->__load();
        return parent::getHelpField();
    }

    public function AddToMember($MemberName, \IRERP\Basics\Models\IRDataModel $Value)
    {
        $this->__load();
        return parent::AddToMember($MemberName, $Value);
    }

    public function AddToMemberENUM($MemberName, $Value)
    {
        $this->__load();
        return parent::AddToMemberENUM($MemberName, $Value);
    }

    public function RemoveFromMember_ENUM($MemberName, $Value)
    {
        $this->__load();
        return parent::RemoveFromMember_ENUM($MemberName, $Value);
    }

    public function RemoveFromMember_Complete($MemberName, \IRERP\Basics\Models\IRDataModel $Value)
    {
        $this->__load();
        return parent::RemoveFromMember_Complete($MemberName, $Value);
    }

    public function CopyProps($src)
    {
        $this->__load();
        return parent::CopyProps($src);
    }

    public function setEntityManager(&$value = NULL)
    {
        $this->__load();
        return parent::setEntityManager($value);
    }

    public function &getEntityManager()
    {
        $this->__load();
        return parent::getEntityManager();
    }

    public function getid()
    {
        $this->__load();
        return parent::getid();
    }

    public function setid($v)
    {
        $this->__load();
        return parent::setid($v);
    }

    public function getVersion()
    {
        $this->__load();
        return parent::getVersion();
    }

    public function getCreatorUserID()
    {
        $this->__load();
        return parent::getCreatorUserID();
    }

    public function setCreatorUserID($uid)
    {
        $this->__load();
        return parent::setCreatorUserID($uid);
    }

    public function getModifierUserID()
    {
        $this->__load();
        return parent::getModifierUserID();
    }

    public function setModifierUserID($uid)
    {
        $this->__load();
        return parent::setModifierUserID($uid);
    }

    public function getCreateDate()
    {
        $this->__load();
        return parent::getCreateDate();
    }

    public function setCreateDate($d)
    {
        $this->__load();
        return parent::setCreateDate($d);
    }

    public function getdateLastModified()
    {
        $this->__load();
        return parent::getdateLastModified();
    }

    public function setdateLastModified($d)
    {
        $this->__load();
        return parent::setdateLastModified($d);
    }

    public function getIsDeleted()
    {
        $this->__load();
        return parent::getIsDeleted();
    }

    public function setIsDeleted($d)
    {
        $this->__load();
        return parent::setIsDeleted($d);
    }

    public function CreateClassFrom_SentData_By_Client($functionName, \IRERP\Basics\Descriptors\DataSource $DS, array $ExceptParams = NULL)
    {
        $this->__load();
        return parent::CreateClassFrom_SentData_By_Client($functionName, $DS, $ExceptParams);
    }

    public function CreateClassFromScUsingMethod($functionName, $ExceptedProperties = NULL, $ValueArray = NULL)
    {
        $this->__load();
        return parent::CreateClassFromScUsingMethod($functionName, $ExceptedProperties, $ValueArray);
    }

    public function GetByID($id)
    {
        $this->__load();
        return parent::GetByID($id);
    }

    public function CheckValidationFor($OperationType, $Args = array (
))
    {
        $this->__load();
        return parent::CheckValidationFor($OperationType, $Args);
    }

    public function Save()
    {
        $this->__load();
        return parent::Save();
    }

    public function GetClassSCPropertiesInArray_Advance(\IRERP\Basics\Descriptors\DataSource $DS)
    {
        $this->__load();
        return parent::GetClassSCPropertiesInArray_Advance($DS);
    }

    public function GetClassSCPropertiesInArray($ExceptedProperties = NULL)
    {
        $this->__load();
        return parent::GetClassSCPropertiesInArray($ExceptedProperties);
    }

    public function GetClassPropertiesinArray($ExceptedProperties)
    {
        $this->__load();
        return parent::GetClassPropertiesinArray($ExceptedProperties);
    }

    public function GetClassArray()
    {
        $this->__load();
        return parent::GetClassArray();
    }

    public function findAll($parameters)
    {
        $this->__load();
        return parent::findAll($parameters);
    }

    public function fetchObjects($startRow = 0, $endRow = 100, $whstr = '', $whparam = NULL, $orderby = array (
), \IRERP\Basics\JoinTb $joinedTable = NULL)
    {
        $this->__load();
        return parent::fetchObjects($startRow, $endRow, $whstr, $whparam, $orderby, $joinedTable);
    }

    public function attributeNames()
    {
        $this->__load();
        return parent::attributeNames();
    }

    public function rules()
    {
        $this->__load();
        return parent::rules();
    }

    public function behaviors()
    {
        $this->__load();
        return parent::behaviors();
    }

    public function attributeLabels()
    {
        $this->__load();
        return parent::attributeLabels();
    }

    public function validate($attributes = NULL, $clearErrors = true)
    {
        $this->__load();
        return parent::validate($attributes, $clearErrors);
    }

    public function onAfterConstruct($event)
    {
        $this->__load();
        return parent::onAfterConstruct($event);
    }

    public function onBeforeValidate($event)
    {
        $this->__load();
        return parent::onBeforeValidate($event);
    }

    public function onAfterValidate($event)
    {
        $this->__load();
        return parent::onAfterValidate($event);
    }

    public function getValidatorList()
    {
        $this->__load();
        return parent::getValidatorList();
    }

    public function getValidators($attribute = NULL)
    {
        $this->__load();
        return parent::getValidators($attribute);
    }

    public function createValidators()
    {
        $this->__load();
        return parent::createValidators();
    }

    public function isAttributeRequired($attribute)
    {
        $this->__load();
        return parent::isAttributeRequired($attribute);
    }

    public function isAttributeSafe($attribute)
    {
        $this->__load();
        return parent::isAttributeSafe($attribute);
    }

    public function getAttributeLabel($attribute)
    {
        $this->__load();
        return parent::getAttributeLabel($attribute);
    }

    public function hasErrors($attribute = NULL)
    {
        $this->__load();
        return parent::hasErrors($attribute);
    }

    public function getErrors($attribute = NULL)
    {
        $this->__load();
        return parent::getErrors($attribute);
    }

    public function getError($attribute)
    {
        $this->__load();
        return parent::getError($attribute);
    }

    public function addError($attribute, $error)
    {
        $this->__load();
        return parent::addError($attribute, $error);
    }

    public function addErrors($errors)
    {
        $this->__load();
        return parent::addErrors($errors);
    }

    public function clearErrors($attribute = NULL)
    {
        $this->__load();
        return parent::clearErrors($attribute);
    }

    public function generateAttributeLabel($name)
    {
        $this->__load();
        return parent::generateAttributeLabel($name);
    }

    public function getAttributes($names = NULL)
    {
        $this->__load();
        return parent::getAttributes($names);
    }

    public function setAttributes($values, $safeOnly = true)
    {
        $this->__load();
        return parent::setAttributes($values, $safeOnly);
    }

    public function unsetAttributes($names = NULL)
    {
        $this->__load();
        return parent::unsetAttributes($names);
    }

    public function onUnsafeAttribute($name, $value)
    {
        $this->__load();
        return parent::onUnsafeAttribute($name, $value);
    }

    public function getScenario()
    {
        $this->__load();
        return parent::getScenario();
    }

    public function setScenario($value)
    {
        $this->__load();
        return parent::setScenario($value);
    }

    public function getSafeAttributeNames()
    {
        $this->__load();
        return parent::getSafeAttributeNames();
    }

    public function getIterator()
    {
        $this->__load();
        return parent::getIterator();
    }

    public function offsetExists($offset)
    {
        $this->__load();
        return parent::offsetExists($offset);
    }

    public function offsetGet($offset)
    {
        $this->__load();
        return parent::offsetGet($offset);
    }

    public function offsetSet($offset, $item)
    {
        $this->__load();
        return parent::offsetSet($offset, $item);
    }

    public function offsetUnset($offset)
    {
        $this->__load();
        return parent::offsetUnset($offset);
    }

    public function __get($name)
    {
        $this->__load();
        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        $this->__load();
        return parent::__set($name, $value);
    }

    public function __isset($name)
    {
        $this->__load();
        return parent::__isset($name);
    }

    public function __unset($name)
    {
        $this->__load();
        return parent::__unset($name);
    }

    public function __call($name, $parameters)
    {
        $this->__load();
        return parent::__call($name, $parameters);
    }

    public function asa($behavior)
    {
        $this->__load();
        return parent::asa($behavior);
    }

    public function attachBehaviors($behaviors)
    {
        $this->__load();
        return parent::attachBehaviors($behaviors);
    }

    public function detachBehaviors()
    {
        $this->__load();
        return parent::detachBehaviors();
    }

    public function attachBehavior($name, $behavior)
    {
        $this->__load();
        return parent::attachBehavior($name, $behavior);
    }

    public function detachBehavior($name)
    {
        $this->__load();
        return parent::detachBehavior($name);
    }

    public function enableBehaviors()
    {
        $this->__load();
        return parent::enableBehaviors();
    }

    public function disableBehaviors()
    {
        $this->__load();
        return parent::disableBehaviors();
    }

    public function enableBehavior($name)
    {
        $this->__load();
        return parent::enableBehavior($name);
    }

    public function disableBehavior($name)
    {
        $this->__load();
        return parent::disableBehavior($name);
    }

    public function hasProperty($name)
    {
        $this->__load();
        return parent::hasProperty($name);
    }

    public function canGetProperty($name)
    {
        $this->__load();
        return parent::canGetProperty($name);
    }

    public function canSetProperty($name)
    {
        $this->__load();
        return parent::canSetProperty($name);
    }

    public function hasEvent($name)
    {
        $this->__load();
        return parent::hasEvent($name);
    }

    public function hasEventHandler($name)
    {
        $this->__load();
        return parent::hasEventHandler($name);
    }

    public function getEventHandlers($name)
    {
        $this->__load();
        return parent::getEventHandlers($name);
    }

    public function attachEventHandler($name, $handler)
    {
        $this->__load();
        return parent::attachEventHandler($name, $handler);
    }

    public function detachEventHandler($name, $handler)
    {
        $this->__load();
        return parent::detachEventHandler($name, $handler);
    }

    public function raiseEvent($name, $event)
    {
        $this->__load();
        return parent::raiseEvent($name, $event);
    }

    public function evaluateExpression($_expression_, $_data_ = array (
))
    {
        $this->__load();
        return parent::evaluateExpression($_expression_, $_data_);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'Title', 'Description', 'id', 'version', 'dateCreated', 'dateLastModified', 'IsDeleted', 'creatorUserId', 'modifierUserId', 'UseForCharTypes');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}