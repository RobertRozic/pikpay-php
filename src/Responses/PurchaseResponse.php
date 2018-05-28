<?php

namespace RobertRozic\PikPay\Responses;
use SimpleXMLElement;

/**
 * PikPay PurchaseResponse.
 *
 * @author    Selim Salihovic <selim.salihovic@gmail.com>
 * @copyright 2016 SelimSalihovic
 * @license   http://opensource.org/licenses/mit-license.php MIT
 */
class PurchaseResponse extends Response
{
    public function isSuccessfull()
    {
        return $this->httpResponse->getStatusCode() == 201;
    }

    public function getData() {
        $xml = $this->httpResponse->getBody()->getContents();
        /** @var SimpleXMLElement $parsed_xml */
        $parsed_xml = simplexml_load_string($xml);

        if (property_exists($parsed_xml, 'acs-url')) {
            $parsed_xml->secure = true;
        }

        return json_encode($parsed_xml);
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
