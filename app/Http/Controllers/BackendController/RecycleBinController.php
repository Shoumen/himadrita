<?php

namespace App\Http\Controllers\BackendController;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Transaction;
use Illuminate\Http\Request;

class RecycleBinController extends Controller
{
public function customer() {
        $customers  = Customer::onlyTrashed()->get();
        return view('backend.recycle.customer', compact('customers'));
    }

    public function supplier() {
        $suppliers = Supplier::onlyTrashed()->get();
        return view('backend.recycle.supplier', compact('suppliers'));
    }

    // public function product() {
    //     $items = Product::onlyTrashed()->get();
    //     return view('backend.recycle.product', compact('items'));
    // }

    // public function purchase() {
    //     $items = Purchase::onlyTrashed()->get();
    //     return view('backend.recycle.purchase', compact('items'));
    // }

    public function transaction() {
        $items = Transaction::onlyTrashed()->get();
        return view('backend.recycle.transaction', compact('items'));
    }


    public function restore($type, $id)
    {
        $model = $this->getModel($type)::onlyTrashed()->findOrFail($id);
        $model->restore();
        toastr()->success(ucfirst($type).' restored successfully');
        return back();
    }

    public function forceDelete($type, $id)
    {
        $model = $this->getModel($type)::onlyTrashed()->findOrFail($id);
        $model->forceDelete();
        toastr()->success(ucfirst($type).' permanently deleted');
        return back();
    }

    private function getModel($type)
    {
        return match ($type) {
            'customer' => \App\Models\Customer::class,
            'supplier' => \App\Models\Supplier::class,
            // 'product' => \App\Models\Product::class,
            // 'purchase' => \App\Models\Purchase::class,
            'transaction' => \App\Models\Transaction::class,
            default => abort(404),
        };
    }
}
