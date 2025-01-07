<?php

namespace App\Livewire\Conclusion\Task;

use Aaran\Conclusion\Models\ConclusionTaskItem;
use Aaran\Entries\Models\Purchase;
use Aaran\Entries\Models\Sale;
use Aaran\Master\Models\Contact;
use Aaran\Transaction\Models\Transaction;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Upsert extends Component
{
    use CommonTraitNew;
    public $conclusionTask_id;
    public $mode;
    public $taskItem=[];
    public $verified=false;
    public $startDate;
    public $endDate;
    public $contacts;
    public $contact_id;

    public function mount($id)
    {
        $this->conclusionTask_id = $id;
        $this->contacts=DB::table('contacts')->select('contacts.*')->where('company_id',session()->get('company_id'))->get();
    }

    public function createData()
    {
        if($this->mode == 1){
            $this->taskItem=Sale::all()->when($this->contact_id,function ($q){
                return $q->where('contact_id',$this->contact_id);
            })->when($this->startDate && $this->endDate,function ($q){
                return $q->whereBetween('invoice_date',[$this->startDate,$this->endDate]);
            })->toArray();
        }elseif ($this->mode == 2){
            $this->taskItem=Purchase::all()->when($this->contact_id,function ($q){
                return $q->where('contact_id',$this->contact_id);
            })->when($this->startDate && $this->endDate,function ($q){
                return $q->whereBetween('purchase_date',[$this->startDate,$this->endDate]);
            })->toArray();
        }elseif ($this->mode == 3){
            $this->taskItem=Transaction::all()->when($this->contact_id,function ($q){
                return $q->where('contact_id',$this->contact_id);
            })->when($this->startDate && $this->endDate,function ($q){
                return $q->whereBetween('vdate',[$this->startDate,$this->endDate]);
            })->where('mode_id','=','111')->toArray();
        }elseif ($this->mode == 4){
            $this->taskItem=Transaction::all()->when($this->contact_id,function ($q){
                return $q->where('contact_id',$this->contact_id);
            })->when($this->startDate && $this->endDate,function ($q){
                return $q->whereBetween('vdate',[$this->startDate,$this->endDate]);
            })->where('mode_id','=','110')->toArray();
        }
        $this->create();
    }

    public function create()
    {
        foreach ($this->taskItem as $task){
            $check=ConclusionTaskItem::where('task_item_id',$task['id'])->where('mode',$this->mode)->where('conclusion_task_id',$this->conclusionTask_id)->first();
            if (!$check) {
                ConclusionTaskItem::create([
                    'conclusion_task_id' => $this->conclusionTask_id,
                    'mode' => $this->mode,
                    'task_item_id' => $task['id'],
                    'contact_id' => $task['contact_id'],
                    'verified' => $this->verified,
                ]);
            }
        }
    }

    public function makeVerified($id)
    {
        if ($id) {
            $obj = ConclusionTaskItem::find($id);
            $obj->verified = !$obj->verified;
            $obj->save();
        }
    }

    public function getList()
    {
//        $obj = DB::table('conclusion_task_items')
//            ->select('conclusion_task_items.*', 'conclusion_task_items.mode') // Include mode in the select
//            ->where('conclusion_task_items.conclusion_task_id', '=', $this->conclusionTask_id)
//            ->when(function($query) {
//                // Check if mode is 1
//                return $query->where('conclusion_task_items.mode', '=', 1);
//            }, function($q) {
//                return $q->join('sales', 'sales.id', '=', 'conclusion_task_items.task_item_id')
//                    ->select(
//                        'conclusion_task_items.*',
//                        'sales.invoice_no as invoice_no',
//                        'sales.grand_total as grand_total'
//                    );
//            })
//            ->when(function($query) {
//                // Check if mode is 3
//                return $query->where('conclusion_task_items.mode', '=', 3);
//            }, function($q) {
//                return $q->join('transactions as receipt', 'receipt.id', '=', 'conclusion_task_items.task_item_id')
//                    ->select(
//                        'conclusion_task_items.*',
//                        'receipt.vch_no as vch_no',
//                        'receipt.vname as grand_total'
//                    );
//            })
//            ->get();
        $obj = DB::table('conclusion_task_items')
            ->select('conclusion_task_items.*', 'conclusion_task_items.mode')
            ->where('conclusion_task_items.conclusion_task_id', '=', $this->conclusionTask_id)
            ->join('contacts','contacts.id','=','conclusion_task_items.contact_id')
            ->leftJoin('sales', function ($join) {
                $join->on('sales.id', '=', 'conclusion_task_items.task_item_id')
                    ->where('conclusion_task_items.mode', '=', 1);
            })
            ->leftJoin('purchases', function ($join) {
                $join->on('purchases.id', '=', 'conclusion_task_items.task_item_id')
                    ->where('conclusion_task_items.mode', '=', 2);
            })
            ->leftJoin('transactions as receipt', function ($join) {
                $join->on('receipt.id', '=', 'conclusion_task_items.task_item_id')
                    ->where('conclusion_task_items.mode', '=', 3);
            })
            ->leftJoin('transactions as payment', function ($join) {
                $join->on('payment.id', '=', 'conclusion_task_items.task_item_id')
                    ->where('conclusion_task_items.mode', '=', 4);
            })
            ->select(
                'conclusion_task_items.*',
                'sales.invoice_no as invoice_no',
                'sales.grand_total as grand_total_sales',
                'purchases.Entry_no as entry_no',
                'purchases.grand_total as grand_total_purchase',
                'receipt.vch_no as vch_no_receipt',
                'receipt.vname as grand_total_receipt',
                'payment.vch_no as vch_no_payment',
                'payment.vname as grand_total_payment',
                'contacts.vname as contact_name'
            )
            ->get();
        return $obj;
    }

    public function render()
    {
        return view('livewire.conclusion.task.upsert')->with([
            'list'=>$this->getList(),
        ]);
    }
}
