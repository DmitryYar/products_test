<?php

namespace App\Services\File;

class CsvReader
{
    private $separator = ';';
    private $length = 5000;
    private $enclosure = "\"";
    private $escape = "\\";

    public function __construct()
    {
        
    }

    public function readFile(string $fileName)
    {
        $products = [];
        if (($handle = @fopen($fileName, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, $this->length, $this->separator)) !== FALSE) {
                $products[] = $data;
            }
        } else {
            throw new \LogicException('Ошибка чтения файла');
        }
        fclose($handle);
        return $products;
    }
}
