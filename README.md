# Cron Manager
Cron Manager for Symfony 3
Create managable cron tasks for your symfony project

# Installing

 **1. Add the dependency to your project:**

```bash
composer require kempfe/cron-manager
```

 **2. Add package to your AppKernel.php**
```php
<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new CronManager\CronManager()
        ];
        ...
```

**3. Update your database**
```bash
php bin/console doctrine:schema:update --force
```

####This Package is based on mtdowling/cron-expression Cron Expression Parser

# Creating a Cron Task
 
1. Create a Symfony Command like described here 
[http://symfony.com/doc/master/components/console.html](http://symfony.com/doc/master/components/console.html)

2. Create a new database entry into cm_cron with fields:
    * name: crontask name
    * expression: cron expression - read more on [https://packagist.org/packages/mtdowling/cron-expression](https://packagist.org/packages/mtdowling/cron-expression)
    * command: symfony console command fx. appbund:test
    * arguments: arguments passed to the console command
    * active: 1 for active cron - 0 for inactive
    
    leave the rest of the fields blank
    

# Cron Manager Execution
```bash
php bin/console cm:run --interval=600 --processCheck=1
```

####Options
* --interval: Your Linux Cron execution interval - default execution interval is 600 seconds
* --processCheck: When enabled it checks process id to avoid overlapping executions
