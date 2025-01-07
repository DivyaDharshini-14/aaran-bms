<?php

namespace App\Livewire\Logbook\Log;

use Aaran\Entries\Models\Purchase;
use Aaran\Logbook\Models\Logbook;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class PurchaseLog extends Component
{
    use CommonTraitNew;

    #region[Property]
    public $purchase;
    public $purchaseInv;

    #endregion

    #region[Mount]
    public function mount($id)
    {
        $this->purchase = Purchase::find($id);
        $this->purchaseInv = $this->purchase->purchase_no;
    }

    #endregion
    public function render()
    {
        return view('livewire.logbook.log.purchase-log')->with([
            'logs' => $this->getListForm->getList(Logbook::class, function ($query) {
                if ($this->purchaseInv) {
                    return $query->where('vname', $this->purchaseInv);
                }
                return $query;
            }),
        ]);
    }

}
