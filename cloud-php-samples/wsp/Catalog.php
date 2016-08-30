<?php

/**
 * Copyright (C) 2014 Orange
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 22/08/2014
 */

//I don't want to add it to method cause it will directly go inside soapserver...
function isAuthentified($users)
{
    foreach ($users as $username => $password) {
        if ($_SERVER['PHP_AUTH_USER'] == $username && $_SERVER['PHP_AUTH_PW'] == $password) {
            return true;
        }
    }
    return false;
}

class Catalog
{
    private $users;

    public function __construct()
    {
        $this->users = array($_ENV["WSC_LOGIN"] => $_ENV["WSC_PASSWD"]);
        // Throw SOAP fault for invalid username and password combo
        if (!isAuthentified($this->users)) {
            throw new SOAPFault("Incorrect username and password combination.", 401);
        }
    }


    public function getCatalogEntry($catalogId)
    {
        if ($catalogId == 'catalog1') {
            return '

          <title>Catalog</title>

        <p> </p>
         <table class="table table-bordered table-hover">
        <tbody><tr><th>CatalogId</th>
        <th>Journal</th><th>Section
        </th><th>Edition</th><th>
        Title</th><th>Author</th>
        </tr><tr><td>catalog1</td>
        <td>IBM developerWorks</td><td>
        XML</td><td>October 2005</td>
        <td>JAXP validation</td>
        <td>Brett McLaughlin</td></tr>
        </tbody></table>

        ';
        } elseif ($catalogId = 'catalog2') {
            return '<title>Catalog</title>

        <p> </p>
         <table class="table table-bordered table-hover">

        <tbody><tr><th>CatalogId</th><th>
        Journal</th><th>Section</th>
        <th>Edition</th><th>Title
        </th><th>Author
        </th></tr><tr><td>catalog1
        </td><td>IBM developerWorks</td>
        <td>XML</td><td>July 2006</td>
        <td>The Java XPath API
        </td><td>Elliotte Harold</td>
        </tr>
        </tbody></table>';
        }
    }
} 