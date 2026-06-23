<?php

namespace Andes2912\IndoBank\Tests;

use PHPUnit\Framework\TestCase;
use Andes2912\IndoBank\IndoBank;

class IndoBankTest extends TestCase
{
    private IndoBank $indo;

    protected function setUp(): void
    {
        $this->indo = new IndoBank();
    }

    public function test_get_banks_returns_all_rows(): void
    {
        $banks = $this->indo->getBanks();

        $this->assertIsArray($banks);
        $this->assertGreaterThan(10, count($banks));
    }

    public function test_search_banks_is_case_insensitive_partial(): void
    {
        $result = $this->indo->searchBanks('mandiri');

        $this->assertNotEmpty($result, 'Harus menemukan setidaknya satu bank yang mengandung "mandiri"');

        foreach ($result as $bank) {
            $this->assertStringContainsStringIgnoringCase('mandiri', $bank['nama_bank']);
        }
    }

    public function test_search_banks_with_empty_string_returns_all(): void
    {
        $this->assertSame(
            count($this->indo->getBanks()),
            count($this->indo->searchBanks(''))
        );
    }

    public function test_search_banks_unknown_returns_empty_array(): void
    {
        $this->assertSame([], $this->indo->searchBanks('zzz_tidak_ada_bank_seperti_ini'));
    }

    public function test_find_bank_by_sandi(): void
    {
        $bca = $this->indo->findBank('sandi_bank', '014');

        $this->assertNotNull($bca);
        $this->assertStringContainsStringIgnoringCase('BCA', $bca['nama_bank']);
    }

    public function test_find_bank_not_found_returns_null(): void
    {
        $this->assertNull($this->indo->findBank('sandi_bank', '999999'));
    }
}
