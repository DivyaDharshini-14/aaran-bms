<?php

namespace App\Livewire\Common;

use App\Livewire\Trait\CommonTrait;
use Aaran\Common\Models\State;
use Illuminate\Support\Str;
use Livewire\Component;

class StateList extends Component
{
    use CommonTrait;

    #region[properties]
    public mixed $state_code;
    #endregion

    #region[save]
    public function getSave(): string
    {
        if ($this->vname != '') {
            if ($this->vid == "") {
                $this->validate(['vname' => 'required|unique:states,vname']);
                State::create([
                    'vname' => Str::ucfirst($this->vname),
                    'state_code' => Str::upper($this->state_code),
                    'active_id' => $this->active_id,
                ]);
                $message = "Saved";

            } else {
                $obj = State::find($this->vid);
                $obj->vname = Str::ucfirst($this->vname);
                $obj->state_code = Str::upper($this->state_code);
                $obj->active_id = $this->active_id;
                $obj->save();
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
        return '';
    }
    #endregion

    #region[obj]
    public function getObj($id)
    {
        if ($id) {
            $obj = State::find($id);
            $this->vid = $obj->id;
            $this->vname = $obj->vname;
            $this->state_code = $obj->state_code;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }
    #endregion

    #region[list]
    public function getList()
    {
        return State::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    #endregion

    #region[render]
    public function reRender(): void
    {
        $this->render()->render();
    }

    public function render()
    {
        return view('livewire.common.state-list')->with([
            'list' => $this->getList()
        ]);
    }
    #endregion
}
