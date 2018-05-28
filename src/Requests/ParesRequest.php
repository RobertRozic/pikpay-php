<?php

namespace RobertRozic\PikPay\Requests;

use GuzzleHttp\Client as HttpClient;
use RobertRozic\PikPay\Gateway;
use RobertRozic\PikPay\Requests\Request;
use RobertRozic\PikPay\Responses\ParesResponse;

/**
 * PikPay PurchaseRequest.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class ParesRequest extends Request
{
    protected $uri;
    protected $params;
    protected $httpClient;
    protected $httpRequest;
    protected $response;

    public function __construct(HttpClient $httpClient, Gateway $gateway, array $params)
    {
        parent::__construct($httpClient, $gateway, 'pares', $params);
        $this->uri = '/pares';
        $this->httpClient = $httpClient;
        $this->send();
    }

    public function response()
    {
        return new ParesResponse($this->response);
    }
}
