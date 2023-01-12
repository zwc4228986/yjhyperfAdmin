<?php

namespace YjHyperfAdminPligin\Generator;

use Hyperf\Command\Command;
use Symfony\Component\Console\Input\InputArgument;

class GeneratorCommand extends Command
{

    public function handle()
    {
        dd($this->input->getArguments());
    }

    protected function getArguments()
    {
        return [
            ['class_name', InputArgument::REQUIRED, 'The class_name of the class'],
            ['dirname', InputArgument::OPTIONAL, 'The dirname of the class', false],
        ];
    }

}