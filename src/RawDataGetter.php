<?php

namespace Andes2912\IndoBank;

use ParseCsv\Csv;

/**
 * Get raw data from CSV Files on /src/data/csv.
 */
class RawDataGetter
{
    /**
     * Raw Data file path.
     *
     * @return string
     */
    protected static $path = __DIR__.'/data/csv';

    /**
     * Get banks data.
     *
     * @return array
     */
    public static function getBanks()
    {
        $result = self::getCsvData(self::$path.'/bank.csv');

        return $result;
    }


    /**
     * Get Data from CSV.
     *
     * @param string $path File Path.
     *
     * @return array
     */
    public static function getCsvData($path = '')
    {
        $csv = new Csv();
        $csv->auto($path);

        return $csv->data;
    }
}