<div>
    <x-slot name="header">Log</x-slot>

    <x-forms.m-panel>

        {{--        <div class="flex sm:flex-row sm:justify-between sm:items-center  flex-col gap-6 py-4 print:hidden">--}}
        {{--            <div class="w-2/4 flex items-center space-x-2">--}}

        {{--                <x-input.search-bar wire:model.live="getListForm.searches"--}}
        {{--                                    wire:keydown.escape="$set('getListForm.searches', '')" label="Search"/>--}}
        {{--                <x-input.toggle-filter :show-filters="$showFilters"/>--}}
        {{--            </div>--}}

        {{--            <div class="flex sm:justify-center justify-between">--}}
        {{--                <x-forms.per-page/>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <!-- Table Header  ------------------------------------------------------------------------------------------>

        {{--        @if(!$sales->isEmpty())--}}
        {{--            <div>hello </div>--}}
        {{--        @endif--}}

        @if($sales)
            <div>{{$sales->invoice_no}}</div>
            <div>{{$sales->contact->vname}}</div>
            <div>{{$sales->invoice_date}}</div>
            <div>{{$sales->total_qty}}</div>
            <div>{{$sales->total_taxable}}</div>
            <div>{{$sales->total_gst}}</div>
            <div>{{$sales->grand_total}}</div>
        @endif

        @foreach($logs as $index=>$row)
            @if(!$logs->isEmpty())
                <div class="w-10/12 mx-auto font-merri">Log
                </div>
            @endif
            <x-extra.timeline :list="$logs"/>
        @endforeach

    </x-forms.m-panel>
</div>
