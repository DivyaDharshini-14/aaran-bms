<?php

namespace Aaran\Master\Livewire\company\Orders;

use Aaran\Logbook\Models\Logbook;
use Aaran\Master\Models\Order;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    #region[properties]
    public $order_name = '';
    public $log;
    #endregion

    public function getSave(): void
    {
        $customLabels = [
            'vname' => 'Order Name',
            'order_name' => 'Order No',
            'company_id' => 'Company ID',
        ];

        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $order = new Order();
                $extraFields = [
                    'order_name' => $this->order_name,
                    'company_id' => session()->get('company_id'),
                ];
                $this->common->save($order, $extraFields);
                $this->common->logEntry(
                    'Order_name',
                    'Order',
                    'create',
                    $this->common->vname . ' has been created'
                );
                $message = "Saved";
            } else {
                $order = Order::find($this->common->vid);
                $originalData = $order->getAttributes();

                $extraFields = [
                    'order_name' => $this->order_name,
                    'company_id' => session()->get('company_id'),
                ];
                $this->common->edit($order, $extraFields);

                $updatedData = $order->getAttributes();
                $changedData = [];
                foreach ($originalData as $key => $originalValue) {
                    if (isset($updatedData[$key]) && $updatedData[$key] != $originalValue) {
                        $fieldLabel = isset($customLabels[$key]) ? $customLabels[$key] : ucfirst(str_replace('_', ' ', $key));
                        $changedData[] = "{$fieldLabel} changed from '{$originalValue}' to '{$updatedData[$key]}'";
                    }
                }
                $action = 'Updated on ' . now(); // Store the date and time of update
                $description = '';
                if (!empty($changedData)) {
                    $description = implode(', ', $changedData); // Concatenate the change descriptions into a string
                }
                $this->common->logEntry(
                    'Order', 'Order', $action, $description
                );
                $message = "Updated";
            }

            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
    }

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $order = Order::find($id);
            $this->common->vid = $order->id;
            $this->common->vname = $order->vname;
            $this->common->active_id = $order->active_id;
            $this->order_name = $order->order_name;
            return $order;
        }
        return null;
    }
    #endregion

    #region[clearFields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->common->active_id = '1';
        $this->order_name = '';
    }
    #endregion

    #region[getRoute]
    public function getRoute()
    {
        return route('orders');
    }
    #endregion

    #region[render]
    public function render()
    {
        $this->log = Logbook::where('model_name', 'Order')->take(5)->get();
        $this->getListForm->searchField = 'order_name';

        return view('livewire.master.orders.index')->with([
            'list' => $this->getListForm->getList(Order::class, function ($query) {
                return $query->where('company_id', session()->get('company_id'));
            }),
        ]);
    }
    #endregion
}
