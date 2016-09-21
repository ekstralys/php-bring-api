<?php
namespace Peec\Bring\API\Client;

use GuzzleHttp\Exception\RequestException;
use Peec\Bring\API\Contract\Booking\BookingRequest;
use Peec\Bring\API\Contract\EasyReturn\LabelRequest;

class EasyReturnClient extends Client
{
    const ERS_LABEL_CREATE_API = 'https://api.bring.com/documents/ipc/ers/label';


    protected $_apiCreateLabel = self::ERS_LABEL_CREATE_API;




    public function create (
        LabelRequest $req
    ) {
        $data = $req->toXml('LabelRequest');


        $options = [
            'body' => $data
        ];

        try {
            $request = $this->xmlRequest('post', $this->_apiCreateLabel, $options);
            return simplexml_load_string($request->getBody());
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $resp = $e->getResponse();
            $xml = simplexml_load_string($resp->getBody());
            $errors = [
                [
                    'code' => (string)$xml->Status,
                    'message' => (string)$xml->Message
                ]
            ];
            $ex = new EasyReturnClientException("Got error from Bring API when creating label.", null, $e);
            $ex->setErrors($errors);
            throw $ex;
        }
    }


    public function setApiCreateLabel($apiCreateLabel)
    {
        $this->_apiCreateLabel = $apiCreateLabel;
        return $this;
    }


}