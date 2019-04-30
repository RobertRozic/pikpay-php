<?php

namespace RozicRobert\PikPay\Responses;
use SimpleXMLElement;

/**
 * PikPay PurchaseResponse.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class ParesResponse extends Response
{
    public function isSuccessfull()
    {
        return $this->httpResponse->getStatusCode() == 201;
    }

    public function responseCode()
    {
        $xml = $this->httpResponse->getBody()->getContents();
        /** @var SimpleXMLElement $parsed_xml */
        $parsed_xml = simplexml_load_string($xml);

        $response_code = 'response-code';

        return $parsed_xml->$response_code;
    }

    public function transactionId()
    {
        return (int) preg_replace("/[^0-9]/", "", $this->location());
    }

    public function location()
    {
        return $this->httpResponse->getHeaderLine('location');
    }
}
