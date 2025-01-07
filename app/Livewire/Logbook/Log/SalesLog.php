<?php

namespace App\Livewire\Logbook\Log;

use Aaran\Entries\Models\Sale;
use Aaran\Entries\Models\Saleitem;
use Aaran\Logbook\Models\Logbook;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class SalesLog extends Component
{
    use CommonTraitNew;

    #region[Property]
    public $sales;
    public $salesInv;

    public $salesItems;
    public $sales_id;

    #endregion

    #region[Mount]
    public function mount($id)
    {
        $this->sales = Sale::find($id);
        $this->salesInv = $this->sales->invoice_no;
        $this->sales_id = $this->sales->id;
    }

    public function getSalesItems()
    {
        $this->salesItems = SaleItem::where('sale_id', $this->sales_id)->get();
    }

    #endregion
    public function render()
    {
        $this->getSalesItems();
        return view('livewire.logbook.log.sales-log')->with([
            'logs' => $this->getListForm->getList(Logbook::class, function ($query) {
                if ($this->salesInv) {
                    return $query->where('vname', $this->salesInv);
                }
                return $query;
            }),
        ]);
    }
}
