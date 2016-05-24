<?php
namespace Peec\Bring\API;


abstract class Client {
    protected $_credentials;



    public function __construct(Credentials $credentials = null)
    {
        $this->_credentials = $credentials;
        $this->_client =
        $client = new \GuzzleHttp\Client();;
    }


    /**
     * @param $method
     * @param $endpoint
     * @param array $options
     * @return mixed
     */
    protected function request ($method, $endpoint, array $options = []) {

        $options = array_merge($options, [
            'headers' => [
                'Accept'     => 'application/json'
            ]
        ]);

        if ($credentials = $this->_credentials) {
            $options['headers']['X-Bring-Client-URL'] = $credentials->getClientUrl();
            $options['headers']['X-MyBring-API-Uid'] = $credentials->getClientId();;
            $options['headers']['X-MyBring-API-Key'] = $credentials->getApiKey();
        }

        return $client->request($method, $endpoint, $options);
    }

}