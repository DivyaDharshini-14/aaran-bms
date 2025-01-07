<div>
    <x-slot name="header">Purchase</x-slot>

    <div class="space-y-5 pt-10  min-h-[40rem]">
        <div class="space-y-5">
            <div class="max-w-6xl mx-auto">
                <x-tabs.tab-panel>
                    <x-slot name="tabs">
                        <x-tabs.tab>Details</x-tabs.tab>
                        <x-tabs.tab>Others</x-tabs.tab>
                        <x-tabs.tab>Additional Charges</x-tabs.tab>
                        <x-tabs.tab>Terms</x-tabs.tab>

                    </x-slot>
                    <x-slot name="content">
                        <x-tabs.content>
                            <div class="space-y-5 py-3">
                                <div class="w-full flex gap-5 ">
                                    <div class="w-full space-y-3 h-52">
                                        <div class="h-16 ">
                                            <x-dropdown.wrapper label="Party Name" type="contactTyped">
                                                <div class="relative ">
                                                    <x-dropdown.input label="Party Name" id="contact_name"
                                                                      wire:model.live.debounce="contact_name"
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
                                                                @livewire('controls.model.contact-model',[$contact_name])
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
                                        <div class="h-16 ">
                                            <x-input.floating wire:model="purchase_no" label="Purchase No"/>
                                        </div>
                                        {{--                                        <div class="h-16 ">--}}
                                        {{--                                            @if(\Aaran\Aadmin\Src\SaleEntry::hasStyle())--}}

                                        {{--                                                <x-dropdown.wrapper label="Style" type="style_name">--}}
                                        {{--                                                    <div class="relative ">--}}

                                        {{--                                                        <x-dropdown.input label="Style" id="style_name"--}}
                                        {{--                                                                          wire:model.live="style_name"--}}
                                        {{--                                                                          wire:keydown.arrow-up="decrementStyle"--}}
                                        {{--                                                                          wire:keydown.arrow-down="incrementStyle"--}}
                                        {{--                                                                          wire:keydown.enter="enterStyle"/>--}}
                                        {{--                                                        <x-dropdown.select>--}}

                                        {{--                                                            @if($styleCollection)--}}
                                        {{--                                                                @forelse ($styleCollection as $i => $style)--}}
                                        {{--                                                                    <x-dropdown.option--}}
                                        {{--                                                                        highlight="{{$highlightStyle === $i  }}"--}}
                                        {{--                                                                        wire:click.prevent="setStyle('{{$style->vname}}','{{$style->id}}')">--}}
                                        {{--                                                                        {{ $style->vname }}--}}
                                        {{--                                                                    </x-dropdown.option>--}}
                                        {{--                                                                @empty--}}
                                        {{--                                                                    @livewire('controls.model.style-model',[$style_name])--}}
                                        {{--                                                                @endforelse--}}
                                        {{--                                                            @endif--}}
                                        {{--                                                        </x-dropdown.select>--}}

                                        {{--                                                    </div>--}}
                                        {{--                                                </x-dropdown.wrapper>--}}
                                        {{--                                            @endif--}}

                                        {{--                                        </div>--}}


                                    </div>
                                    <div class="w-full space-y-3 ">
                                        <div class="h-16 ">
                                            <x-input.floating wire:model="entry_no" label="Entry No"/>
                                        </div>
                                        <div class="h-16 ">
                                            <x-input.model-date wire:model="purchase_date" label="Purchase Date"/>
                                        </div>
                                        <div class="h-16 ">
                                            <x-input.model-select wire:model="sales_type" :label="'Sales Type'">
                                                <option class="text-gray-400"> choose ..</option>
                                                <option value="1">CGST-SGST</option>
                                                <option value="2">IGST</option>
                                            </x-input.model-select>
                                        </div>
                                        <div class=" ">
                                            @if(\Aaran\Aadmin\Src\SaleEntry::hasJob_no())
                                                <x-input.floating wire:model="job_no" label="Job No"/>
                                            @endif
                                        </div>

                                        <div class="">
                                            @if(\Aaran\Aadmin\Src\SaleEntry::hasDespatch())
                                                <x-dropdown.wrapper label="Despatch No" type="despatchTyped">
                                                    <div class="relative ">
                                                        <x-dropdown.input
                                                            label="Despatch No"
                                                            id="despatch_name"
                                                            wire:model.live="despatch_name"
                                                            wire:keydown.arrow-up="decrementDespatch"
                                                            wire:keydown.arrow-down="incrementDespatch"
                                                            wire:keydown.enter="enterDespatch"/>

                                                        <x-dropdown.select>
                                                            @if($despatchCollection)
                                                                @forelse ($despatchCollection as $i => $despatch)
                                                                    <x-dropdown.option
                                                                        highlight="{{$highlightDespatch === $i  }}"
                                                                        wire:click.prevent="setDespatch('{{$despatch->vname}}','{{$despatch->id}}')">
                                                                        {{ $despatch->vname }}
                                                                    </x-dropdown.option>
                                                                @empty
                                                                    <button
                                                                        wire:click.prevent="despatchSave('{{$dispatch_name}}')"
                                                                        class="text-white bg-green-500 text-center w-full">
                                                                        create
                                                                    </button>
                                                                @endforelse
                                                            @endif
                                                        </x-dropdown.select>
                                                    </div>
                                                </x-dropdown.wrapper>
                                            @endif
                                        </div>

                                    </div>

                                </div>

                                <div
                                    class="px-4 pb-4  text-lg font-merri tracking-wider text-orange-600 underline underline-offset-4 underline-orange-500">
                                    Purchase Items
                                </div>
                                <div class="w-full flex  gap-x-1 pb-4">
                                        @if(\Aaran\Aadmin\Src\SaleEntry::hasPo_no())
                                    <div class="">
                                            <x-input.floating id="qty" wire:model.live="po_no" label="Po No"/>
                                    </div>
                                        @endif

                                        @if(\Aaran\Aadmin\Src\SaleEntry::hasDc_no())
                                    <div class="">
                                            <x-input.floating id="dc" wire:model.live="dc_no" label="DC No."/>
                                    </div>
                                        @endif
                                        @if(\Aaran\Aadmin\Src\SaleEntry::hasNo_of_roll())
                                    <div class="">
                                            <x-input.floating id="no_of_roll" wire:model.live="no_of_roll"
                                                              label="No of Roll"/>
                                    </div>
                                        @endif
                                    <div class="w-[30%]">
                                        <x-dropdown.wrapper label="Product Name" type="productTyped">
                                            <div class="relative ">
                                                <x-dropdown.input label="Product Name" id="product_name"
                                                                  wire:model.live="product_name"
                                                                  wire:keydown.arrow-up="decrementProduct"
                                                                  wire:keydown.arrow-down="incrementProduct"
                                                                  wire:keydown.enter="enterProduct"/>
                                                @error('product_id')

                                                <span class="text-red-500">{{'The Product Name is Required.'}}</span>

                                                @enderror

                                                <x-dropdown.select>
                                                    @if($productCollection)
                                                        @forelse ($productCollection as $i => $product)
                                                            <x-dropdown.option
                                                                highlight="{{$highlightProduct === $i  }}"
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
                                    <div class="w-[20%]">
                                            <x-input.floating id="qty" wire:model.live="description"
                                                              label="description"/>
                                    </div>
                                        @endif
                                        @if(\Aaran\Aadmin\Src\SaleEntry::hasColour())
                                    <div class="w-[15%]">
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
                                                                <x-dropdown.option
                                                                    highlight="{{$highlightColour === $i  }}"
                                                                    wire:click.prevent="setColour('{{$colour->vname}}','{{$colour->id}}')">
                                                                    {{ $colour->vname }}
                                                                </x-dropdown.option>
                                                            @empty
                                                                <x-dropdown.new
                                                                    wire:click.prevent="colourSave('{{$colour_name}}')"
                                                                    label="Colour"/>
                                                            @endforelse
                                                        @endif
                                                        {{--                                <x-dropdown.option2  wire:click.prevent="colourSave('{{$colour_name}}')" label="Colour" />--}}

                                                    </x-dropdown.select>
                                                </div>
                                            </x-dropdown.wrapper>
                                    </div>
                                        @endif
                                        @if(\Aaran\Aadmin\Src\SaleEntry::hasSize())
                                    <div class="w-[15%]">
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
                                                                <x-dropdown.option
                                                                    highlight="{{$highlightSize === $i  }}"
                                                                    wire:click.prevent="setSize('{{$size->vname}}','{{$size->id}}')">
                                                                    {{ $size->vname }}
                                                                </x-dropdown.option>
                                                            @empty
                                                                <x-dropdown.new
                                                                    wire:click.prevent="sizeSave('{{$size_name}}')"
                                                                    label="Size"/>
                                                            @endforelse
                                                        @endif
                                                        {{--                                <x-dropdown.option2  wire:click.prevent="colourSave('{{$colour_name}}')" label="Size" />--}}

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
                                <div class="max-w-6xl mx-auto">
                                    <div class="w-full border rounded-lg overflow-hidden">
                                        <table class="w-full text-xs ">
                                            <tr class="bg-zinc-50  text-gray-400 border-b font-medium font-sans tracking-wider">
                                                <th class="py-4 border-r">#</th>
                                                @if(\Aaran\Aadmin\Src\SaleEntry::hasPo_no())
                                                    <th class="border-r">PO</th>
                                                @endif
                                                @if(\Aaran\Aadmin\Src\SaleEntry::hasDc_no())
                                                    <th class="border-r">DC</th>
                                                @endif
                                                @if(\Aaran\Aadmin\Src\SaleEntry::hasNo_of_roll())
                                                    <th class="border-r">No 0f Rolls</th>
                                                @endif
                                                <th class="border-r">Items</th>
                                                @if(\Aaran\Aadmin\Src\SaleEntry::hasColour())
                                                    <th width="5%" class="border-r">Color</th>
                                                @endif
                                                @if(\Aaran\Aadmin\Src\SaleEntry::hasSize())
                                                    <th width="4%" class="border-r">Size</th>
                                                @endif
                                                <th width="8%" class="border-r">Quantity</th>
                                                <th width="8%" class="border-r">Rate</th>
                                                <th width="9%" class="border-r">Taxable</th>
                                                <th width="5%" class="border-r">GST Percent</th>
                                                <th width="9%" class="border-r">GST</th>
                                                <th width="9%" class="border-r">Sub Total</th>
                                                <th width="4%">Action</th>
                                            </tr>
                                            @if ($itemList)
                                                @foreach($itemList as $index => $row)
                                                    <tr class="text-center border-b font-lex tracking-wider hover:bg-amber-50">
                                                        <td class="py-2 border-r"
                                                            wire:click.prevent="changeItems({{$index}})">{{$index+1}}</td>
{{--                                                        @if(\Aaran\Aadmin\Src\SaleEntry::hasPo_no())--}}
{{--                                                            <td class="py-2 border-r"--}}
{{--                                                                wire:click.prevent="changeItems({{$index}})">{{$row['po_no']}}</td>--}}
{{--                                                        @endif--}}
{{--                                                        @if(\Aaran\Aadmin\Src\SaleEntry::hasDc_no())--}}
{{--                                                            <td class="py-2 border-r"--}}
{{--                                                                wire:click.prevent="changeItems({{$index}})">{{$row['dc_no']}}</td>--}}
{{--                                                        @endif--}}
                                                        @if(\Aaran\Aadmin\Src\SaleEntry::hasNo_of_roll())
                                                            <td class="py-2 border-r"
                                                                wire:click.prevent="changeItems({{$index}})">{{$row['no_of_roll']}}</td>
                                                        @endif
                                                        <td class="py-2 border-r"
                                                            wire:click.prevent="changeItems({{$index}})">
                                                            <div class="line-clamp-1">{{$row['product_name']}}
                                                                @if($row['description'])
                                                                    &nbsp;-&nbsp;
                                                                @endif
                                                                @if(\Aaran\Aadmin\Src\SaleEntry::hasProductDescription())
                                                                    {{ $row['description']}}
                                                                @endif
                                                            </div>
                                                        </td>
                                                        @if(\Aaran\Aadmin\Src\SaleEntry::hasColour())
                                                            <td class="py-2 border-r"
                                                                wire:click.prevent="changeItems({{$index}})">{{$row['colour_name']}}</td>
                                                        @endif
                                                        @if(\Aaran\Aadmin\Src\SaleEntry::hasSize())
                                                            <td class="py-2 border-r"
                                                                wire:click.prevent="changeItems({{$index}})">{{$row['size_name']}}</td>
                                                        @endif

                                                        <td class="py-2 border-r"
                                                            wire:click.prevent="changeItems({{$index}})">{{$row['qty']}}</td>
                                                        <td class="py-2 border-r"
                                                            wire:click.prevent="changeItems({{$index}})">{{$row['price']}}</td>
                                                        <td class="py-2 border-r"
                                                            wire:click.prevent="changeItems({{$index}})">{{number_format($row['taxable'],2,'.','')}}</td>
                                                        <td class="py-2 border-r"
                                                            wire:click.prevent="changeItems({{$index}})">{{$row['gst_percent']}}</td>
                                                        <td class="py-2 border-r"
                                                            wire:click.prevent="changeItems({{$index}})">{{$row['gst_amount']}}</td>
                                                        <td class="py-2 border-r"
                                                            wire:click.prevent="changeItems({{$index}})">{{number_format($row['subtotal'],2,'.','')}}</td>
                                                        <td class="py-2 border-r"
                                                            wire:click.prevent="changeItems({{$index}})">
                                                            <x-button.delete
                                                                wire:click.prevent="removeItems({{$index}})"/>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            <tr class="bg-zinc-50 text-gray-400 text-center font-sans tracking-wider">
                                                @if(\Aaran\Aadmin\Src\SaleEntry::hasSize() or \Aaran\Aadmin\Src\SaleEntry::hasColour())

                                                    <td class="py-2 border-r" colspan="4">TOTALS.</td>
                                                @else
                                                    <td class="py-2 border-r" colspan="4">TOTALS.</td>
                                                @endif
                                                <td class="border-r font-semibold">{{$total_qty}}</td>
                                                <td class="border-r">&nbsp;</td>
                                                <td class="border-r font-semibold">{{number_format($total_taxable,2,'.','')}}</td>
                                                <td class="border-r">&nbsp;</td>
                                                <td class="border-r font-semibold">{{$total_gst}}</td>
                                                <td class="border-r font-semibold">{{number_format($grandtotalBeforeRound,2,'.','')}}</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
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
                            <div class="w-1/2 space-y-8 gap-5 h-52 pt-3">

                                @if(\Aaran\Aadmin\Src\SaleEntry::hasTransport())
                                    <x-dropdown.wrapper label="Transport" type="transportTyped">
                                        <div class="relative ">
                                            <x-dropdown.input label="Transport" id="transport_name"
                                                              wire:model.live="transport_name"
                                                              wire:keydown.arrow-up="decrementTransport"
                                                              wire:keydown.arrow-down="incrementTransport"
                                                              wire:keydown.enter="enterTransport"/>
                                            @error('transport_id')
                                            <span class="text-red-500">{{'The Transport is Required.'}}</span>
                                            @enderror
                                            <x-dropdown.select>
                                                @if($transportCollection)
                                                    @forelse ($transportCollection as $i => $transport)
                                                        <x-dropdown.option
                                                            highlight="{{$highlightTransport === $i  }}"
                                                            wire:click.prevent="setTransport('{{$transport->vname}}','{{$transport->id}}')">
                                                            {{ $transport->vname }}
                                                        </x-dropdown.option>
                                                    @empty
                                                        <x-dropdown.new
                                                            wire:click.prevent="transportSave('{{$transport_name}}')"
                                                            label="Transport"/>
                                                    @endforelse
                                                @endif
                                            </x-dropdown.select>
                                        </div>
                                    </x-dropdown.wrapper>
                                @endif

                                @if(\Aaran\Aadmin\Src\SaleEntry::hasDestination())
                                    <x-input.floating wire:model="destination" label="Destination"/>
                                @endif

                                @if(\Aaran\Aadmin\Src\SaleEntry::hasBundle())
                                    <x-input.floating wire:model="bundle" label="Bundle"/>
                                @endif
                            </div>
                        </x-tabs.content>
                        <x-tabs.content>
                            <div class="w-1/2 space-y-8 h-52 pt-3">
                                <!-- Ledger ----------------------------------------------------------------------------------->
                                <x-dropdown.wrapper label="Ledger" type="ledgerTyped">
                                    <div class="relative ">
                                        <x-dropdown.input label="Ledger" id="ledger_name"
                                                          wire:model.live="ledger_name"
                                                          wire:keydown.arrow-up="decrementLedger"
                                                          wire:keydown.arrow-down="incrementLedger"
                                                          wire:keydown.enter="enterLedger"/>
                                        @error('ledger_id')
                                        <span class="text-red-500">{{'The Ledger is Required.'}}</span>
                                        @enderror
                                        <x-dropdown.select>
                                            @if($ledgerCollection)
                                                @forelse ($ledgerCollection as $i => $ledger)
                                                    <x-dropdown.option highlight="{{$highlightLedger === $i  }}"
                                                                       wire:click.prevent="setLedger('{{$ledger->vname}}','{{$ledger->id}}')">
                                                        {{ $ledger->vname }}
                                                    </x-dropdown.option>
                                                @empty
                                                    <x-dropdown.new
                                                        wire:click.prevent="ledgerSave('{{$ledger_name}}')"
                                                        label="Ledger"/>
                                                @endforelse
                                            @endif
                                        </x-dropdown.select>
                                    </div>
                                </x-dropdown.wrapper>

                                <x-input.floating wire:model="additional" wire:change.debounce="calculateTotal"
                                                  label="Addition"
                                                  class="text-right block px-2.5 pb-2.5 pt-4 w-full text-sm
                                                      text-gray-900 bg-transparent rounded-lg border-1
                                                       border-gray-300 appearance-none
                                                       focus:outline-none focus:ring-2 focus:ring-cyan-50 focus:border-blue-600 peer"/>

                            </div>
                        </x-tabs.content>
                        <x-tabs.content>
                            <div class="w-1/2">
                                <x-input.rich-text wire:model="term" placeholder="Terms & Conditions"/>
                            </div>
                        </x-tabs.content>

                    </x-slot>
                </x-tabs.tab-panel>
            </div>
        </div>


    </div>
    <!-- Display Items ----------------------------------------------------------------------------------------------->
    <div class="max-w-6xl mx-auto ">
        @if( $common->vid != "")
            <x-forms.m-panel-bottom-button routes="{{ route('sales.print', [$this->common->vid])}}" save back
                                           print/>
        @else
            <x-forms.m-panel-bottom-button save back/>
        @endif
    </div>
    {{--    </x-forms.m-panel>--}}
    <div class="max-w-6xl mx-auto px-10 py-16 space-y-4">
        @if(!$purchaseLogs->isEmpty())
            <div class="text-xs text-orange-600  font-merri underline underline-offset-4">Activity</div>
        @endif
        @foreach($purchaseLogs as $row)
            <div class="px-6">
            <div class="relative ">
                <div class=" border-l-[3px] border-dotted px-8 text-[10px]  tracking-wider py-3">
                    <div class="flex gap-x-5 ">
                        <div class="inline-flex text-gray-500 items-center font-sans font-semibold">
                            <span>Purchase No:</span> <span>{{$row->vname}}</span></div>
                        <div class="inline-flex  items-center space-x-1 font-merri"><span
                                class="text-blue-600">@</span><span class="text-gray-500">{{$row->user->name}}</span>
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




