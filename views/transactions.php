<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $root = dirname(__DIR__) .  DIRECTORY_SEPARATOR;
                require($root . "public" . DIRECTORY_SEPARATOR . "index.php");
                addTransactions();
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td>
                        <?php
                            echo "$" . getTotalIncome();
                        ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td>
                        <?php
                            echo "$" . getTotalExpense();
                        ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td>
                        <?php
                            echo "$" . getNetTotal();
                        ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
