<?php


namespace App\Repositories\Reports;


use App\Enums\SaleEnum;
use App\Models\Sale;

class SaleReportRepository
{

    private Sale $saleModel;

    public function __construct(Sale $saleModel)
    {
        $this->saleModel = $saleModel;
    }

    public function getInvoicingReport(array $payload): array
    {
        $reportValue = Sale::selectRaw('IF(status = "A", SUM(value), 0) as approved_value')
            ->selectRaw('IF(status = "P", SUM(value), 0) as pendent_value')
            ->selectRaw('IF(status = "C", SUM(value), 0) as canceled_value')
            ->selectRaw('count(1) as sales')
            ->groupBy('status')
            ->first();


        $sales = Sale::orderBy('id', 'DESC')
            ->paginate(15);

        return (array)[
            'values' => $reportValue,
            'sales' => $sales
        ];
    }
}
