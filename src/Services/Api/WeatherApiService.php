<?php 
namespace App\Services\Api;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherApiService{
    public $baseUrl;
    public $apiToken;
    public $query;
    private $client;

    public function __construct(HttpClientInterface $client){
        $this->client = $client;
        $this->config = parse_ini_file('config.ini', true);
        $this->baseUri = $this->config['baseUri']; 
        $this->apiToken = $this->config['access_key'];   
    }

    public function weatherCity($city){
        $this->query=$city;
        $fullUrl='http://api.weatherstack.com/current?access_key=07842f831612eaadba56bc6720b17841&query='.$city;
    
        $response = $this->client->request('GET',$fullUrl);
        $content = $response->toArray();
        return $content;
    }
}
    