<div>
    <x-slot name="header">Orders</x-slot>

    <!-- Top Controls ------------------------------------------------------------------------------------------------->

    <x-forms.m-panel>

        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-table.caption :caption="'Orders'">
            {{$list->count()}}
        </x-table.caption>

        <x-table.form>

            <!-- Table Header ----------------------------------------------------------------------------------------->

            <x-slot:table_header name="table_header" class="bg-green-600">
                <x-table.header-serial width="20%"/>

                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Name
                </x-table.header-text>

                <x-table.header-text wire:click.prevent="sortBy('order_name')" sortIcon="{{$getListForm->sortAsc}}">
                    Order
                </x-table.header-text>

                <x-table.header-action/>
            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text left>{{$row->vname}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->order_name}}</x-table.cell-text>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>

                @endforeach

            </x-slot:table_body>

        </x-table.form>

        <x-modal.delete/>

        <!--Create ---------------------------------------------------------------------------------------------------->
        <x-forms.create :id="$common->vid">

            <div class="flex flex-col  gap-3">
                <x-input.floating wire:model="common.vname" label="Name"/>
                <x-input.floating wire:model="order_name" label="Order"/>
            </div>

        </x-forms.create>

        <!-- Actions ------------------------------------------------------------------------------------------->


        <div class="pt-5 w-10/12 mx-auto">{{ $list->links() }}</div>


    </x-forms.m-panel>
    <div class="px-10 py-16 space-y-4">
        @if(!$log->isEmpty())
            <div class="text-xs text-orange-600 font-merri underline underline-offset-4">Activity</div>
        @endif
        @foreach($log as $index => $row)
            <div class="px-6">
                <div class="relative ">
                    <div class=" border-l-[3px] border-dotted px-8 text-[10px]  tracking-wider py-3">
                        <div class="flex gap-x-5 ">
                            <div class="inline-flex text-gray-500 items-center font-sans font-semibold">
                                <span>Order No:</span> <span>{{$row->vname}}</span></div>
                            <div class="inline-flex  items-center space-x-1 font-merri"><span
                                    class="text-blue-600">@</span><span
                                    class="text-gray-500">{{$row->user->name}}</span>
                            </div>
                        </div>
                        <div
                            class="text-gray-400 text-[8px] font-semibold">{{date('M d, Y', strtotime($row->created_at))}}</div>
                        <div class="pb-2 font-lex leading-5 py-2 text-justify">{!! $row->description !!}</div>
                    </div>
                    <div class="absolute top-0 -left-1 h-2.5 w-2.5  rounded-full bg-teal-600 "></div>
                </div>
            </div>
        @endforeach
    </div>
</div>
