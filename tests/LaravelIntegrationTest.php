<?php

namespace Andes2912\IndoBank\Tests;

use Andes2912\IndoBank\IndoBank;
use Andes2912\IndoBank\IndoBankServiceProvider;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase;

class LaravelIntegrationTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [IndoBankServiceProvider::class];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('database.default', 'testing');
    }

    public function test_service_is_resolvable_from_container(): void
    {
        $this->assertInstanceOf(IndoBank::class, $this->app->make('indobank'));
    }

    public function test_migration_creates_banks_table(): void
    {
        $this->artisan('migrate')->assertSuccessful();

        $this->assertTrue(Schema::hasTable('banks'));
        $this->assertTrue(Schema::hasColumns('banks', ['sandi_bank', 'nama_bank']));
    }
}
