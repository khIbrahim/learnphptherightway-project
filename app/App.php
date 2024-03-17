<?php

declare(strict_types = 1);

$transactions = [];

function getTransactionFiles() : array {
    $ret = [];
    $files = scandir(FILES_PATH);
    foreach ($files as $file){
        if(str_ends_with($file, '.csv') && file_exists(FILES_PATH . $file)){
            $ret[] = FILES_PATH . $file;
        }
    }
    return array_filter($ret, 'is_file');
}

function getTransactions() : array {
    $ret = [];
    foreach (getTransactionFiles() as $filename){
        $file = fopen($filename, 'r');
        while (($line = fgetcsv($file)) !== false){
            if ($line === ['Date', 'Check #', 'Description', 'Amount']){
                continue;
            }
            $ret[] = ['date' => $line[0], 'check' => (string)$line[1], 'desc' => $line[2], 'amount' => $line[3]];
        }
        fclose($file);
    }
    return $ret;
}

function amountToFloat(string $amount) : float {
    return (float)str_replace("$", "", $amount);
}

function getTotalIncome() : string {
    $amounts = array_map(fn(array $transactionData) => amountToFloat($transactionData['amount']), getTransactions());
    $amounts = array_filter($amounts, fn($amount) => $amount > 0);
    return number_format(array_sum($amounts), 2);
}

function getTotalExpense() : string {
    $amounts = array_map(fn(array $transactionData) => amountToFloat($transactionData['amount']), getTransactions());
    $amounts = array_filter($amounts, fn($amount) => $amount < 0);
    return number_format(array_sum($amounts), 2);
}

function getNetTotal() : string {
    return number_format(amountToFloat(getTotalIncome()) - amountToFloat(getTotalExpense()), 2);
}