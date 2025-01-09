<div>
    <x-input.model-select wire:model="acyear" wire:change="changeAcyear" :label="'AcYear'">
        <option class="text-gray-400"> choose ..</option>
{{--        @foreach($years as $year)--}}
            @foreach(\App\Enums\AcYear::cases() as $year)
            <option value="{{$year->value}}">{{$year->getName()}}</option>
{{--            <option value="{{$year->id}}">{{$year->vname}}</option>--}}
        @endforeach
    </x-input.model-select>
</div>
