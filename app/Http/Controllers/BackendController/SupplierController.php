<?php

namespace App\Http\Controllers\BackendController;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::all();
        return view('backend.pages.supplier.index',compact('suppliers'));
    }
    public function create()
    {
        return view('backend.supplier.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'email' => 'required | email | unique:customers',
            'phone' => 'required | unique:suppliers',
        ]);
        $supplier = new Supplier();
        $supplier->date = date('Y-m-d');
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->advance_balance = $request->advance_balance ?? 0.00;
        $supplier->due_balance = $request->due_balance ?? 0.00;
        $supplier->created_by = auth()->user()->id;

        DB::transaction(function() use($request, $supplier) {
            if ($supplier->save()) {
                if ($request->advance_balance != NULL) {
                    $transaction = new Transaction();
                    $transaction->transaction_type = 'Advance Balance';
                    $transaction->date = Carbon::now()->format('Y-m-d');
                    $transaction->supplier_id = $supplier->id;
                    $transaction->debit = $request->advance_balance; // as shop owner we have to receive this amount or advance
                    // so debit is receivable
                    $transaction->credit = NULL;
                    $transaction->created_by = auth()->user()->id;
                    $transaction->save();
                }
                if ($request->due_balance != NULL) {
                    $transaction = new Transaction();
                    $transaction->transaction_type = 'Due Balance';
                    $transaction->date = Carbon::now()->format('Y-m-d');
                    $transaction->supplier_id = $supplier->id;
                    $transaction->debit = NULL;
                    $transaction->credit = $request->due_balance;//as shop owner we have to pay this amount
                    // so credit is payable
                    $transaction->created_by = auth()->user()->id;
                    $transaction->save();
                }
            }
        });
        toastr()->success('Supplier has been created successfully!');
        return redirect()->route('supplier.index');
    }
    public function edit($id)
    {
        return view('backend.supplier.edit');
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:suppliers,phone,' . $id,
        ]);

        $supplier = Supplier::findOrFail($id);

        DB::transaction(function () use ($request, $supplier) {
            // Update supplier info
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->advance_balance = $request->advance_balance ?? 0.00;
            $supplier->due_balance = $request->due_balance ?? 0.00;
            $supplier->created_by = auth()->user()->id;
            $supplier->save();

            // Remove previous transactions for advance/due
            Transaction::where('supplier_id', $supplier->id)
                ->whereIn('transaction_type', ['Advance Balance', 'Due Balance'])
                ->delete();

            // Insert updated Advance Balance if exists
            if ($request->advance_balance != NULL) {
                $transaction = new Transaction();
                $transaction->transaction_type = 'Advance Balance';
                $transaction->date = Carbon::now()->format('Y-m-d');
                $transaction->supplier_id = $supplier->id;
                $transaction->debit = $request->advance_balance;
                $transaction->credit = NULL;
                $transaction->created_by = auth()->user()->id;
                $transaction->save();
            }

            // Insert updated Due Balance if exists
            if ($request->due_balance != NULL) {
                $transaction = new Transaction();
                $transaction->transaction_type = 'Due Balance';
                $transaction->date = Carbon::now()->format('Y-m-d');
                $transaction->supplier_id = $supplier->id;
                $transaction->debit = NULL;
                $transaction->credit = $request->due_balance;
                $transaction->created_by = auth()->user()->id;
                $transaction->save();
            }
        });

        toastr()->success('Supplier has been updated successfully!');
        return redirect()->route('supplier.index');
    }


     public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
        $transactions = Transaction::where('supplier_id', $id)->get();
        foreach ($transactions as $transaction) {
            $transaction->delete();
        }
        $supplier->delete();

        toastr()->success('Supplier has been deleted successfully!');
        return back();
    }
}
