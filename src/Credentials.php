<?php
/**
 * Created by PhpStorm.
 * User: peec
 * Date: 5/24/16
 * Time: 6:50 PM
 */

namespace Peec\Bring\API;


/**
 * Class Credentials
 * @package Peec\Bring\API
 */
class Credentials {

    private $clientId;

    private $apiKey;

    private $clientUrl;

    /**
     * Creates bring credentials object.
     *
     * @param string $clientId Bring Client ID ( e.g. myuser@mydomain.no )
     * @param string $apiKey ( e.g. xxxxxxxxxx-xxxx-xxxxx-xxxxx ) Get it from My Bring settings.
     * @param string $clientUrl Identifier ( your domain ).
     */
    public function __construct ($clientId, $apiKey, $clientUrl) {
        if (!$clientId) {
            throw new \InvalidArgumentException("\$clientId must not be empty.");
        }
        if (!$apiKey) {
            throw new \InvalidArgumentException("\$apiKey must not be empty.");
        }
        if (!$clientUrl) {
            throw new \InvalidArgumentException("\$clientUrl must not be empty.");
        }
        $this->clientId = $clientId;
        $this->apiKey = $apiKey;
        $this->clientUrl = $clientUrl;
    }


    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getClientUrl()
    {
        return $this->clientUrl;
    }


}