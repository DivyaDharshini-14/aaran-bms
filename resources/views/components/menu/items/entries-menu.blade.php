@if(Aaran\Aadmin\Src\Customise::hasEntries())
    <x-menu.base.li-menuitem :routes="'sales'" :label="'Sales'"/>
@endif
@if(Aaran\Aadmin\Src\Customise::hasExportSales())
<x-menu.base.li-menuitem :routes="'exportsales'" :label="'Export Sales'"/>
@endif
@if(Aaran\Aadmin\Src\Customise::hasEntries())
<x-menu.base.li-menuitem :routes="'purchase'" :label="'Purchase'"/>
@endif
<x-menu.base.route-menuitem  href="{{route('transactions',[1])}}" :label="'Receipt'"/>
<x-menu.base.route-menuitem  href="{{route('transactions',[2])}}" :label="'Payment'"/>
