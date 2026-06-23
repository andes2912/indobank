<?php

/*
 * This file is part of the IndoBank package.
 *
 * (c) Andri Desmana <andridesmana.pw | andridesmana29@gmail.com>
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Bank Model.
 */
class Bank extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'banks';

    /**
     * Mass-assignable attributes.
     *
     * @var array<int, string>
     */
    protected $fillable = ['sandi_bank', 'nama_bank'];

    /**
     * Disable timestamps — `banks` table has no created_at/updated_at columns.
     *
     * @var bool
     */
    public $timestamps = false;
}
