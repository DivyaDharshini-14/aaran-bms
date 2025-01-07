<?php

namespace App\Livewire\Demo\Data\Transaction;

use Aaran\Common\Models\Common;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\Order;
use Aaran\Transaction\Models\AccountBook;
use Aaran\Transaction\Models\Transaction;
use Livewire\Component;

class Index extends Component
{
    public $count = 25;

    public function loadDummy()
    {
        $this->Transaction();
    }

    private function Transaction()
    {
        for ($i = 0; $i < $this->count; $i++) {
            $contact = Contact::pluck('id')->random();
            $company = Company::pluck('id')->random();
            $account_book = AccountBook::pluck('id')->random();
            $order = Order::pluck('id')->random();
            $trans_type = Common::where('label_id', '=', '19')->pluck('id')->random();
            $mode = Common::where('label_id', '=', '20')->pluck('id')->random();
            if ($trans_type == 108) {
                $receipttype = 85;
            } else {
                $receipttype = Common::where('label_id', '=', '14')->where('id', '!=', '85')->pluck('id')->random();
            }
            $instrument_bank = Common::where('label_id', '=', '25')->pluck('id')->random();

            $obj = Transaction::create([
                'acyear' => session()->get('acyear'),
                'account_book_id' => $account_book,
                'company_id' => $company,
                'contact_id' => $contact,
                'vch_no'=>Transaction::nextNo($mode),
                'paid_to' => '-',
                'order_id' => $order,
                'trans_type_id' => $trans_type,
                'mode_id' => $mode,
                'vdate' => date('Y-m-d'),
                'vname' => fake()->numberBetween(1000, 999999),
                'receipttype_id' => $receipttype,
                'remarks' => '-',
                'chq_no' => fake()->numberBetween(100000, 999999),
                'chq_date' => date('Y-m-d'),
                'instrument_bank_id' => $instrument_bank,
                'deposit_on' => date('Y-m-d'),
                'realised_on' => date('Y-m-d'),
                'against_id' => '1',
                'verified_by' => '-',
                'verified_on' => date('Y-m-d'),
                'ref_no' => fake()->numberBetween(1, 100),
                'ref_amount' => fake()->numberBetween(1000, 999999),
                'user_id' => auth()->id(),
                'active_id' => 1,


            ]);
            $updateContact = Contact::where('id', $contact)->first();
            $updateContact->outstanding = $updateContact->outstanding - $obj->vname;
            $updateContact->save();
        }
        $successMessage = 'Transaction Create Successfully.';
        $this->dispatch('notify', ...['type' => 'success', 'content' => $successMessage]);
    }

    public function render()
    {
        return view('livewire.demo.data.transaction.index');
    }
}
