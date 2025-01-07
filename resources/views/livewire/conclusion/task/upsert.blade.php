<div>
    <x-slot name="header">{{\Aaran\Conclusion\Models\ConclusionTask::find($conclusionTask_id)->vname}}</x-slot>
    <x-forms.m-panel>
        <div class="w-full flex justify-between gap-8">
            <div class="w-full">
                <x-input.model-select wire:model.live="mode" label="Mode">
                    <option value="">Choose...</option>
                    <option value="1">Sales</option>
                    <option value="2">Purchase</option>
                    <option value="3">Receipt</option>
                    <option value="4">Payment</option>
                </x-input.model-select>
            </div>
            <div class="w-full">
                <x-input.model-select wire:model.live="contact_id" label="Party">
                    <option value="">Choose...</option>
                    @foreach($contacts as $contact)
                        <option value="{{$contact->id}}"><span class="uppercase">{{$contact->vname}}</span></option>
                    @endforeach
                </x-input.model-select>
            </div>
            <div class="w-full">
                <x-input.floating wire:model.live="startDate" label="Start Date" type="date"/>
            </div>
            <div class="w-full">
                <x-input.floating wire:model.live="endDate" label="End Date" type="date"/>
            </div>
            <div class="w-full inline-flex justify-end items-end">
                <x-button.new-x wire:click="createData"/>
            </div>
        </div>

        <!-- Table Data ----------------------------------------------------------------------------------------------->

        <x-table.form>
            <x-slot:table_header>

                <x-table.header-serial/>
                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Party Name
                </x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Inv NO
                </x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Amount
                </x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Status
                </x-table.header-text>
            </x-slot:table_header>

            <x-slot:table_body>
                @foreach($list as $index=>$row)
                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text><span class="uppercase">{{$row->contact_name}}</span></x-table.cell-text>
                        <x-table.cell-text>
                            <span class="uppercase">
                                @if($row->mode==1)
                                    {{$row->invoice_no+0}}
                                @elseif($row->mode==2)
                                    {{$row->entry_no+0}}
                                @elseif($row->mode==3)
                                    {{$row->vch_no_receipt+0}}
                                @elseif($row->mode==4)
                                    {{$row->vch_no_payment+0}}
                                @endif
                            </span>
                        </x-table.cell-text>
                        <x-table.cell-text>
                            <span class="uppercase">
                                @if($row->mode==1)
                                    {{$row->grand_total_sales}}
                                @elseif($row->mode==2)
                                    {{$row->grand_total_purchase}}
                                @elseif($row->mode==3)
                                    {{$row->grand_total_receipt}}
                                @elseif($row->mode==4)
                                    {{$row->grand_total_payment}}
                                @endif
                            </span>
                        </x-table.cell-text>
                        <x-table.cell-text>
                            @if($row->verified)
                                <x-input.checkbox checked wire:click="makeVerified({{$row->id}})"/>
                            @else
                                <x-input.checkbox wire:click="makeVerified({{$row->id}})"/>
                            @endif
                        </x-table.cell-text>
                    </x-table.row>
                @endforeach
            </x-slot:table_body>
        </x-table.form>

        <!-- Delete Modal --------------------------------------------------------------------------------------------->
        <x-modal.delete/>
    </x-forms.m-panel>
</div>
