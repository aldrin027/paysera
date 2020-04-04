<?php declare(strict_types=1); ?>
<?php
namespace Controller;

include 'src/API.php';
include 'src/Utils.php';

use API\Web;
use Utils\Helper;

class Business {

    public function readFile($file): array
    {

        if(!file_exists($file)) {
            return [
                'error' => true,
                'data' => 'File not exists!'
            ];
        }

        return [
            'error' => false,
            'data' => file($file)
        ];
        
    }

    public function businessFlow(array $file): array
    {
        $result = [];

        foreach ($file as $key => $line) {
            $content = json_decode($line);

            $binList = Web::connect("https://lookup.binlist.net/$content->bin");
            
            if($binList['error'] === true) {
                return [
                    'error' => true,
                    'data' => 'There\'s something wrong with the server.'
                ];
            }

            $binResults = json_decode($binList['data']);

            $isEu = Helper::isEu($binResults->country->alpha2);

            $requestRate = Web::connect("https://api.exchangeratesapi.io/latest");

            if($requestRate['error'] === true) {
                return [
                    'error' => true,
                    'data' => 'There\'s something wrong with the server.'
                ];
            }

            $exchangeRate = json_decode($requestRate['data'], true);

            $amountFixed = 0;

            if($content->currency === 'EUR' || $exchangeRate['rates'][$content->currency] === 0) {
                $amountFixed = floatval($content->amount);
            }else if($content->currency !== 'EUR' || $exchangeRate['rates'][$content->currency] > 0) {
                $amountFixed = floatval($content->amount) / $exchangeRate['rates'][$content->currency];
            }

            $result[] = Helper::compute($amountFixed, $isEu);
        }

        return [
            'error' => false,
            'data' => implode("\n", $result)
        ];
    }

    public function execute(string $param): string
    {
        $file = $this->readFile($param);

        if(isset($file['error']) && $file['error'] === true) {
            return $file['data'];
        }

        return implode("\n", $this->businessFlow($file['data']));
    }

}


?>