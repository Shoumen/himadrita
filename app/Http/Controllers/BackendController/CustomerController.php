<?php

namespace App\Http\Controllers\BackendController;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Flasher\Notyf\Prime\NotyfInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::all();
        return view('backend.pages.customer.index',compact('customers'));
    }

    public function create()
    {
        return view('backend.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'email' => 'required | email | unique:customers',
            'phone' => 'required | unique:customers',
        ]);
        $customer = new Customer();
        $customer->date = date('Y-m-d');
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->advance_balance = $request->advance_balance ?? 0.00;
        $customer->due_balance = $request->due_balance ?? 0.00;
        $customer->created_by = auth()->user()->id;
        DB::transaction(function() use($request, $customer) {
            if ($customer->save()) {
                if ($request->advance_balance != NULL) {
                    $transaction = new Transaction();
                    $transaction->transaction_type = 'Advance Balance';
                    $transaction->date = Carbon::now()->format('Y-m-d');
                    $transaction->customer_id = $customer->id;
                    $transaction->debit = $request->advance_balance; //as shop owner we have to pay this amount or advance
                    // so debit is payable
                    $transaction->credit = NULL;
                    $transaction->created_by = auth()->user()->id;
                    $transaction->save();
                }
                if ($request->due_balance != NULL) {
                    $transaction = new Transaction();
                    $transaction->transaction_type = 'Due Balance';
                    $transaction->date = Carbon::now()->format('Y-m-d');
                    $transaction->customer_id = $customer->id;
                    $transaction->debit = NULL;
                    $transaction->credit = $request->due_balance; //as shop owner we have to receive this amount
                    // so credit is receivable
                    $transaction->created_by = auth()->user()->id;
                    $transaction->save();
                }
            }
        });
        toastr()->success('Customer has been Created successfully!');
        return redirect()->route('customer.index');
    }

    public function show($id)
    {
        return view('backend.customers.show', ['id' => $id]);
    }

    public function edit($id)
    {
        return view('backend.customers.edit', ['id' => $id]);
    }

public function update(Request $request, string $id)
{
    $request->validate([
        'name' => 'required',
        'phone' => 'required|unique:customers,phone,' . $id,
    ]);

    $customer = Customer::findOrFail($id);
    DB::transaction(function () use ($request, $customer) {

        // Update customer
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->advance_balance = $request->advance_balance ?? 0.00;
        $customer->due_balance = $request->due_balance ?? 0.00;
        $customer->created_by = auth()->user()->id;
        $customer->save();

        // Delete previous advance and due transactions
        Transaction::where('customer_id', $customer->id)
            ->whereIn('transaction_type', ['Advance Balance', 'Due Balance'])
            ->delete();

        // Re-insert advance transaction if exists
        if ($request->advance_balance != NULL) {
            $advanceTransaction = new Transaction();
            $advanceTransaction->transaction_type = 'Advance Balance';
            $advanceTransaction->date = Carbon::now()->format('Y-m-d');
            $advanceTransaction->customer_id = $customer->id;
            $advanceTransaction->debit = $request->advance_balance;
            $advanceTransaction->credit = NULL;
            $advanceTransaction->created_by = auth()->user()->id;
            $advanceTransaction->save();
        }

        // Re-insert due transaction if exists
        if ($request->due_balance != NULL) {
            $dueTransaction = new Transaction();
            $dueTransaction->transaction_type = 'Due Balance';
            $dueTransaction->date = Carbon::now()->format('Y-m-d');
            $dueTransaction->customer_id = $customer->id;
            $dueTransaction->debit = NULL;
            $dueTransaction->credit = $request->due_balance;
            $dueTransaction->created_by = auth()->user()->id;
            $dueTransaction->save();
        }
    });

    toastr()->success('Customer has been updated successfully!');
    return redirect()->route('customer.index');
}


    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        $transactions = Transaction::where('customer_id', $id)->get();
        foreach ($transactions as $transaction) {
            $transaction->delete();
        }
        $customer->delete();
        toastr()->success('Customer has been Deleted successfully!');
        return back();
    }
}
