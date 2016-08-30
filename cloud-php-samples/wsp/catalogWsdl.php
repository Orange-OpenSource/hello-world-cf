<?php
/**
 * Copyright (C) 2014 Orange
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 18/08/2014
 */
header("Content-type: text/xml");
$services = require __DIR__ . '/../util/configExtractor.php';
include_once __DIR__ . '/const.php';
$serviceName = ucfirst($_ENV['WSP_SERVICE_NAME']);
echo "<?xml version='1.0' encoding= 'UTF-8' ?>";
?>

<definitions xmlns:tns='http://example.org/catalog'
             xmlns:soap='http://schemas.xmlsoap.org/wsdl/soap/'
             xmlns:xsd='http://www.w3.org/2001/XMLSchema'
             name='<?php echo $serviceName; ?>'
             targetNamespace='http://example.org/catalog'
             xmlns='http://schemas.xmlsoap.org/wsdl/'>

    <message name='getCatalogRequest'>
        <part name='catalogId' type='xsd:string'/>
    </message>
    <message name='getCatalogResponse'>
        <part name='Result' type='xsd:string'/>
    </message>

    <portType name='<?php echo $serviceName; ?>PortType'>
        <operation name='getCatalogEntry'>
            <input message='tns:getCatalogRequest'/>
            <output message='tns:getCatalogResponse'/>
        </operation>
    </portType>

    <binding name='<?php echo $serviceName; ?>Binding' type='tns:<?php echo $serviceName; ?>PortType'>
        <soap:binding style='rpc'
                      transport='http://schemas.xmlsoap.org/soap/http'
        />
        <operation name='getCatalogEntry'>
            <soap:operation soapAction='urn:localhost-catalog#getCatalogEntry'/>
            <input>
            <soap:body use='encoded' namespace=
            'urn:localhost-catalog'
                       encodingStyle='http://schemas.xmlsoap.org/soap/encoding/'/>
            </input>
            <output>
                <soap:body use='encoded' namespace=
                'urn:localhost-catalog'
                           encodingStyle='http://schemas.xmlsoap.org/soap/encoding/'/>
            </output>
        </operation>
    </binding>

    <service name='<?php echo $serviceName; ?>Service'>
        <port name='<?php echo $serviceName; ?>Port' binding='<?php echo $serviceName; ?>Binding'>
            <soap:address location='<?php echo LOCATION . "?server"; ?>'/>
        </port>
    </service>
</definitions>