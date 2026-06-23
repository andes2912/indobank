<?php

/*
 * This file is part of the IndoBank package.
 *
 * (c) Andri Desmana <andridesmana.pw | andridesmana29@gmail.com>
 *
 */

namespace Andes2912\IndoBank;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Legacy publish command kept for backward compatibility.
 *
 * Prefer the standard Laravel approach:
 *     php artisan vendor:publish --tag=indobank
 */
class IndoBankPublishCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'indobank:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish IndoBank assets (migrations, seeders, model) to the host application';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->publishModels();
        $this->publishMigrations();
        $this->publishSeeds();

        $this->info('Publishing IndoBank complete');
    }

    /**
     * Copy files from a source directory into a destination directory,
     * creating the destination if necessary.
     *
     * @param  string  $from
     * @param  string  $to
     * @return void
     */
    protected function publishDirectory($from, $to)
    {
        if (! File::isDirectory($to)) {
            File::makeDirectory($to, 0755, true, true);
        }

        $exclude = ['..', '.', '.DS_Store'];
        $source  = array_diff(scandir($from), $exclude);

        foreach ($source as $item) {
            $this->info('Copying file: '.$to.$item);
            File::copy($from.$item, $to.$item);
        }
    }

    /**
     * Publish model.
     *
     * @return void
     */
    protected function publishModels()
    {
        $this->publishDirectory(__DIR__.'/database/models/', app()->path().'/Models/');
    }

    /**
     * Publish migrations.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishDirectory(__DIR__.'/database/migrations/', app()->databasePath().'/migrations/');
    }

    /**
     * Publish seeds.
     *
     * @return void
     */
    protected function publishSeeds()
    {
        $this->publishDirectory(__DIR__.'/database/seeders/', app()->databasePath().'/seeders/');
    }
}
