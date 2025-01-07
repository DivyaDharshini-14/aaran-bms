<?php

namespace App\Livewire\DataTransfer;

use Aaran\Common\Models\Common;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\Contact;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public function getCommon(): void
    {
        // Define the mappings of tables to their respective label IDs
        $tableMappings = [
            'cities' => 2,
            'states' => 3,
            'pincodes' => 4,
            'countries' => 5,
            'hsncodes' => 6,
            'colours' => 7,
            'sizes' => 8,
            'banks' => 9,
            'ledgers' => 10,
            'transports' => 11,
            'departments' => 12,
            'receipttypes' => 14,
            'categories' => 18,
        ];

        // Loop through each table mapping
        foreach ($tableMappings as $tableName => $labelId) {
            // Fetch old records from the destination database
            $oldRecords = DB::connection('destination')->table($tableName)->get();
            // Insert records into commons if they don't exist
            foreach ($oldRecords as $oldRecord) {
                $this->insertIfNotExists($oldRecord->vname, $labelId, $oldRecord->active_id);
            }
        }

        $this->dispatch('notify', ...['type' => 'success', 'content' => 'Common Migrated Successfully']);
    }


    private function insertIfNotExists(string $vname, int $labelId, ?int $activeId): void
    {
        // Check if the vname exists in commons
        $exists = DB::table('commons')->where('vname', $vname)->first();

        // If it does not exist, insert it
        if (!$exists) {
            Common::create([
                'label_id' => $labelId,
                'vname' => $vname,
                'desc' => '-',
                'desc_1' => '1',
                'active_id' => $activeId,
            ]);
        }
    }

    public function getCompany()
    {
        // Fetch all old companies from the destination database
        $oldCompanies = DB::connection('destination')->table('companies')->get();
        foreach ($oldCompanies as $oldCompany) {
            // Check if the company already exists in the current database
            $exists = DB::table('companies')->where('vname', $oldCompany->vname)->exists();
            // If it doesn't exist, prepare to create a new company
            if (!$exists) {
                // Convert stdClass to array
                $oldCompanyArray = (array) $oldCompany;
                // Fetch related data (city, state, pin code)
                $locationData = $this->getLocationData($oldCompanyArray);
                unset($oldCompanyArray['msme_type'], $oldCompanyArray['id']);
                // Create a new company with the gathered data
                Company::create(array_merge($oldCompanyArray, [
                    'city_id' => $locationData['city_id'],
                    'state_id' => $locationData['state_id'],
                    'pincode_id' => $locationData['pincode_id'],
                    'country_id' => 60,
                    'msme_type_id' => 126,
                ]));
            }
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => 'Company Migrated Successfully']);
    }


    private function getLocationData($oldCompany)
    {
        return [
            'city_id' => DB::table('commons')->where('vname', DB::connection('destination')->table('cities')->where('id', $oldCompany['city_id'])->value('vname'))->value('id'),
            'state_id' => DB::table('commons')->where('vname', DB::connection('destination')->table('states')->where('id', $oldCompany['state_id'])->value('vname'))->value('id'),
            'pincode_id' => DB::table('commons')->where('vname', DB::connection('destination')->table('pincodes')->where('id', $oldCompany['pincode_id'])->value('vname'))->value('id'),
        ];
    }

    public function getContact()
    {
        $oldContacts = DB::connection('destination')->table('contacts')->get();
        foreach ($oldContacts as $oldContact) {
            $oldContactDetails=DB::connection('destination')->table('contact_details')->where('contact_id', $oldContact->id)->get();

            foreach ($oldContactDetails as $oldContactDetail) {
                $exists = DB::table('contacts')->where('vname', $oldContact->vname)->exists();
                $oldContactArray = (array)$oldContact;
//            $locationData=$this->getLocationData($oldContactArray);
                if ($oldContactArray['contact_type'] == 1) {
                    $contact_type_id = 124;
                } else {
                    $contact_type_id = 123;
                }
                unset($oldContactArray['msme_type'], $oldContactArray['contact_type'], $oldContactArray['id']);
                Contact::create(array_merge($oldContactArray, [
                    'msme_type_id' => 126,
                    'contact_type_id' => $contact_type_id,
                    'gstin'=>$oldContactDetail->gstin,
                    'email'=>$oldContactDetail->email,
                ]));

            }
        }
    }
    public function migrateData():void
    {

        $this->getContact();
    }
    public function render()
    {
        return view('livewire.data-transfer.index');
    }
}
