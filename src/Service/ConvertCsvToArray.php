<?php

namespace App\Service;

class ConvertCsvToArray
{
    public function __construct(
        private string $importDirectory
    ) {
    }

    public function convert($filename, $delimiter = ','): array
    {
        $filename = $this->importDirectory.'/'.$filename;

        if (!file_exists($filename) || !is_readable($filename)) {
            throw new \Exception('Fichier source absent ou illisible.');
        }

        $header = null;
        $data = [];

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        return $data;
    }
}
