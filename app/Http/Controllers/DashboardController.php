<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Enroll;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index(Request $request) {
        $enroll_query = Enroll::with('batch')->latest();

        if (is_numeric($request->batch)) {
            $enroll_query->where('batch_id', $request->batch);
        }

        $data = [
            'batches' => Batch::all(),
            'enrolls' => $enroll_query->get(),
        ];

        return view('dashboard.enroll.index', $data);
    }

    public function enroll_edit(Enroll $enroll) {
        $data = [
            'batches' => Batch::all(),
            'enroll' => $enroll,
        ];
        return view('dashboard.enroll.modal.edit', $data);
    }

    public function enroll_update(Request $request) {
        $enroll = Enroll::find($request->id);

        $enroll->name = $request->name;
        $enroll->mobile = $request->mobile;
        $enroll->batch_id = $request->batch_id;
        $enroll->payment_method = $request->payment_method;
        $enroll->transaction = $request->transaction;
        $enroll->amount = $request->amount;
        $enroll->tshirt_size = $request->tshirt_size;
        $enroll->guest = $request->guest;
        $enroll->save();
        session()->flash('success', 'Updated successfully.');

        return response()->json([
            'success' => true,
        ]);
    }

    public function enroll_delete(Enroll $enroll) {
        $enroll->delete();
        return back()->with('success', 'Deleted successfully.');
    }
}
