<?php

namespace Aaran\Master\Livewire\contact;

use Aaran\AccountMaster\Models\Ledger;
use Aaran\Common\Models\City;
use Aaran\Common\Models\Common;
use Aaran\Common\Models\Country;
use Aaran\Common\Models\Pincode;
use Aaran\Common\Models\State;
use Aaran\Logbook\Models\Logbook;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\ContactDetail;
use App\Livewire\Trait\CommonTraitNew;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Upsert extends Component
{
    use CommonTraitNew;

    #region[Contact properties]
    #[Validate]
    public $vname;
    public $active_id;
    public $vid;
    public string $mobile = '';
    public string $whatsapp = '';
    public string $contact_person = '';
    public $contact_type_id = '';
    public string $msme_no = '';
    public string $msme_type_id = '';
    public mixed $opening_balance = 0;
    public mixed $outstanding = 0;
    public string $effective_from = '';
    public mixed $route;
    #endregion

    #region[Address Properties]
    #[validate]
    public $gstin = '';
    public $email = '';
    public $address_type;
    public $log;
//    public $ledger_id;
    #endregion

    #region[rules]
    public function rules(): array
    {
        return [
            'vname' => 'required|unique:contacts,vname',
            'gstin' => 'required|unique:contacts,gstin',
            'itemList.0.address_1' => 'required',
            'itemList.0.address_2' => 'required',
            'itemList.0.city_name' => 'required',
            'itemList.0.state_name' => 'required',
            'itemList.0.pincode_name' => 'required',
            'itemList.0.country_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'vname.required' => ' :attribute is required.',
            'gstin.required' => ' :attribute is required.',
            'vname.unique' => ' :attribute is already taken.',
            'gstin.unique' => ' :attribute is already taken.',
            'itemList.0.address_1.required' => ' :attribute  is required.',
            'itemList.0.address_2.required' => ' :attribute  is required.',
            'itemList.0.city_name.required' => ' :attribute  is required.',
            'itemList.0.state_name.required' => ' :attribute  is required.',
            'itemList.0.pincode_name.required' => ' :attribute  is required.',
            'itemList.0.country_name' => ' :attribute  is required.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'vname' => 'contact name',
            'gstin' => 'GST No',
            'itemList.0.address_1' => 'Address',
            'itemList.0.address_2' => 'Area Road',
            'itemList.0.city_name' => 'City name',
            'itemList.0.state_name' => 'State name',
            'itemList.0.pincode_name' => 'Pincode name',
            'itemList.0.country_name' => 'Country name',
        ];
    }
    #endregion

    #region[array]
    #[validate]
    public $itemList = [];
    public mixed $itemIndex = '';
    public $secondaryAddress = [];
    public $addressIncrement = 0;
    public $openTab = 0;
    #endregion

    #region[addAddress]
    public function addAddress($id)
    {
        $this->addressIncrement = $id + 1;
        if (!in_array($this->addressIncrement, $this->secondaryAddress, true)) {
            $this->secondaryAddress[] = $this->addressIncrement;
        } elseif (!in_array(($this->addressIncrement + 1), $this->secondaryAddress, true)) {
            $this->secondaryAddress[] = $this->addressIncrement + 1;
        }


        $this->itemList[] = [
            'contact_detail_id' => 0,
            'address_type' => 'Secondary',
            "state_name" => "",
            "state_id" => "",
            "city_id" => "",
            "city_name" => "",
            "country_id" => "",
            "country_name" => "",
            "pincode_id" => "",
            "pincode_name" => "",
            "address_1" => "",
            "address_2" => "",
        ];
        $this->city_name = "";
        $this->state_name = "";
        $this->country_name = "";
        $this->pincode_name = "";
        $this->city_id = '';
        $this->state_id = '';
        $this->country_id = '';
        $this->pincode_id = '';
    }
    #endregion

    #region[removeAddress]
    public function removeAddress($id, $value): void
    {
        $this->openTab = 0;
        $this->addressIncrement = $value - 1;
        unset($this->secondaryAddress[$id]);
        $this->removeItems($value);
    }
    #endregion

    #region[sortSearch]
    public function sortSearch($id): void
    {
        $this->openTab = $id;
    }
    #endregion

    #region[city]
    public $city_id = '';
    public $city_name = '';
    public Collection $cityCollection;
    public $highlightCity = 0;
    public $cityTyped = false;

    public function decrementCity(): void
    {
        if ($this->highlightCity === 0) {
            $this->highlightCity = count($this->cityCollection) - 1;
            return;
        }
        $this->highlightCity--;
    }

    public function incrementCity(): void
    {
        if ($this->highlightCity === count($this->cityCollection) - 1) {
            $this->highlightCity = 0;
            return;
        }
        $this->highlightCity++;
    }

    public function setCity($name, $id): void
    {
        $this->city_name = $name;
        $this->city_id = $id;
        $this->getCityList();
    }

    public function enterCity(): void
    {
        $obj = $this->cityCollection[$this->highlightCity] ?? null;

        $this->city_name = '';
        $this->cityCollection = Collection::empty();
        $this->highlightCity = 0;

        $this->city_name = $obj['vname'] ?? '';
        $this->city_id = $obj['id'] ?? '';
    }

    #[On('refresh-city')]
    public function refreshCity($v): void
    {
        $this->city_id = $v['id'];
        $this->city_name = $v['name'];
        $this->cityTyped = false;
    }

    public function citySave($name)
    {
        $obj = City::create([
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshcity($v);
    }

    public function getCityList(): void
    {
        $this->cityCollection = $this->city_name ? City::search(trim($this->city_name))
            ->get() : City::all();
    }
#endregion

    #region[state]
    public $state_id = '';
    public $state_name = '';
    public Collection $stateCollection;
    public $highlightState = 0;
    public $stateTyped = false;

    public function decrementState(): void
    {
        if ($this->highlightState === 0) {
            $this->highlightState = count($this->stateCollection) - 1;
            return;
        }
        $this->highlightState--;
    }

    public function incrementState(): void
    {
        if ($this->highlightState === count($this->stateCollection) - 1) {
            $this->highlightState = 0;
            return;
        }
        $this->highlightState++;
    }

    public function setState($name, $id): void
    {
        $this->state_name = $name;
        $this->state_id = $id;
        $this->getStateList();
    }

    public function enterState(): void
    {
        $obj = $this->stateCollection[$this->highlightState] ?? null;

        $this->state_name = '';
        $this->stateCollection = Collection::empty();
        $this->highlightState = 0;

        $this->state_name = $obj['vname'] ?? '';;
        $this->state_id = $obj['id'] ?? '';;
    }

    #[On('refresh-state')]
    public function refreshState($v): void
    {
        $this->state_id = $v['id'];
        $this->state_name = $v['name'];
        $this->stateTyped = false;

    }

    public function stateSave($name)
    {
        $obj = State::create([
            'vname' => $name,
            'active_id' => '1'
        ]);
//        $v = ['name' => $name, 'id' => $obj->id];
//        $this->refreshState($v);
    }

    public function getStateList(): void
    {
        $this->stateCollection = $this->state_name ? State::search(trim($this->state_name))
            ->get() : State::all();
    }
    #endregion

    #region[pin-code]
    public $pincode_id = '';
    public $pincode_name = '';
    public Collection $pincodeCollection;
    public $highlightPincode = 0;
    public $pincodeTyped = false;

    public function decrementPincode(): void
    {
        if ($this->highlightPincode === 0) {
            $this->highlightPincode = count($this->pincodeCollection) - 1;
            return;
        }
        $this->highlightPincode--;
    }

    public function incrementPincode(): void
    {
        if ($this->highlightPincode === count($this->pincodeCollection) - 1) {
            $this->highlightPincode = 0;
            return;
        }
        $this->highlightPincode++;
    }

    public function enterPincode(): void
    {
        $obj = $this->pincodeCollection[$this->highlightPincode] ?? null;

        $this->pincode_name = '';
        $this->pincodeCollection = Collection::empty();
        $this->highlightPincode = 0;

        $this->pincode_name = $obj['vname'] ?? '';;
        $this->pincode_id = $obj['id'] ?? '';;
    }

    public function setPincode($name, $id): void
    {
        $this->pincode_name = $name;
        $this->pincode_id = $id;
        $this->getPincodeList();
    }

    #[On('refresh-pincode')]
    public function refreshPincode($v): void
    {
        $this->pincode_id = $v['id'];
        $this->pincode_name = $v['name'];
        $this->pincodeTyped = false;
    }

    public function pincodeSave($name)
    {
        $obj = Pincode::create([
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshPincode($v);
    }

    public function getPincodeList(): void
    {
        $this->pincodeCollection = $this->pincode_name ? Pincode::search(trim($this->pincode_name))
            ->get() : Pincode::all();
    }
    #endregion

    #region[country]
    public $country_id = '';
    public $country_name = '';
    public Collection $countryCollection;
    public $highlightCountry = 0;
    public $countryTyped = false;

    public function decrementCountry(): void
    {
        if ($this->highlightCountry === 0) {
            $this->highlightCountry = count($this->countryCollection) - 1;
            return;
        }
        $this->highlightCountry--;
    }

    public function incrementCountry(): void
    {
        if ($this->highlightCountry === count($this->countryCollection) - 1) {
            $this->highlightCountry = 0;
            return;
        }
        $this->highlightCountry++;
    }

    public function setCountry($name, $id): void
    {
        $this->country_name = $name;
        $this->country_id = $id;
        $this->getCountryList();
    }

    public function enterCountry(): void
    {
        $obj = $this->countryCollection[$this->highlightCountry] ?? null;

        $this->country_name = '';
        $this->countryCollection = Collection::empty();
        $this->highlightCountry = 0;

        $this->country_name = $obj['vname'] ?? '';
        $this->country_id = $obj['id'] ?? '';
    }

    #[On('refresh-country')]
    public function refreshCountry($v): void
    {
        $this->country_id = $v['id'];
        $this->country_name = $v['name'];
        $this->countryTyped = false;
    }

    public function getCountryList(): void
    {
        $this->countryCollection = $this->country_name ? Country::search(trim($this->country_name))
            ->get() : Country::all();
    }
#endregion

    #region[ledger]
    public $ledger_id = '';
    public $ledger_name = '';
    public Collection $ledgerCollection;
    public $highlightLedger = 0;
    public $ledgerTyped = false;

    public function decrementLedger(): void
    {
        if ($this->highlightLedger === 0) {
            $this->highlightLedger = count($this->ledgerCollection) - 1;
            return;
        }
        $this->highlightLedger--;
    }

    public function incrementLedger(): void
    {
        if ($this->highlightLedger === count($this->ledgerCollection) - 1) {
            $this->highlightLedger = 0;
            return;
        }
        $this->highlightLedger++;
    }

    public function setLedger($name, $id): void
    {
        $this->ledger_name = $name;
        $this->ledger_id = $id;
        $this->getLedgerList();
    }

    public function enterLedger(): void
    {
        $obj = $this->ledgerCollection[$this->highlightLedger] ?? null;

        $this->ledger_name = '';
        $this->ledgerCollection = Collection::empty();
        $this->highlightLedger = 0;

        $this->ledger_name = $obj['vname'] ?? '';
        $this->ledger_id = $obj['id'] ?? '';
    }

    #[On('refresh-ledger')]
    public function refreshLedger($v): void
    {
        $this->ledger_id = $v['id'];
        $this->ledger_name = $v['name'];
        $this->ledgerTyped = false;
    }

    public function ledgerSave($name)
    {
        $obj = Ledger::create([
            'vname' => $name,
            'active_id' => '1'
        ]);
//        $v = ['name' => $name, 'id' => $obj->id];
//        $this->refreshState($v);
    }

    public function getLedgerList(): void
    {
        $this->ledgerCollection = $this->ledger_name ? Ledger::search(trim($this->ledger_name))
            ->get() : Ledger::all();
    }
#endregion

//    #region[City]
//    #[validate]
//    public $city_name = '';
//    public $city_id = '';
//    public Collection $cityCollection;
//    public $highlightCity = 0;
//    public $cityTyped = false;
//
//    public function decrementCity(): void
//    {
//        if ($this->highlightCity === 0) {
//            $this->highlightCity = count($this->cityCollection) - 1;
//            return;
//        }
//        $this->highlightCity--;
//    }
//
//    public function incrementCity(): void
//    {
//        if ($this->highlightCity === count($this->cityCollection) - 1) {
//            $this->highlightCity = 0;
//            return;
//        }
//        $this->highlightCity++;
//    }
//
//    public function setCity($name, $id, $index=null): void
//    {
//        $this->city_name = $name;
//        $this->city_id = $id;
//        Arr::set($this->itemList[$index], 'city_name', $name);
//        Arr::set($this->itemList[$index], 'city_id', $id);
//
//        $this->getCityList();
//    }
//
//    public function enterCity($index): void
//    {
//        $obj = $this->cityCollection[$this->highlightCity] ?? null;
//
//        $this->city_name = '';
//        $this->cityCollection = Collection::empty();
//        $this->highlightCity = 0;
//
//        $this->city_name = $obj['vname'] ?? '';;
//        $this->city_id = $obj['id'] ?? '';
//        Arr::set($this->itemList[$index], 'city_name', $obj['vname']);
//        Arr::set($this->itemList[$index], 'city_id', $obj['id']);
//
//    }
//
//    #[On('refresh-city')]
//    public function refreshCity($v, $index): void
//    {
//        $this->city_id = $v['id'];
//        $this->city_name = $v['name'];
//        Arr::set($this->itemList[$index], 'city_name', $v['name']);
//        Arr::set($this->itemList[$index], 'city_id', $v['id']);
//
//        $this->cityTyped = false;
//
//    }
//
//    public function citySave($name, $index)
//    {
//        $obj = Common::create([
//            'label_id' => 2,
//            'vname' => $name,
//            'active_id' => '1'
//        ]);
//        $v = ['name' => $name, 'id' => $obj->id];
//        $this->refreshCity($v, $index);
//    }
//
//    public function getCityList(): void
//    {
//        $this->cityCollection = $this->itemList[$this->openTab]['city_name']
//            ? Common::search(trim($this->itemList[$this->openTab]['city_name']))->where('label_id', '=', '2')->get()
//            : Common::where('label_id', '=', '2')->Orwhere('label_id', '=', '1')->get();
//    }
//    #endregion
//
//    #region[State]
//    #[validate]
//    public $state_name = '';
//    public $state_id = '';
//    public Collection $stateCollection;
//    public $highlightState = 0;
//    public $stateTyped = false;
//
//    public function decrementState(): void
//    {
//        if ($this->highlightState === 0) {
//            $this->highlightState = count($this->stateCollection) - 1;
//            return;
//        }
//        $this->highlightState--;
//    }
//
//    public function incrementState(): void
//    {
//        if ($this->highlightState === count($this->stateCollection) - 1) {
//            $this->highlightState = 0;
//            return;
//        }
//        $this->highlightState++;
//    }
//
//    public function setState($name, $id, $index): void
//    {
//        $this->state_name = $name;
//        $this->state_id = $id;
//        Arr::set($this->itemList[$index], 'state_name', $name);
//        Arr::set($this->itemList[$index], 'state_id', $id);
//        $this->getStateList();
//    }
//
//    public function enterState($index): void
//    {
//        $obj = $this->stateCollection[$this->highlightState] ?? null;
//
//        $this->state_name = '';
//        $this->stateCollection = Collection::empty();
//        $this->highlightState = 0;
//
//        $this->state_name = $obj['vname'] ?? '';;
//        $this->state_id = $obj['id'] ?? '';;
//        Arr::set($this->itemList[$index], 'state_name', $obj['vname']);
//        Arr::set($this->itemList[$index], 'state_id', $obj['id']);
//    }
//
//    #[On('refresh-state')]
//    public function refreshState($v): void
//    {
//        $this->state_id = $v['id'];
//        $this->state_name = $v['name'];
//        Arr::set($this->itemList[$v['index']], 'state_name', $v['name']);
//        Arr::set($this->itemList[$v['index']], 'state_id', $v['id']);
//        $this->stateTyped = false;
//    }
//
//    public function stateSave($name, $index): void
//    {
//        $obj = Common::create([
//            'label_id' => 3,
//            'vname' => $name,
//            'active_id' => '1'
//        ]);
//        $v = ['name' => $name, 'id' => $obj->id, 'index' => $index];
//        $this->refreshState($v);
//    }
//
//    public function getStateList(): void
//    {
//        $this->stateCollection = $this->itemList[$this->openTab]['state_name']
//            ? Common::search(trim($this->itemList[$this->openTab]['state_name']))->where('label_id', '=', '3')
//                ->get() : Common::where('label_id', '=', '3')->Orwhere('id', '=', '1')->get();
//    }
//    #endregion
//
//    #region[Pincode]
//    #[validate]
//    public $pincode_id = '';
//    public $pincode_name = '';
//    public Collection $pincodeCollection;
//    public $highlightPincode = 0;
//    public $pincodeTyped = false;
//
//    public function decrementPincode(): void
//    {
//        if ($this->highlightPincode === 0) {
//            $this->highlightPincode = count($this->pincodeCollection) - 1;
//            return;
//        }
//        $this->highlightPincode--;
//    }
//
//    public function incrementPincode(): void
//    {
//        if ($this->highlightPincode === count($this->pincodeCollection) - 1) {
//            $this->highlightPincode = 0;
//            return;
//        }
//        $this->highlightPincode++;
//    }
//
//    public function enterPincode($index): void
//    {
//        $obj = $this->pincodeCollection[$this->highlightPincode] ?? null;
//
//        $this->pincode_name = '';
//        $this->pincodeCollection = Collection::empty();
//        $this->highlightPincode = 0;
//
//        $this->pincode_name = $obj['vname'] ?? '';;
//        $this->pincode_id = $obj['id'] ?? '';;
//        Arr::set($this->itemList[$index], 'pincode_name', $obj['vname']);
//        Arr::set($this->itemList[$index], 'pincode_id', $obj['id']);
//    }
//
//    public function setPincode($name, $id, $index): void
//    {
//        $this->pincode_name = $name;
//        $this->pincode_id = $id;
//        Arr::set($this->itemList[$index], 'pincode_name', $name);
//        Arr::set($this->itemList[$index], 'pincode_id', $id);
//        $this->getPincodeList();
//    }
//
//    #[On('refresh-pincode')]
//    public function refreshPincode($v): void
//    {
//        $this->pincode_id = $v['id'];
//        $this->pincode_name = $v['name'];
//        Arr::set($this->itemList[$v['index']], 'pincode_name', $v['name']);
//        Arr::set($this->itemList[$v['index']], 'pincode_id', $v['id']);
//        $this->pincodeTyped = false;
//    }
//
//    public function pincodeSave($name, $index)
//    {
//        $obj = Common::create([
//            'label_id' => 4,
//            'vname' => $name,
//            'active_id' => '1'
//        ]);
//        $v = ['name' => $name, 'id' => $obj->id,'index' => $index];
//        $this->refreshPincode($v);
//    }
//
//    public function getPincodeList(): void
//    {
//        $this->pincodeCollection = $this->itemList[$this->openTab]['pincode_name']
//            ? Common::search(trim($this->itemList[$this->openTab]['pincode_name']))->where('label_id', '=', '4')
//                ->get() : Common::where('label_id', '=', '4')->Orwhere('id', '=', '1')->get();
//    }
//
//    #endregion
//
//    #region[Country]
//    #[validate]
//    public $country_name = '';
//    public $country_id = '';
//    public Collection $countryCollection;
//    public $highlightCountry = 0;
//    public $countryTyped = false;
//
//    public function decrementCountry(): void
//    {
//        if ($this->highlightCountry === 0) {
//            $this->highlightCountry = count($this->countryCollection) - 1;
//            return;
//        }
//        $this->highlightCountry--;
//    }
//
//    public function incrementCountry(): void
//    {
//        if ($this->highlightCountry === count($this->countryCollection) - 1) {
//            $this->highlightCountry = 0;
//            return;
//        }
//        $this->highlightCountry++;
//    }
//
//    public function enterCountry($index): void
//    {
//        $obj = $this->countryCollection[$this->highlightCountry] ?? null;
//
//        $this->country_name = '';
//        $this->countryCollection = Collection::empty();
//        $this->highlightCountry = 0;
//
//        $this->country_name = $obj['vname'] ?? '';;
//        $this->country_id = $obj['id'] ?? '';;
//        Arr::set($this->itemList[$index], 'country_name', $obj['vname']);
//        Arr::set($this->itemList[$index], 'country_id', $obj['id']);
//    }
//
//    public function setCountry($name, $id, $index): void
//    {
//        $this->country_name = $name;
//        $this->country_id = $id;
//        Arr::set($this->itemList[$index], 'country_name', $name);
//        Arr::set($this->itemList[$index], 'country_id', $id);
//        $this->getcountryList();
//    }
//
//    #[On('refresh-country')]
//    public function refreshCountry($v, $index): void
//    {
//        $this->country_id = $v['id'];
//        $this->country_name = $v['name'];
//        Arr::set($this->itemList[$index], 'country_name', $v['name']);
//        Arr::set($this->itemList[$index], 'country_id', $v['id']);
//        $this->countryTyped = false;
//    }
//
//    public function countrySave($name, $index)
//    {
//        $obj = Common::create([
//            'label_id' => 5,
//            'vname' => $name,
//            'active_id' => '1'
//        ]);
//        $v = ['name' => $name, 'id' => $obj->id];
//        $this->refreshCountry($v, $index);
//    }
//
//    public function getCountryList(): void
//    {
//        $this->countryCollection = $this->itemList[$this->openTab]['country_name']
//            ? Common::search(trim($this->itemList[$this->openTab]['country_name']))->where('label_id', '=', '5')
//                ->get() : Common::where('label_id', '=', '5')->Orwhere('id', '=', '1')->get();
//    }
//
//    #endregion

    #region[Save]
    public function save(): void
    {
        if ($this->vname != '') {
            if ($this->vid == "") {
                $this->validate($this->rules());

                $ledger = Ledger::create([
                    'vname' => Str::upper($this->vname),
                    'description' => $this->vname,
                    'ledger_group_id' => '10',
                    'opening' => '0',
                    'opening_date' => '',
                    'current' => '0',
                    'active_id' => '1',
                    'user_id' => Auth::id()
                ]);

                $obj = Contact::create([
                    'ledger_id' => $ledger->id,
                    'vname' => Str::upper($this->vname),
                    'mobile' => $this->mobile,
                    'whatsapp' => $this->whatsapp,
                    'contact_person' => $this->contact_person,
                    'contact_type_id' => $this->contact_type_id ?: '1',
                    'msme_no' => $this->msme_no ?: '-',
                    'msme_type_id' => $this->msme_type_id ?: '1',
                    'opening_balance' => $this->opening_balance ?: 0,
                    'outstanding' => $this->outstanding ?: 0,
                    'effective_from' => $this->effective_from,
                    'active_id' => $this->active_id,
                    'gstin' => Str::upper($this->gstin),
                    'email' => $this->email,
                    'user_id' => Auth::id(),
                    'company_id' => session()->get('company_id'),
                ]);
                $this->saveItem($obj->id);
                $this->common->logEntry('Contact name: '.$this->common->vname,$this->gstin,'create',$this->vname.'has been created');
                $message = "Saved";
                $this->getRoute();
            } else {
                $obj = Contact::find($this->vid);
                $obj->ledger_id = $this->ledger_id;
                $obj->vname = Str::upper($this->vname);
                $obj->mobile = $this->mobile;
                $obj->whatsapp = $this->whatsapp;
                $obj->contact_person = $this->contact_person;
                $obj->contact_type_id = $this->contact_type_id;
                $obj->msme_no = $this->msme_no;
                $obj->msme_type_id = $this->msme_type_id;
                $obj->opening_balance = $this->opening_balance ?: 0;
                $obj->outstanding = $this->outstanding ?: 0;
                $obj->effective_from = $this->effective_from;
                $obj->gstin = $this->gstin;
                $obj->email = $this->email;
                $obj->active_id = $this->active_id;
                $obj->user_id = Auth::id();
                $obj->company_id = session()->get('company_id');
                $obj->save();

                $this->saveItem($obj->id);
                $this->common->logEntry('Contact name: '.$this->common->vname,'Contact','update',$this->vname.' has been updated');
                $message = "Updated";
                $this->getRoute();
            }
            $this->vname = '';
            $this->mobile = '';
            $this->whatsapp = '';
            $this->contact_person = '';
            $this->contact_type_id = '';
            $this->msme_no = '';
            $this->msme_type_id = '';
            $this->opening_balance = '';
            $this->effective_from = '';
            $this->gstin = '';
            $this->email = '';
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
    }
    #endregion

    #region[Save Item]
    public function saveItem($id): void
    {
        if ($this->itemList != null) {
            foreach ($this->itemList as $sub) {
                if ($sub['contact_detail_id'] === 0 && $sub['address_1'] != "") {
                    ContactDetail::create([
                        'contact_id' => $id,
                        'address_type' => $sub['address_type'],
                        'address_1' => $sub['address_1'],
                        'address_2' => $sub['address_2'],
                        'city_id' => $sub['city_id'] ?: 1,
                        'state_id' => $sub['state_id'] ?: 1,
                        'pincode_id' => $sub['pincode_id'] ?: 1,
                        'country_id' => $sub['country_id'] ?: 1,
                    ]);
                } elseif ($sub['contact_detail_id'] != 0 && $sub['address_1'] != "") {
                    $detail = ContactDetail::find($sub['contact_detail_id']);
                    $detail->address_type = $sub['address_type'];
                    $detail->address_1 = $sub['address_1'];
                    $detail->address_2 = $sub['address_2'];
                    $detail->city_id = $sub['city_id'];
                    $detail->state_id = $sub['state_id'];
                    $detail->pincode_id = $sub['pincode_id'];
                    $detail->country_id = $sub['country_id'];
                    $detail->save();
                }
            }
        } else {
            ContactDetail::create([
                'contact_id' => $id,
                'address_type' => 'Primary',
                'address_1' => '-',
                'address_2' => '-',
                'city_id' => 1,
                'state_id' => 1,
                'pincode_id' => 1,
                'country_id' => 1,
            ]);
        }
    }
    #endregion

    #region[Mount]
    public function mount($id): void
    {
        $this->route = url()->previous();
        if ($id != 0) {
            $obj = Contact::find($id);
            $this->vid = $obj->id;
            $this->vname = $obj->vname;
            $this->mobile = $obj->mobile;
            $this->whatsapp = $obj->whatsapp;
            $this->contact_person = $obj->contact_person;
            $this->contact_type_id = $obj->contact_type_id;
            $this->msme_no = $obj->msme_no;
            $this->msme_type_id = $obj->msme_type_id;
            $this->opening_balance = $obj->opening_balance;
            $this->outstanding = $obj->outstanding;
            $this->effective_from = $obj->effective_from;
            $this->gstin = $obj->gstin;
            $this->email = $obj->email;
//            $this->ledger_id = $obj->ledger_id;
            $this->active_id = $obj->active_id;

            $data = DB::table('contact_details')
                ->select(
                    'contact_details.*',
                    'city.vname as city_name',
                    'state.vname as state_name',
                    'country.vname as country_name',
                    'pincode.vname as pincode_name'
                )
                ->join('cities as city', 'city.id', '=', 'contact_details.city_id')
                ->join('states as state', 'state.id', '=', 'contact_details.state_id')
                ->join('countries as country', 'country.id', '=', 'contact_details.country_id')
                ->join('pincodes as pincode', 'pincode.id', '=', 'contact_details.pincode_id')
                ->where('contact_id', '=', $id)
                ->get()
                ->transform(function ($data) {
                    return [
                        'contact_detail_id' => $data->id,
                        'address_type' => $data->address_type,
                        'city_name' => $data->city_name,
                        'city_id' => $data->city_id,
                        'state_name' => $data->state_name,
                        'state_id' => $data->state_id,
                        'pincode_name' => $data->pincode_name,
                        'pincode_id' => $data->pincode_id,
                        'country_name' => $data->country_name,
                        'country_id' => $data->country_id,
                        'address_1' => $data->address_1,
                        'address_2' => $data->address_2,
                    ];
                });
            $this->itemList = $data->toArray();
            for ($j = 0; $j < $data->skip(1)->count(); $j++) {
                $this->secondaryAddress[] = $j + 1;
            }
        } else {
//            $this->effective_from = Carbon::now()->format('Y-m-d');
            $this->active_id = true;
            $this->itemList[0] = [
                "contact_detail_id" => 0,
                'address_type' => $this->address_type ?: "Primary",
                "state_name" => "-",
                "state_id" => "1",
                "city_id" => "1",
                "city_name" => "-",
                "country_id" => "1",
                "country_name" => "-",
                "pincode_id" => "1",
                "pincode_name" => "-",
                "address_1" => "-",
                "address_2" => "-",
            ];
            $this->address_type = "Primary";
        }
    }
    #endregion

    #region[removeItems]
    public function removeItems($index): void
    {
        $items = $this->itemList[$index];
        unset($this->itemList[$index]);
        if ($items['contact_detail_id'] != 0) {
            $obj = ContactDetail::find($items['contact_detail_id']);
            $obj->delete();
        }
    }
    #endregion

    #region[Route]
    public function getRoute(): void
    {
        $this->redirect(route('contacts'));
    }

    public function render()
    {
        $this->log = Logbook::where('model_name',$this->gstin)->get();
        $this->getCityList();
        $this->getStateList();
        $this->getPincodeList();
        $this->getCountryList();
        $this->getLedgerList();
        return view('master::contact.upsert');
    }
    #endregion
}
