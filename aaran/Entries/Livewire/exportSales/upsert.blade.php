<div>
    <x-slot name="header">Export Sales</x-slot>

    <div class="space-y-5 pt-10  min-h-[40rem]">
        <div class="space-y-5">
            <div class="max-w-6xl mx-auto">
                <x-tabs.tab-panel>
                    <x-slot name="tabs">
                        <x-tabs.tab>Mandatory</x-tabs.tab>
                        <x-tabs.tab>Other Additionals</x-tabs.tab>
                        <x-tabs.tab>Other Consignee</x-tabs.tab>
                    </x-slot>
                    <x-slot name="content">
                        <x-tabs.content>
                            <div class="space-y-5 py-3">
                                <div class="w-full flex gap-5 ">
                                    <div class="w-full space-y-3">
                                        <div class="h-16 ">
                                            <x-dropdown.wrapper label="Party Name" type="contactTyped">
                                                <div class="relative ">
                                                    <x-dropdown.input label="Party Name" id="contact_name"
                                                                      wire:model.live="contact_name"
                                                                      wire:keydown.arrow-up="decrementContact"
                                                                      wire:keydown.arrow-down="incrementContact"
                                                                      wire:keydown.enter="enterContact"/>
                                                    @error('contact_id')
                                                    <span class="text-red-500">{{'The Party Name is Required.'}}</span>
                                                    @enderror
                                                    <x-dropdown.select>
                                                        @if($contactCollection)
                                                            @forelse ($contactCollection as $i => $contact)
                                                                <x-dropdown.option
                                                                    highlight="{{$highlightContact === $i  }}"
                                                                    wire:click.prevent="setContact('{{$contact->vname}}','{{$contact->id}}')">
                                                                    {{ $contact->vname }}
                                                                </x-dropdown.option>
                                                            @empty
                                                                {{--                                                <x-dropdown.new href="{{route('contacts.upsert',['0'])}}"--}}
                                                                {{--                                                                label="Party"/>--}}
                                                                @livewire('controls.model.contact-model',['0'])

                                                            @endforelse
                                                        @endif
                                                    </x-dropdown.select>
                                                </div>
                                            </x-dropdown.wrapper>
                                            @error('contact_name')
                                            <span class="text-red-400">{{$message}}</span>@enderror
                                        </div>
                                        <div class="h-16 ">
                                            @if(\Aaran\Aadmin\Src\SaleEntry::hasOrder())
                                                <x-dropdown.wrapper label="Order NO" type="orderTyped">
                                                    <div class="relative ">
                                                        <x-dropdown.input label="Order NO" id="order_name"
                                                                          wire:model.live="order_name"
                                                                          wire:keydown.arrow-up="decrementOrder"
                                                                          wire:keydown.arrow-down="incrementOrder"
                                                                          wire:keydown.enter="enterOrder"/>
                                                        @error('order_id')
                                                        <span class="text-red-500">{{'The Order is Required.'}}</span>
                                                        @enderror
                                                        <x-dropdown.select>
                                                            @if($orderCollection)
                                                                @forelse ($orderCollection as $i => $order)
                                                                    <x-dropdown.option
                                                                        highlight="{{$highlightOrder === $i  }}"
                                                                        wire:click.prevent="setOrder('{{$order->vname}}','{{$order->id}}')">
                                                                        {{ $order->vname }}
                                                                    </x-dropdown.option>
                                                                @empty
                                                                    @livewire('controls.model.order-model',[$order_name])
                                                                @endforelse
                                                            @endif
                                                        </x-dropdown.select>
                                                    </div>
                                                </x-dropdown.wrapper>
                                            @endif
                                        </div>
                                        <div class="h-16">
                                            <x-input.model-select wire:model.live="currency_type"
                                                                  :label="'Currency Type'">
                                                <option value="">Choose...</option>
                                                @foreach(\App\Enums\CurrencyType::cases() as $currency)
                                                    <option
                                                        value="{{$currency->value}}">{{$currency->getName()}}</option>
                                                @endforeach
                                            </x-input.model-select>

                                        </div>
                                        <div class="h-16">
                                            <x-input.floating wire:model.live="ex_rate" :label="'Exchange Rate'"/>
                                        </div>
                                    </div>
                                    <div class="w-full space-y-3">
                                        <div class="h-16">
                                            <x-input.floating wire:model="invoice_no" label="Invoice No"/>
                                        </div>
                                        <div class="h-16">
                                            <x-input.model-date wire:model="invoice_date" label="Invoice Date"/>
                                        </div>
                                        <div class="h-16">
                                            <x-input.floating wire:model.live="sales_type" :label="'Sales Type'"/>
                                        </div>
                                        <div class="h-16">
                                            @if(\Aaran\Aadmin\Src\SaleEntry::hasStyle())
                                                <x-dropdown.wrapper label="Style" type="style_name">
                                                    <div class="relative ">

                                                        <x-dropdown.input label="Style" id="style_name"
                                                                          wire:model.live="style_name"
                                                                          wire:keydown.arrow-up="decrementStyle"
                                                                          wire:keydown.arrow-down="incrementStyle"
                                                                          wire:keydown.enter="enterStyle"/>
                                                        <x-dropdown.select>

                                                            @if($styleCollection)
                                                                @forelse ($styleCollection as $i => $style)
                                                                    <x-dropdown.option
                                                                        highlight="{{$highlightStyle === $i  }}"
                                                                        wire:click.prevent="setStyle('{{$style->vname}}','{{$style->id}}')">
                                                                        {{ $style->vname }}
                                                                    </x-dropdown.option>
                                                                @empty
                                                                    @livewire('controls.model.style-model',[$style_name])
                                                                @endforelse
                                                            @endif
                                                        </x-dropdown.select>

                                                    </div>
                                                </x-dropdown.wrapper>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-4 pb-4  text-lg font-merri tracking-wider text-orange-600 underline underline-offset-4 underline-orange-500">
                                Exports Sales Items
                            </div>
                            <div class="w-full flex  gap-x-1 pb-4">
                                <div class="w-[20%]">
                                    <x-input.model-select wire:model.live="pkgs_type" :label="'Pkgs Type'">
                                        <option value="">Choose...</option>
                                        @foreach(\App\Enums\PackageType::cases() as $packageType)
                                            <option value="{{$packageType->value}}">{{$packageType->getName()}}</option>
                                        @endforeach
                                    </x-input.model-select>
                                </div>
                                <div class="">
                                    <x-input.floating id="dc" wire:model.live="no_of_count" label="No of Count"/>
                                </div>
                                <div class="">
                                    <x-dropdown.wrapper label="Product Name" type="productTyped">
                                        <div class="relative ">
                                            <x-dropdown.input label="Particulars" id="product_name"
                                                              wire:model.live="product_name"
                                                              wire:keydown.arrow-up="decrementProduct"
                                                              wire:keydown.arrow-down="incrementProduct"
                                                              wire:keydown.enter="enterProduct"/>
                                            <x-dropdown.select>
                                                @if($productCollection)
                                                    @forelse ($productCollection as $i => $product)
                                                        <x-dropdown.option highlight="{{$highlightProduct === $i  }}"
                                                                           wire:click.prevent="setProduct('{{$product->vname}}','{{$product->id}}','{{$product->gstpercent_id}}')">
                                                            {{ $product->vname }} &nbsp;-&nbsp; GST&nbsp;:
                                                            &nbsp;{{\Aaran\Entries\Models\Sale::commons($product->gstpercent_id)}}
                                                            %
                                                        </x-dropdown.option>
                                                    @empty
                                                        @livewire('controls.model.product-model',[$product_name])
                                                    @endforelse
                                                @endif
                                            </x-dropdown.select>
                                        </div>
                                    </x-dropdown.wrapper>
                                </div>
                                @if(\Aaran\Aadmin\Src\SaleEntry::hasProductDescription())
                                    <div class="">
                                        <x-input.floating id="qty" wire:model.live="description" label="description"/>
                                    </div>
                                @endif
                                @if(\Aaran\Aadmin\Src\SaleEntry::hasColour())
                                    <div class="w-[10%]">
                                        <x-dropdown.wrapper label="Colour Name" type="colourTyped">
                                            <div class="relative ">
                                                <x-dropdown.input label="Colour Name" id="colour_name"
                                                                  wire:model.live="colour_name"
                                                                  wire:keydown.arrow-up="decrementColour"
                                                                  wire:keydown.arrow-down="incrementColour"
                                                                  wire:keydown.enter="enterColour"/>
                                                <x-dropdown.select>
                                                    @if($colourCollection)
                                                        @forelse ($colourCollection as $i => $colour)
                                                            <x-dropdown.option highlight="{{$highlightColour === $i  }}"
                                                                               wire:click.prevent="setColour('{{$colour->vname}}','{{$colour->id}}')">
                                                                {{ $colour->vname }}
                                                            </x-dropdown.option>
                                                        @empty
                                                            <x-dropdown.new
                                                                wire:click.prevent="colourSave('{{$colour_name}}')"
                                                                label="Colour"/>
                                                        @endforelse
                                                    @endif
                                                    {{--                                            <x-dropdown.option2  wire:click.prevent="colourSave('{{$colour_name}}')" label="Colour" />--}}

                                                </x-dropdown.select>
                                            </div>
                                        </x-dropdown.wrapper>
                                    </div>
                                @endif
                                @if(\Aaran\Aadmin\Src\SaleEntry::hasSize())
                                    <div class="w-[10%]">
                                        <x-dropdown.wrapper label="Size Name" type="sizeTyped">
                                            <div class="relative ">
                                                <x-dropdown.input label="Size Name" id="size_name"
                                                                  wire:model.live="size_name"
                                                                  wire:keydown.arrow-up="decrementSize"
                                                                  wire:keydown.arrow-down="incrementSize"
                                                                  wire:keydown.enter="enterSize"/>
                                                @error('size_id')
                                                <span class="text-red-500">{{'The Size name is Required.'}}</span>
                                                @enderror
                                                <x-dropdown.select>
                                                    @if($sizeCollection)
                                                        @forelse ($sizeCollection as $i => $size)
                                                            <x-dropdown.option highlight="{{$highlightSize === $i  }}"
                                                                               wire:click.prevent="setSize('{{$size->vname}}','{{$size->id}}')">
                                                                {{ $size->vname }}
                                                            </x-dropdown.option>
                                                        @empty
                                                            <x-dropdown.new
                                                                wire:click.prevent="sizeSave('{{$size_name}}')"
                                                                label="Size"/>
                                                        @endforelse
                                                    @endif
                                                    {{--                                            <x-dropdown.option2  wire:click.prevent="colourSave('{{$colour_name}}')" label="Size" />--}}

                                                </x-dropdown.select>
                                            </div>
                                        </x-dropdown.wrapper>
                                    </div>
                                @endif
                                <div class="w-[10%]">
                                    <x-input.floating id="qty" wire:model.live="qty" label="Quantity"/>
                                </div>

                                <div class="w-[10%]">
                                    <x-input.floating id="price" wire:model.live="price" label="Price"/>
                                </div>
                                <x-button.add wire:click="addItems"/>

                            </div>
                            <div class="w-full border rounded-lg overflow-hidden">
                                <table class="w-full text-xs ">
                                    <tr class="bg-zinc-50  text-gray-400 border-b font-medium font-sans tracking-wider">
                                        <th class="py-4 border-r">#</th>
                                        <th class="border-r">Pkgs Type</th>
                                        <th class="border-r">No of Count</th>
                                        <th class="border-r">PRODUCT</th>
                                        @if(\Aaran\Aadmin\Src\SaleEntry::hasColour())
                                            <th class="border-r">COLOUR</th>
                                        @endif
                                        @if(\Aaran\Aadmin\Src\SaleEntry::hasSize())
                                            <th class="border-r">SIZE</th>
                                        @endif
                                        <th class="border-r">QYT</th>
                                        <th class="border-r">PRICE</th>
                                        <th class="border-r">TAXABLE</th>
                                        <th class="border-r">ACTION</th>
                                    </tr>
                                    @if ($itemList)
                                        @foreach($itemList as $index => $row)
                                            <tr class="text-center border-b font-lex tracking-wider hover:bg-amber-50">
                                                <td class="py-2 border-r">
                                                    <button class="w-full h-full cursor-pointer"
                                                            wire:click.prevent="changeItems({{$index}})">
                                                        {{$index+1}}
                                                    </button>
                                                </td>


                                                <td class="border-r cursor-pointer"
                                                    wire:click.prevent="changeItems({{$index}})">{{ \App\Enums\PackageType::tryFrom($row['pkgs_type'])->getName()}}</td>

                                                <td class="border-r cursor-pointer"
                                                    wire:click.prevent="changeItems({{$index}})">{{$row['no_of_count']}}</td>

                                                <td class="border-r cursor-pointer"
                                                    wire:click.prevent="changeItems({{$index}})">
                                                    <div>{{$row['product_name']}}
                                                        @if($row['description'])
                                                            &nbsp;-&nbsp;
                                                        @endif
                                                        @if(\Aaran\Aadmin\Src\SaleEntry::hasProductDescription())
                                                            {{ $row['description']}}
                                                        @endif
                                                    </div>

                                                </td>

                                                @if(\Aaran\Aadmin\Src\SaleEntry::hasColour())
                                                    <td class="border-r cursor-pointer"
                                                        wire:click.prevent="changeItems({{$index}})">{{$row['colour_name']}}</td>
                                                @endif

                                                @if(\Aaran\Aadmin\Src\SaleEntry::hasSize())
                                                    <td class="border-r cursor-pointer"
                                                        wire:click.prevent="changeItems({{$index}})">{{$row['size_name']}}</td>
                                                @endif

                                                <td class="border-r cursor-pointer"
                                                    wire:click.prevent="changeItems({{$index}})">{{$row['qty']+0}}</td>
                                                <td class="border-r cursor-pointer"
                                                    wire:click.prevent="changeItems({{$index}})">{{$row['price']}}</td>
                                                <td class="border-r cursor-pointer"
                                                    wire:click.prevent="changeItems({{$index}})">{{$row['taxable']}}</td>

                                                {{--                                            <td class="px-2 text-right border border-gray-300 cursor-pointer"--}}
                                                {{--                                                wire:click.prevent="changeItems({{$index}})">{{$row['gst_amount']}}</td>--}}
                                                {{--                                            <td class="px-2 text-right border border-gray-300 cursor-pointer"--}}
                                                {{--                                                wire:click.prevent="changeItems({{$index}})">{{$row['subtotal']}}</td>--}}
                                                <td class="">
                                                    <x-button.delete wire:click.prevent="removeItems({{$index}})"/>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    <tr class="bg-zinc-50 text-gray-400 text-center font-sans tracking-wider">
                                        <td colspan="6" class="py-2 border-r">&nbsp;TOTALS&nbsp;&nbsp;&nbsp;</td>
                                        <td class="border-r">{{$total_qty+0}}</td>
                                        <td class="border-r">&nbsp;</td>
                                        <td class="border-r">{{$total_taxable}}</td>
                                        <td class="">&nbsp;</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="max-w-6xl mx-auto flex justify-end items-start gap-5">
                                <div class="w-1/3 flex text-xs text-400 px-4">
                                    <div class="w-2/4 space-y-4 text-gray-400 font-merri tracking-wider">
                                        <div>Taxable No</div>
                                        <div>GST</div>
                                        <div>Round off</div>
                                        <div class="font-semibold">Grand Total</div>
                                    </div>
                                    <div class="w-1/4 text-center space-y-4 ">
                                        <div>:</div>
                                        <div>:</div>
                                        <div>:</div>
                                        <div>:</div>
                                    </div>
                                    <div class="w-1/4 text-end space-y-4 tracking-wider font-lex">
                                        <div>{{number_format($total_taxable,2,'.','')}}</div>
                                        <div>{{number_format($total_gst,2,'.','')}}</div>
                                        <div>{{$round_off}}</div>
                                        <div class="font-semibold">{{number_format($grand_total,2,'.','')}}</div>
                                    </div>
                                </div>
                            </div>
                        </x-tabs.content>
                        <x-tabs.content>
                            <div class="space-y-5 py-3">
                                <div class="w-full flex gap-5 ">
                                    <div class="w-full space-y-3">
                                        <div class="h-16 ">
                                            <x-input.model-select wire:model.live="pre_carriage"
                                                                  :label="'Pre-Carriage by'">
                                                <option value="">Choose...</option>
                                                @foreach(\App\Enums\PreCarriage::cases() as $preCarriage)
                                                    <option
                                                        value="{{$preCarriage->value}}">{{$preCarriage->getName()}}</option>
                                                @endforeach
                                            </x-input.model-select>
                                        </div>
                                        <div class="h-16">
                                            <x-input.floating wire:model.live="vessel_flight_no"
                                                              :label="'Vessel/Flight No'"/>
                                        </div>
                                        <div class="h-16">
                                            <x-input.floating wire:model.live="port_of_discharge"
                                                              :label="'Port of Discharge'"/>

                                        </div>
                                        <div class="h-16">
                                            <x-input.floating wire:model.live="additional" :label="'Additional'"/>

                                        </div>
                                    </div>
                                    <div class="w-full space-y-3">
                                        <div class="h-16">
                                            <x-input.floating wire:model.live="place_of_Receipt"
                                                              :label="'Place of Receipt by'"/>
                                        </div>
                                        <div class="h-16">
                                            <x-input.floating wire:model.live="port_of_loading"
                                                              :label="'Port of Loading'"/>
                                        </div>
                                        <div class="h-16">
                                            <x-input.floating wire:model.live="final_destination"
                                                              :label="'Final Destination'"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-tabs.content>
                        <x-tabs.content>
                            <div class="flex gap-3">
                                <x-dropdown.wrapper label="Party Name" type="consigneeTyped">
                                    <div class="relative ">
                                        <x-dropdown.input label="Party Name" id="consignee_name"
                                                          wire:model.live="consignee_name"
                                                          wire:keydown.arrow-up="decrementConsignee"
                                                          wire:keydown.arrow-down="incrementConsignee"
                                                          wire:keydown.enter="enterConsignee"/>
                                        @error('consignee_id')
                                        <span class="text-red-500">{{'The Party Name is Required.'}}</span>
                                        @enderror
                                        <x-dropdown.select>
                                            @if($consigneeCollection)
                                                @forelse ($consigneeCollection as $i => $consignee)
                                                    <x-dropdown.option highlight="{{$highlightConsignee === $i}}"
                                                                       wire:click.prevent="setConsignee('{{$consignee->vname}}','{{$consignee->id}}')">
                                                        {{ $consignee->vname }}
                                                    </x-dropdown.option>
                                                @empty
                                                    <x-dropdown.new href="{{route('contacts.upsert',['0'])}}"
                                                                    label="Party"/>
                                                @endforelse
                                            @endif
                                        </x-dropdown.select>
                                    </div>
                                </x-dropdown.wrapper>
                                <x-button.add wire:click="addConsignee"/>
                            </div>

                            <section>
                                <div class="py-2 mt-5 overflow-x-auto">

                                    <table class="overflow-x-auto md:w-full ">
                                        <thead>
                                        <tr class="h-8 text-xs bg-gray-100 border border-gray-300">

                                            <th class="w-12 px-2 text-center border border-gray-300">#</th>

                                            <th class="px-2 text-center border border-gray-300">Pkgs Type</th>

                                            <th class="w-12 px-1 text-center border border-gray-300">ACTION</th>
                                        </tr>
                                        </thead>

                                        <!--Display Table Items ------------------------------------------------------------------------------->
                                        <tbody>

                                        @if ($consigneeList)

                                            @foreach($consigneeList as $index => $row)

                                                <tr class="border border-gray-400 hover:bg-amber-50">
                                                    <td class="text-center border border-gray-300 bg-gray-100">
                                                        <button class="w-full h-full cursor-pointer"
                                                                wire:click.prevent="changeConsignee({{$index}})">
                                                            {{$index+1}}
                                                        </button>
                                                    </td>


                                                    <td class="px-2 text-left border border-gray-300 cursor-pointer"
                                                        wire:click.prevent="changeConsignee({{$index}})">{{$row['contact_name']}}</td>


                                                    <td class="text-center border border-gray-300">
                                                        <x-button.delete
                                                            wire:click.prevent="removeConsignee({{$index}})"/>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>

                                </div>

                            </section>

                        </x-tabs.content>
                    </x-slot>
                </x-tabs.tab-panel>

            </div>

        </div>
    </div>
    <div class="max-w-6xl mx-auto">
        @if( $common->vid != "")
            <x-forms.m-panel-bottom-button routes="{{ route('exportsales', [$this->common->vid])}}" save back print/>
        @else
            <x-forms.m-panel-bottom-button save back/>
        @endif
    </div>

    <div class="max-w-6xl mx-auto px-10  py-16 space-y-4">
        @if(!$exportLogs->isEmpty())
            <div class="text-xs text-orange-600  font-merri underline underline-offset-4">Activity</div>
        @endif
        @foreach($exportLogs as $row)
            <div class="px-6">
                <div class="relative ">
                    <div class=" border-l-[3px] border-dotted px-8 text-[10px]  tracking-wider py-3">
                        <div class="flex gap-x-5 ">
                            <div class="inline-flex text-gray-500 items-center font-sans font-semibold">
                                <span>Invoice No:</span> <span>{{$row->vname}}</span></div>
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
