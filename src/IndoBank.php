<?php

/*
 * This file is part of the IndoBank package.
 *
 * (c) Andri Desmana <andridesmana.pw | andridesmana29@gmail.com>
 *
 */

namespace Andes2912\IndoBank;

/**
 * Helper to access bank data directly from the bundled CSV, without
 * depending on the user publishing the migration/seeder/model.
 */
class IndoBank
{
    /**
     * Get all banks.
     *
     * @return array<int, array{nama_bank: string, sandi_bank: string}>
     */
    public function getBanks()
    {
        return RawDataGetter::getBanks();
    }

    /**
     * Search banks by partial bank name (case-insensitive).
     *
     * @param string $name
     * @return array<int, array{nama_bank: string, sandi_bank: string}>
     */
    public function searchBanks($name = '')
    {
        if ($name === '') {
            return $this->getBanks();
        }

        $needle = mb_strtolower($name);

        return array_values(array_filter($this->getBanks(), function ($bank) use ($needle) {
            return strpos(mb_strtolower($bank['nama_bank']), $needle) !== false;
        }));
    }

    /**
     * Find a single bank by exact match on a given key.
     *
     * @param string $key   Column name (e.g. 'sandi_bank' or 'nama_bank').
     * @param string $value Value to match.
     * @return array{nama_bank: string, sandi_bank: string}|null
     */
    public function findBank($key = '', $value = '')
    {
        foreach ($this->getBanks() as $bank) {
            if (isset($bank[$key]) && $bank[$key] === $value) {
                return $bank;
            }
        }

        return null;
    }
}
