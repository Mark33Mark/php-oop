<?php
declare(strict_types = 1);

namespace App\Controllers;
use App\View;
use App\Models\TransactionsModel;
use Throwable;

class TransactionsController
{
    /**
     * @throws Throwable
     */
    public function index(bool $new_data_added = true): View
    {
        $files = $this->getTransactionFiles(STORAGE_PATH) ?: [];

        $transactions       = [];
        $transactionsInfo   = [];

        if (empty($files)) {
            $new_data_added = false;
        } else {
            foreach($files as $file) {
                $transactions = array_merge($transactions, $this->getTransactions($file));
            }
        }

        $new_data = [ 'new_data' => $new_data_added ];

        if (! empty($transactions)) {

            foreach ($transactions as $transaction) {
                $transactionsInfo = (new TransactionsModel())->register( $transaction );
            }
        } else {
            $transactionsInfo = (new TransactionsModel())->register( [] );
        }

        // $new_data is a UI flag to confirm to the user their upload has
        // been added and rendered.
        $data_package = array_merge($transactionsInfo, $new_data);

        return View::make('transactions/index', [ 'transactions' => $data_package ]);
    }

    public function getTransactionFiles(string $dirPath): array
    {
        $files = [];

        // make sure only .csv files are used in case someone gets around
        // the server process for selecting only .csv files
        $file_selector = preg_grep('~\.(csv)$~', scandir($dirPath));

        foreach ( $file_selector as $file) {
            if (is_dir($file)) {
                continue;
            }

            $files[] = $dirPath . '/' . $file;
        }

        return $files ?: [];
    }

    public function getTransactions(string $fileName ): array
    {
        if (! file_exists($fileName)) {
            trigger_error('File "' . $fileName . '" does not exist.', E_USER_ERROR);
        }

        $file = fopen($fileName, 'r');

        fgetcsv($file);

        $transactions = [];

        while (($transaction = fgetcsv($file)) !== false) {
                $transaction = $this->extractTransaction($transaction);

            $transactions[] = $transaction;
        }

        unlink($fileName);

        return $transactions;
    }

    private function extractTransaction(array $transactionRow): array
    {
        [$transaction_date, $cheque_number, $description, $amount] = $transactionRow;

        $transaction_date = date('Y-m-d', strtotime($transaction_date));

        $cheque_number = (int)$cheque_number;
        if ($cheque_number === 0 ) { $cheque_number = null; }

        $amount = (float) str_replace(['$', ','], '', $amount);

        return
            [
                'transaction_date'  => $transaction_date,
                'cheque_number'     => $cheque_number,
                'description'       => $description,
                'amount'            => $amount,
            ];
    }
}
