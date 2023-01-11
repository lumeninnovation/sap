<?php

namespace LumenInnovation\SAP;


use LumenInnovation\SAP\Parameters\Parameters;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use LumenInnovation\SAP\Commands\SAPCommand;

class SAPServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('sap')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_sap_table')
            ->hasCommand(SAPCommand::class);

        $this->app->scoped(Parameters::class, function($app) {
            return new Parameters();
        });
    }
}
