<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Categories available for campus reports.
     *
     * @return array<string>
     */
    protected function categories(): array
    {
        return [
            'Fasilitas Kampus',
            'Akademik & Perkuliahan',
            'Kebersihan Lingkungan',
            'Keamanan & Ketertiban',
            'Layanan Administrasi',
            'Organisasi & Kemahasiswaan',
            'Lainnya',
        ];
    }

    /**
     * Display a listing of user reports (Laporan Saya).
     */
    public function index(Request $request): View
    {
        $reports = $request->user()
            ?->reports()
            ->latest()
            ->paginate(10) ?? Report::query()->whereRaw('1 = 0')->paginate(10);

        return view('reports.index', [
            'reports' => $reports,
        ]);
    }

    /**
     * Show the form for creating a new report (Buat Laporan).
     */
    public function create(): View
    {
        return view('reports.create', [
            'categories' => $this->categories(),
        ]);
    }

    /**
     * Store a newly created report in storage.
     */
    public function store(StoreReportRequest $request): RedirectResponse
    {
        $attachmentPath = null;
        $attachmentOriginalName = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $attachmentOriginalName = $file->getClientOriginalName();
            $attachmentPath = $file->store('reports', 'public');
        }

        Report::create([
            'user_id' => $request->user()?->id,
            'category' => $request->validated('category'),
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'location' => $request->validated('location'),
            'attachment_path' => $attachmentPath,
            'attachment_original_name' => $attachmentOriginalName,
            'is_anonymous' => $request->boolean('is_anonymous'),
            'status' => 'pending',
        ]);

        return redirect()
            ->route('reports.create')
            ->with('success', 'Laporan Anda berhasil dikirim dan akan segera ditindaklanjuti oleh pihak kampus.');
    }

    /**
     * Display the specified report.
     */
    public function show(Report $report, Request $request): View
    {
        if ($report->user_id !== null && $report->user_id !== $request->user()?->id) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        return view('reports.show', [
            'report' => $report,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report): View
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report): RedirectResponse
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report): RedirectResponse
    {
        abort(404);
    }
}
