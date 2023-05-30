<?php
declare(strict_types = 1);

namespace App\Models;

use App\Model;
use PDO;
use Throwable;

class TransactionsModel extends Model
{
    public function create( string $transaction_date,  int | null $cheque_number, string $description, float $amount ): array
    {
        $stmt = $this->db->prepare(
            'INSERT INTO transactions (transaction_date, cheque_number, description, amount)
                VALUES (?, ?, ?, ?)'
        );

        $stmt->execute([$transaction_date, $cheque_number, $description, $amount]);

        return $this->generate();
    }

    public function generate( ):array
    {
        $stmt_all = $this->db->prepare(
            'SELECT * FROM transactions'
        );

        $stmt_all->execute();
        $transactions_db = $stmt_all->fetchAll(PDO::FETCH_ASSOC);

        $transactions_totals = $this -> calculateTotals($transactions_db);

        return [ 'transactions_data'=>$transactions_db, 'transactions_totals'=>$transactions_totals ] ?: [];
    }

    /**
     * @throws Throwable
     */
    public function register(array $transactionInfo ): array
    {
        try {
            $this->db->beginTransaction();

            if (! empty($transactionInfo) ) {
                $transactionRecord = $this->create($transactionInfo['transaction_date'], $transactionInfo['cheque_number'], $transactionInfo['description'], $transactionInfo['amount']);

                // use this to throw an error so that nothing is saved to the SQL database.
                //throw new \Exception('Test');
            } else {
                $transactionRecord = $this->generate();
            }

            $this->db->commit();


        } catch(Throwable $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw $e;
        }

        return $transactionRecord;

    }

    public function calculateTotals(array $transactions ): array
    {
        $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

        foreach ($transactions as $transaction) {
            $totals['netTotal'] += $transaction['amount'];

            if ($transaction['amount'] >= 0) {
                $totals['totalIncome'] += $transaction['amount'];
            } else {
                $totals['totalExpense'] += $transaction['amount'];
            }
        }

        return $totals;
    }
}
