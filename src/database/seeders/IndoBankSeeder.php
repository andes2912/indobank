<?php

/*
 * This file is part of the IndoBank package.
 *
 * (c) Andri Desmana <andridesmana.pw | andridesmana29@gmail.com>
 *
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Andes2912\IndoBank\RawDataGetter;

class IndoBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Idempotent: truncates the `banks` table first so re-running won't
     * leave duplicate rows. Some `sandi_bank` codes are intentionally
     * shared across different banks (e.g. CIMB Niaga & CIMB Niaga Syariah
     * both use 022), so we cannot safely use upsert on `sandi_bank` alone.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('banks')->truncate();
        Schema::enableForeignKeyConstraints();

        foreach (array_chunk(RawDataGetter::getBanks(), 100) as $chunk) {
            DB::table('banks')->insert($chunk);
        }
    }
}
