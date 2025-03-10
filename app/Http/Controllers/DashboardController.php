<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');

        $query = Transaction::query();

        if (in_array($type, ['income', 'expense'])) {
            $query->where('type', $type);
        }
        $transactions = $query->get();

        $dailyTransactions = Transaction::all()
            ->groupBy(function ($item) {
                return Carbon::parse($item->transaction_date)->format('Y-m-d');
            })
            ->map(function ($items, $date) {
                return [
                    'date'    => $date,
                    'income'  => $items->where('type', 'income')->sum('amount'),
                    'expense' => $items->where('type', 'expense')->sum('amount'),
                ];
            })
            ->values()
            ->toArray();

        $totalIncome  = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $balance      = $totalIncome - $totalExpense;

        return Inertia::render("Dashboard", [
            'transactions'      => $transactions,
            'dailyTransactions' => $dailyTransactions,
            'totalIncome'       => $totalIncome,
            'totalExpense'      => $totalExpense,
        ]);
    }
}
