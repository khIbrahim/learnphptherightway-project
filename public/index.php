<?php

declare(strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

/* YOUR CODE (Instructions in README.md) */
require(APP_PATH . "App.php");

function addTransactions() : void {
    foreach (getTransactions() as $transactionData){
        $dateTransaction = $transactionData['date'] ?? 0;
        $time = strtotime($dateTransaction);

        $format = date('M d, Y', $time);
        $check = $transactionData['check'] ?? "";
        $description = (string)$transactionData['desc'];
        $amountFormat = (string)$transactionData['amount'];
        $color = amountToFloat($amountFormat) > 0 ? "green" : "red";
        echo
        "<tr>
            <th scope='row'>$format</th>
            <td>$check</td>
            <td>$description</td>
            <td style='color: $color'>$amountFormat</td>
        </tr>";
    }
}