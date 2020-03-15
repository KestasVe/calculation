<?php

declare(strict_types=1);

namespace Calculation\CommissionTask\Service;

class FileReader
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function getData()
    {
        $transactionData = [];
        if (file_exists($this->file)) {
            if (($handle = fopen($this->file, 'r')) !== false) {
                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    $transactionData[] = $data;
                }
                fclose($handle);

                return $transactionData;
            }
        } else {
            echo 'The file does not exist'.PHP_EOL;
        }
    }
}
