<?php

namespace App\Livewire\Conclusion\Task;

use Aaran\Conclusion\Models\ConclusionTask;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use CommonTraitNew;
    use WithPagination;

    #region[Properties]
    public mixed $vdate;
    #endregion

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {
            $ConclusionTask = new ConclusionTask();
            $extraFields = [
                'vdate' => $this->vdate,
            ];
            $this->common->save($ConclusionTask,$extraFields);

            $message = "Saved";
        } else {
            $ConclusionTask = ConclusionTask::find($this->common->vid);
            $extraFields = [
                'vdate' => $this->vdate,
            ];
            $this->common->edit($ConclusionTask,$extraFields);
            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $ConclusionTask = ConclusionTask::find($id);
            $this->common->vid = $ConclusionTask->id;
            $this->common->vname = $ConclusionTask->vname;
            $this->vdate=$ConclusionTask->vdate;
            $this->common->active_id = $ConclusionTask->active_id;
            return $ConclusionTask;
        }
        return null;
    }
    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->common->active_id = '1';
        $this->vdate = Carbon::now()->format('Y-m-d');
    }
    #endregion

    #region[render]
    public function getRoute()
    {
        return route('conclusion.task');
    }
    public function render()
    {
        return view('livewire.conclusion.task.index') ->with([
            'list' => $this->getListForm->getList(ConclusionTask::class,function ($query){
                return $query->where('id','>','');
            }),
        ]);
    }
}
