<?php

namespace YjHyperfAdminPligin\Generator\Command;

use Hyperf\Command\Annotation\Command;
use YjHyperfAdminPligin\Generator\Core\Dao\Config;
use YjHyperfAdminPligin\Generator\GeneratorCommand;

#[Command]
class DaoCommand extends GeneratorCommand
{
    protected ?string $name = 'yj:dao';

    protected string $description = 'Create a new  dao class';

    public function handle()
    {
        $config = $this->createConfig();

    }

    public function createConfig()
    {
        $config = [];
        foreach ($this->getArguments() as $argument) {
            $config[$argument[0]] = $this->input->getArgument($argument[0]);
        }
        return new Config($config);
    }

}