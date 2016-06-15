<?php

namespace Poznet\ConfigBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Poznet\ConfigBundle\DependencyInjection\PoznetConfigExtension;

class ConfigBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new PoznetConfigExtension();
    }
}
