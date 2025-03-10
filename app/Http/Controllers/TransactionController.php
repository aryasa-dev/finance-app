<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index()
    {
        request()->validate([
            'type'       => 'nullable|in:income,expense',
            'category'   => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date', // validate 'end_date' as a valid date and after 'start_date'
        ]);

        $query = Transaction::query()->with('category');

        $sortField = request('sort_field', 'transaction_date');
        $sortDirection = request('sort_direction', 'desc');

        if (request("type")) {
            $query->where("type", request("type"));
        }
        if (request("category")) {
            $query->whereHas('category', function ($q) {
                $q->where('name', request('category'));
            });
        }
        if (request("start_date")) {
            $query->whereDate("transaction_date", '>=', request("start_date"));
        }
        if (request("end_date")) {
            $query->whereDate("transaction_date", '<=', request("end_date"));
        }

        $transactions = $query->orderBy($sortField, $sortDirection)->paginate(10)->onEachSide(1)->withQueryString();
        $categories   = Category::all();

        return Inertia::render('Transactions/Index', [
            'transactions' => TransactionResource::collection($transactions),
            'categories'   => $categories,
            'queryParams'  => request()->query() ?? null,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Transactions/Create', [
            'categories' => $categories,
        ]);
    }

    public function store(StoreTransactionRequest $request)
    {
        $data = $request->validated();
        Transaction::create($data);

        return to_route('transactions.index')->with('success', 'Transaction was created');
    }

    public function edit(Transaction $transaction)
    {
        $categories = Category::all();
        return Inertia::render('Transactions/Create', [
            'transaction' => $transaction,
            'categories'  => $categories,
            'isUpdating'  => true,
        ]);
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $data = $request->validated();
        $transaction->update($data);

        return to_route('transactions.index')->with('success', "Transaction \"$transaction->name\" was updated");
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return to_route('transactions.index')->with('success', "Transaction \"$transaction->name\" was deleted");
    }
}
