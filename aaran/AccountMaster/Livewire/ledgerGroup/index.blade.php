<div>

    <x-slot name="header">Ledger Group</x-slot>

    <!-- Top Controls ------------------------------------------------------------------------------------------------->

    <x-forms.m-panel>

        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-table.caption :caption="'Ledger Group'">
            {{$list->count()}}
        </x-table.caption>

        <x-table.form>

            <!-- Table Header ----------------------------------------------------------------------------------------->

            <x-slot:table_header name="table_header" class="bg-green-600">
                <x-table.header-serial width="20%"/>

                <x-table.header-text sortIcon="none">Accounts</x-table.header-text>

                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Name
                </x-table.header-text>

                <x-table.header-text sortIcon="none">Opening</x-table.header-text>

                <x-table.header-text sortIcon="none">Current</x-table.header-text>

                <x-table.header-action/>
            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->account_head->vname}}</x-table.cell-text>
                        <x-table.cell-text left>{{$row->vname}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->opening}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->current}}</x-table.cell-text>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>

                @endforeach

            </x-slot:table_body>

        </x-table.form>

        <!--Create ---------------------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid">

            <div class="flex flex-col  gap-3">

                <x-dropdown.wrapper label="Account Name" type="accountTyped">
                    <div class="relative">

                        <x-dropdown.input label="Account Name*" id="account_name"
                                          wire:model.live="account_name"
                                          wire:keydown.arrow-up="decrementAccount"
                                          wire:keydown.arrow-down="incrementAccount"
                                          wire:keydown.enter="enterAccount"/>
                        <x-dropdown.select>

                            @if($accountCollection)
                                @forelse ($accountCollection as $i => $account)
                                    <x-dropdown.option highlight="{{ $highlightAccount === $i }}"
                                                       wire:click.prevent="setAccount('{{$account->vname}}','{{$account->id}}')">
                                        {{ $account->vname }}
                                    </x-dropdown.option>
                                @empty
                                    <x-dropdown.new href="{{ route('accountHeads') }}" label="Account"/>
                                @endforelse
                            @endif

                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>

                <x-input.floating wire:model="common.vname" label="Name"/>

                <x-input.lookup-text wire:model="description" label="Desc"/>

                <x-input.floating wire:model="opening" label="Opening"/>

                <x-input.floating wire:model.live="opening_date" type="date" label="Opening Date"/>

                <x-input.floating wire:model="current" label="Current"/>

            </div>

        </x-forms.create>

    </x-forms.m-panel>

    <x-modal.delete/>

</div>
