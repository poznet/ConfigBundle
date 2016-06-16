<?php
/**
 * Created by PhpStorm.
 * User: joseph
 * Date: 5/27/16
 * Time: 9:16 AM
 */

namespace Poznet\ConfigBundle\Service;


use ConfigBundle\Entity\Config;
use Doctrine\ORM\EntityManager;

/**
 * Klasa  zarządzająca konfiguracją
 * Class ConfigService
 * @package ConfigBundle\Service
 */
class ConfigService
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em=$em;
    }


    /**
     * Gets  config  value
     * @param $name
     * @return null
     */
    public function get($name){
        $config=$this->em->getRepository("PoznetConfigBundle:Config")->findOneByName($name);
        if(!$config)
            return null;
        return $config->getValue();
    }

    /**
     * Sets config value
     * @param $name
     * @param $value
     * @return bool
     */
    public function set($name,$value){
        $config=$this->em->getRepository("PoznetConfigBundle:Config")->findOneByName($name);
        if(!$config) {
            $config = new Config();
            $config->setName($name);
            $config->setValue($value);
            $this->em->persist($config);

        }else{
            $config->setName($name);
            $config->setValue($value);
        }
        $this->em->flush();
        return true;
    }


}
