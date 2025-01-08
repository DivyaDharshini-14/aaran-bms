<?php

namespace App\Livewire\Web\Dashboard;

use Aaran\Entries\Models\Sale;
use Livewire\Component;

class SalesChart extends Component
{

    public $monthlyTotals = [];

    public function mount():void
    {

        $this->monthlyTotals=$this->fetchMonthlyTotals();
    }

    public function fetchMonthlyTotals()
    {
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;

        // Define the start and end dates
        $startDate = "{$currentYear}-04-01"; // April 1st of the current year
        $endDate = "{$nextYear}-03-31"; // March 31st of the next year

        return Sale::selectRaw('MONTH(invoice_date) as month, YEAR(invoice_date) as year, SUM(grand_total) as total')
            ->where('company_id', '=', session()->get('company_id'))
            ->whereBetween('invoice_date', [$startDate, $endDate]) // Filter for April to March
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.web.dashboard.sales-chart')->layout('layouts.guest');
    }
}
