<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Repositories\Reports\SaleReportRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SaleReportController extends Controller
{

    private SaleReportRepository $repository;

    public function __construct(SaleReportRepository $repository)
    {
        $this->repository = $repository;
    }

    public function InvoicingReport(Request $request): Factory|View|Application
    {
        $data = $this->repository->getInvoicingReport($request->all());
        return view('admin.report.reportSales.reportSales', compact('data'));
    }
}
