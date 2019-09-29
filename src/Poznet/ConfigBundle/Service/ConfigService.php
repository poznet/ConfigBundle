<?php
/**
 * Created by PhpStorm.
 * User: joseph
 * Date: 5/27/16
 * Time: 9:16 AM
 */

namespace Poznet\ConfigBundle\Service;


use Doctrine\Common\Cache\CacheProvider;
use Poznet\ConfigBundle\Entity\Config;
use Doctrine\ORM\EntityManager;

/**
 * Klasa  zarządzająca konfiguracją
 * Class ConfigService
 * @package ConfigBundle\Service
 */
class ConfigService
{

    private $em;
    private $cache;

    public function __construct(EntityManager $em, CacheProvider $cache)
    {
        $this->em = $em;
        $this->cache = $cache;
    }


    /**
     * Gets  config  value
     * @param $name
     * @return null
     */
    public function get($name)
    {
        if ($this->cache->contains($name))
            return $this->cache->fetch($name);

        $config = $this->em->getRepository("ConfigBundle:Config")->findOneByName($name);
        if (!$config)
            return null;
        $this->cache->save($name, $config->getValue(), 3600);
        return $config->getValue();
    }

    /**
     * gets config  for name and for
     * @param $name
     * @param $for
     * @return null
     */
    public function getFor($name, $for)
    {
        if ($this->cache->contains($name))
            return $this->cache->fetch($name);

        $config = $this->em->getRepository("ConfigBundle:Config")->findOneByN(['name' => $name, 'for' => $for]);
        if (!$config)
            return null;
        $this->cache->save($name, $config->getValue(), 3600);
        return $config->getValue();
    }

    /**
     * Sets config value
     * @param $name
     * @param $value
     * @return bool
     */
    public function set($name, $value)
    {
        $config = $this->em->getRepository("ConfigBundle:Config")->findOneByName($name);
        if (!$config) {
            $config = new Config();
            $config->setName($name);
            $config->setValue($value);
            $this->em->persist($config);

        } else {
            $config->setName($name);
            $config->setValue($value);
        }
        $this->em->flush();
        return true;
    }

    public function setFor($name, $for, $value)
    {
        $config = $this->em->getRepository("ConfigBundle:Config")->findOneByName($name);
        if (!$config) {
            $config = new Config();
            $config->setName($name);
            $config->setValue($value);
            $config->setFor($for);
            $this->em->persist($config);

        } else {
            $config->setName($name);
            $config->setValue($value);
            $config->setFor($value);
        }
        $this->em->flush();
        return true;
    }
}


