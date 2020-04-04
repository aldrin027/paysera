<?php declare(strict_types=1); ?>
<?php

namespace API;

class Web {

    public static function connect($url): array
    {
        $resource = curl_init();

        curl_setopt_array($resource, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => true,
            CURLOPT_FAILONERROR => true
        ]);

        $result = curl_exec($resource); 

        $httpCode = curl_getinfo($resource, CURLINFO_HTTP_CODE);
    
        curl_close($resource);
        
        if($httpCode !== 200) {
            return [
                'error' => true,
                'data' => 'Couldn\'t send request to server.'
            ];
        }

        return [
            'error' => false,
            'data' => $result
        ];
    }
}


?>