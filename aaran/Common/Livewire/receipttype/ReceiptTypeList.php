<?php

namespace Aaran\Common\Livewire\receipttype;

use Aaran\Common\Models\Bank;
use Aaran\Common\Models\Category;
use Aaran\Common\Models\City;
use Aaran\Common\Models\Colour;
use Aaran\Common\Models\Country;
use Aaran\Common\Models\Hsncode;
use Aaran\Common\Models\Pincode;
use Aaran\Common\Models\ReceiptType;
use Aaran\Common\Models\Size;
use App\Livewire\Trait\CommonTrait;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ReceiptTypeList extends Component
{
    use CommonTrait;

    #[Validate]
    public string $vname = '';
    public bool $active_id = true;

    #region[Validation]
    public function rules(): array
    {
        return [
            'vname' => 'required:receipttypes,vname',
        ];
    }

    public function messages(): array
    {
        return [
            'vname.required' => 'The :attribute are missing.',
            'vname.unique' => 'The :attribute is already created.',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'vname' => 'name',
        ];
    }

    #endregion[Validation]

    #region[save]
    public function getSave(): void
    {
        $this->validate();

        if ($this->vid == "") {
            ReceiptType::create([
                'vname' => Str::ucfirst($this->vname),
                'active_id' => $this->active_id,
            ]);
            $message = "Saved";

        } else {
            $obj = ReceiptType::find($this->vid);
            $obj->vname = Str::ucfirst($this->vname);
            $obj->active_id = $this->active_id;
            $obj->save();
            $message = "Updated";
        }

        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }
    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->vid = '';
        $this->vname = '';
        $this->active_id = '1';
        $this->searches = '';
    }
    #endregion[Clear Fields]

    #region[obj]
    public function getObj($id): void
    {
        if ($id) {
            $obj = ReceiptType::find($id);
            $this->vid = $obj->id;
            $this->vname = $obj->vname;
            $this->active_id = $obj->active_id;
        }
    }
    #endregion

    #region[list]
    public function getList()
    {
        return ReceiptType::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    #endregion

    #region[render]
    public function render()
    {
        return view('common::receipttype.receipt-type-list')->with([
            'list' => $this->getList()
        ]);
    }
    #endregion
}