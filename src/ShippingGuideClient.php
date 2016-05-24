<?php
namespace Peec\Bring\API;

use GuzzleHttp\Exception\RequestException;
use Peec\Bring\API\Contract\ShippingGuide\PriceRequest;

class ShippingGuideClient extends Client
{
    const BRING_PRICES_API = 'https://api.bring.com/shippingguide/products/price.json';

    protected $_apiBringPrices = self::BRING_PRICES_API;



    public function getPrice (PriceRequest $request) {
        $options = [
            'query' => $request->toArray()
        ];
        $request = $this->request('get', $this->_apiBringPrices, $options);
        if ($request->getStatusCode() == 200) {
            $json = json_decode($request->getBody(), true);
            return $json;
        }
    }
}