<?php

namespace Lumen\SAP\Commands;

use Illuminate\Console\Command;

class SAPCommand extends Command
{
    public $signature = 'sap';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
