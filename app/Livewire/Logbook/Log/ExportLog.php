<?php

namespace App\Livewire\Logbook\Log;

use Aaran\Entries\Models\ExportSale;
use Aaran\Logbook\Models\Logbook;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class ExportLog extends Component
{
    use CommonTraitNew;

    #region[Property]
    public $export;
    public $exportInv;

    #endregion

    #region[Mount]
    public function mount($id)
    {
        $this->export = ExportSale::find($id);
        $this->exportInv = $this->export->invoice_no;
    }

    #endregion
    public function render()
    {
        return view('livewire.logbook.log.export-log')->with([
            'logs' => $this->getListForm->getList(Logbook::class, function ($query) {
                if ($this->salesInv) {
                    return $query->where('vname', $this->salesInv);
                }
                return $query;
            }),
        ]);
    }
}
