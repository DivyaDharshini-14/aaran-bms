<?php

namespace App\Livewire\Logbook;

use Aaran\Entries\Models\Sale;
use Aaran\Logbook\Models\Logbook;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class CommonLog extends Component
{
    use CommonTraitNew;

    #region[Property]
    public $sales;
    public $salesInv;

    #endregion

    #region[Mount]
    public function mount($id)
    {
        $this->sales = Sale::find($id);
        $this->salesInv = $this->sales->invoice_no;
    }

    #endregion
    public function render()
    {
        return view('livewire.logbook.common-log')->with([
            'logs' => $this->getListForm->getList(Logbook::class, function ($query) {
                if ($this->salesInv) {
                    return $query->where('vname', $this->salesInv);
                }
                return $query;
            }),
        ]);
    }
}
