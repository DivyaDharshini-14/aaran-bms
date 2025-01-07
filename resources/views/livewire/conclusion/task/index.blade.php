<div>
    <x-slot name="header">Verification Task</x-slot>

    <x-forms.m-panel>

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-forms.top-controls :show-filters="$showFilters"/>

        <!-- Table Caption -------------------------------------------------------------------------------------------->
        <x-table.caption :caption="'Labels'">
            {{$list->count()}}
        </x-table.caption>

        <!-- Table Data ----------------------------------------------------------------------------------------------->

        <x-table.form>
            <x-slot:table_header>
                <x-table.header-serial/>
                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Task
                </x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Date
                </x-table.header-text>
                <x-table.header-action/>
            </x-slot:table_header>

            <x-slot:table_body>
                @foreach($list as $index=>$row)
                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text><span class="uppercase"><a href="{{route('conclusion.task.upsert',[$row->id])}}">{{$row->vname}}</a></span></x-table.cell-text>
                        <x-table.cell-text><a href="{{route('conclusion.task.upsert',[$row->id])}}">{{date('d-m-Y', strtotime($row->vdate))}}</a></x-table.cell-text>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach
            </x-slot:table_body>
        </x-table.form>

        <!-- Delete Modal --------------------------------------------------------------------------------------------->
        <x-modal.delete/>

        <div class="pt-5">{{ $list->links() }}</div>

        <!-- Create/ Edit Popup --------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid">
            <div class="space-y-5">
                <x-input.floating wire:model="common.vname" label="Task Name"/>
                <x-input.floating wire:model="vdate" type="date" label="Date"/>
            </div>
        </x-forms.create>

    </x-forms.m-panel>


</div>
