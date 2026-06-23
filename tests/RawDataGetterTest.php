<?php

namespace Andes2912\IndoBank\Tests;

use PHPUnit\Framework\TestCase;
use Andes2912\IndoBank\RawDataGetter;

class RawDataGetterTest extends TestCase
{
    public function test_get_banks_returns_non_empty_array(): void
    {
        $banks = RawDataGetter::getBanks();

        $this->assertIsArray($banks);
        $this->assertNotEmpty($banks);
    }

    public function test_each_row_has_required_columns(): void
    {
        $banks = RawDataGetter::getBanks();

        foreach ($banks as $bank) {
            $this->assertArrayHasKey('nama_bank', $bank);
            $this->assertArrayHasKey('sandi_bank', $bank);
        }
    }

    public function test_all_sandi_bank_codes_are_non_empty(): void
    {
        $banks = RawDataGetter::getBanks();

        foreach ($banks as $bank) {
            $this->assertNotEmpty($bank['sandi_bank'], 'sandi_bank tidak boleh kosong');
        }
    }
}
