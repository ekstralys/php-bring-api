<?php
namespace Peec\Bring\API\Client;


abstract class Client {

    /**
     * @var Credentials
     */
    protected $_credentials;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $_client;


    public function __construct(Credentials $credentials, \GuzzleHttp\ClientInterface $client = null)
    {
        $this->_credentials = $credentials;

        if ($client === null) {
            $client = new \GuzzleHttp\Client();
        }
        $this->_client = $client;
    }

    public function setClient(\GuzzleHttp\ClientInterface $client) {
        $this->_client = $client;
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

            if ($credentials->getClientId() !== null) {
                $options['headers']['X-MyBring-API-Uid'] = $credentials->getClientId();
            }
            if ($credentials->getApiKey() !== null) {
                $options['headers']['X-MyBring-API-Key'] = $credentials->getApiKey();
            }
        }



        $req = $this->_client->request($method, $endpoint, $options);
        return $req;
    }

    /**
     * https://github.com/guzzle/guzzle/issues/1196
     * @param array $data
     * @return string
     */
    protected function getQueryParams (array $data) {
        $add = '';
        foreach ($data as $k => $arr) {
            if (is_array($arr)) {
                foreach ($arr as $value) {
                    $add .= "&$k=" . urlencode($value);
                }
                unset($data[$k]);
            }
        }

        $params = http_build_query($data) . $add;

        return $params;
    }
}