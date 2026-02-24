<?php

namespace App\Http\Controllers\Latin;

use App\Http\Controllers\Controller;
use App\Models\Regulation;
use App\Models\SafetyCheck;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SafetyCheckController extends Controller
{
    public function index()
    {
        $checks = SafetyCheck::get();
        return view('safetycheck.index', compact('checks'));
    }

    public function create()
    {
        return view('safetycheck.create');
    }

    public function regulationForm(Request $request)
    {
        $key = $request->query('key', 0);
        return view('safetycheck.regulation-form', compact('key'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'customer' => 'required',
        //     'contact' => 'required',
        //     'previous_inspection' => 'required',
        //     'inspection_date' => 'required',
        //     'next_inspection_due' => 'required',
        //     'property_address' => 'required',
        //     'job_number' => 'required|unique:safety_checks,job_number',
        // ]);

        // 1️⃣ Save parent
        $safetycheck = SafetyCheck::create([
            'customer' => $request->customer,
            'contact' => $request->contact,
            'property_address' => $request->property_address,
            'job_number' => $request->job_number,
            'previous_inspection' => $request->previous_inspection,
            'inspection_date' => $request->inspection_date,
            'next_inspection_due' => $request->next_inspection_due,
        ]);

        // 2️⃣ Save child records
        if ($request->regulation) {

            foreach ($request->regulation as $key => $regulation) {

                $paths = [];

                if ($request->hasFile("images.$key")) {
                    foreach ($request->file("images")[$key] as $file) {
                        $paths[] = $file->store('regulations', 'public');
                    }
                }

                $safetycheck->regulations()->create([
                    'regulation' => $regulation,
                    'location' => $request->location[$key] ?? null,
                    'rectification' => $request->rectification[$key] ?? null,
                    'image'         => json_encode($paths), // Store as JSON array
                    'safety_inspection_id' => $safetycheck->id
                ]);
            }
        }

        SafetyCheck::create($request->all());

        return redirect()->route('safetycheck.index')
            ->with('success', 'Safety inspection saved successfully.');
    }

    public function exportSinglePdf($id)
    {
        $inspection = SafetyCheck::with('regulations')->findOrFail($id);

        $regulations = Regulation::where('safety_inspection_id', $id)->get();
        $pdf = Pdf::loadView('safetycheck.single_pdf', compact('inspection', 'regulations'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('inspection_' . $inspection->job_number . '.pdf');
    }
}
