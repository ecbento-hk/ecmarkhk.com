<div class="stack mb-3 lg:mb-8 w-full">
    <div class="shadow-md card bg-primary text-primary-content">
        <div class="card-body">
            <h2 class="card-title">{{__('Select Location')}}</h2>
            <!-- <p>The cuffoff time on Thursday.</p> -->
            <select wire:model="storeid" class="select select-bordered text-black w-full max-w-xs">
                <option disabled="disabled" selected="selected">{{__('Choose Your Location')}}</option>
                @foreach($stores as $store)
                <option value="{{$store->id}}">{{$store->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="shadow card bg-primary text-primary-content">
        <div class="card-body">
            <h2 class="card-title">Notification 2</h2>
            <p>The cuffoff time on Thursday.</p>
        </div>
    </div>
    <div class="shadow-sm card bg-primary text-primary-content">
        <div class="card-body">
            <h2 class="card-title">Notification 3</h2>
            <p>The cuffoff time on Thursday.</p>
        </div>
    </div>
</div>