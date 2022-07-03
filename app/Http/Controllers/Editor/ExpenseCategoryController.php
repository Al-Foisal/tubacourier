<?php

namespace App\Http\Controllers\Editor;

use App\ExpenseCategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller {
    public function index() {
        $data               = [];
        $data['categories'] = ExpenseCategory::all();

        return view('backEnd.expense.expense-category-list', $data);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:expense_categories',
        ]);
        ExpenseCategory::create($request->all());
        Toastr::success('message', 'Expense category added successfully!');

        return redirect()->route('editor.ec.index');
    }

    public function edit($id) {
        $edit_data = ExpenseCategory::find($id);

        return view('backEnd.expense.expense-category-edit', compact('edit_data'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|unique:expense_categories,name,' . $id,
        ]);

        $category = ExpenseCategory::find($id);
        $category->update($request->all());

        Toastr::success('message', 'Expense category updated successfully!');

        return redirect()->route('editor.ec.index');
    }
}
