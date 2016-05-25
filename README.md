# Bring PHP API Wrappers around the Bring API.

See [Bring Developer Section](http://developer.bring.com/) for info about the API.

See example folder for usage.

## Install

``` 
composer require peec/bring-api
```

## Supporting the following API:

- [x] Booking API (EDI)
    - [x] Book shipments. https://api.bring.com/booking/api
    - [x] Get Mybring customers. https://api.bring.com/booking/api/customers
- [x] Shipping Guide API  
    - [x] Get estimated prices for packages.
    
    
** API's marked with [x] is implemented**


## Test (cli)

```
cd example/
export BRING_UID="me@myemail.com" && export BRING_API_KEY="xxxxxx-xxxxx-xxx-xxxx" && export BRING_CUSTOMER="BRING__CUSTOMER_NUMBER" && php booking-api.php
```

## Contribute

Contributions are welcome.

## License

MIT
