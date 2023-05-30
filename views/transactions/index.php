<!DOCTYPE html>
<html lang='en'>
    <?php include __DIR__ .'/../../app/utils/header.php'; ?>
    <style>
        <?php include __DIR__ .'/../../app/styles/styles.css' ?>
    </style>

    <body>
        <header>
            <div class='header-image-wrapper'></div>
            <button id="btn-home" title="click to return to home page"> 🏡 </button>
            <script>
                const btn = document.getElementById('btn-home');
                btn.addEventListener('click', () => { document.location.href = '/'; });
            </script>
        </header><br /><hr /><br />

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th class='amount-cell'>Amount</th>
                </tr>
            </thead>
            <tbody>
            <?php include __DIR__ .'/../../app/utils/helper.php'  ?>
                <?php
                    if (! empty($transactions['transactions_data'])):
                        $new_data   = $transactions['new_data'];
                        $data       = $transactions['transactions_data'];
                        $totals     = $transactions['transactions_totals'];
                ?>

                <?php if( $new_data ) { echo "<h3>🆕 New transactions added 😃</h3>"; } ?>
                    <?php foreach($data as $transaction): ?>
                        <tr>
                            <td><?= formatDate($transaction['transaction_date']) ?></td>
                            <td><?= $transaction['cheque_number'] ?></td>
                            <td><?= $transaction['description'] ?></td>
                            <td class='amount-cell'>
                                <?php if ($transaction['amount'] < 0): ?>
                                    <span style="color: red;">
                                            <?= formatDollarAmount($transaction['amount']) ?>
                                        </span>
                                <?php elseif ($transaction['amount'] > 0): ?>
                                    <span style="color: green;">
                                            <?= formatDollarAmount($transaction['amount']) ?>
                                        </span>
                                <?php else: ?>
                                    <?= formatDollarAmount($transaction['amount']) ?>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td class='amount-cell'><?= formatDollarAmount($totals['totalIncome'] ?? 0) ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td class='amount-cell amount-expense'><?= formatDollarAmount($totals['totalExpense'] ?? 0) ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td class='amount-cell'><?= formatDollarAmount($totals['netTotal'] ?? 0) ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
