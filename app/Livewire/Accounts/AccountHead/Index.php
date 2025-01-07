<?php

namespace App\Livewire\Accounts\AccountHead;

use Aaran\Accounts\Models\AccountHeads;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Index extends Component
{

    use CommonTraitNew;
    #region[property]
    public $description;
    public $opening;
    public $opening_date;
    public $current;


    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {
            $AccountHeads = new AccountHeads();
            $extraFields = [
                'description' => $this->description,
                'opening' => $this->opening,
                'opening_date' => $this->opening_date,
                'current' => $this->current,
                'user_id' => auth()->id(),
            ];
            $this->common->save($AccountHeads, $extraFields);
            $this->clearFields();
            $message = "Saved";
        } else {
            $AccountHeads = AccountHeads::find($this->common->vid);
            $extraFields = [
                'description' => $this->description,
                'opening' => $this->opening,
                'opening_date' => $this->opening_date,
                'current' => $this->current,
                'user_id' => auth()->id(),
            ];
            $this->common->edit($AccountHeads, $extraFields);
            $this->clearFields();
            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $AccountHeads = AccountHeads::find($id);
            $this->common->vid = $AccountHeads->id;
            $this->common->vname = $AccountHeads->vname;
            $this->description = $AccountHeads->description;
            $this->opening = $AccountHeads->opening;
            $this->opening_date = $AccountHeads->opening_date;
            $this->current = $AccountHeads->current;
            $this->common->active_id = $AccountHeads->active_id;
            return $AccountHeads;
        }
        return null;
    }
    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->description = '';
        $this->opening = '';
        $this->opening_date = Carbon::now()->format('Y-m-d');
        $this->current = '';
        $this->common->active_id = '1';
    }
    #endregion


    public function render()
    {
        return view('livewire.accounts.account-head.index')->with([
            'list' => $this->getListForm->getList(AccountHeads::class),
        ]);
    }
}
