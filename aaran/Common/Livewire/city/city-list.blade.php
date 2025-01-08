<div>
    <x-slot name="header">City</x-slot>
    <x-forms.m-panel>

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-forms.top-controls :show-filters="$showFilters"/>

        <!-- Table Caption -------------------------------------------------------------------------------------------->
        <x-table.caption :caption="'City'">
            {{$list->count()}}
        </x-table.caption>

        <!-- Table Data ----------------------------------------------------------------------------------------------->

        <x-table.form>
            <x-slot:table_header>
                <x-table.header-serial/>
                <x-table.header-text  wire:click.prevent="sortBy('id')"  sortIcon="{{$sortAsc}}" :left="true">
                    Name
                </x-table.header-text>
                <x-table.header-status/>
                <x-table.header-action/>
            </x-slot:table_header>

            <x-slot:table_body>
                @foreach($list as $index=>$row)
                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text left>{{$row->vname}}</x-table.cell-text>
                        <x-table.cell-status active="{{$row->active_id}}"/>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach
            </x-slot:table_body>
        </x-table.form>

        <!-- Delete Modal --------------------------------------------------------------------------------------------->
        <x-modal.delete/>

        <div class="pt-5">{{ $list->links() }}</div>

        <!-- Create/ Edit Popup --------------------------------------------------------------------------------------->

        <x-forms.create :id="$vid">
            <x-input.floating wire:model="vname" label="City Name" />
            <x-input.error-text wire:model="vname"/>
        </x-forms.create>


    </x-forms.m-panel>
</div>
