<div class="card bg-white shadow-md rounded-xl h-fit">
    <div class="card-body">
        @if (session()->get('cart') === null || count(session()->get('cart')['order_details']) === 0)
            <p class="text-sm text-error">Data informasi pembayaran masih kosong. Silakan melakukan pembelian produk untuk mengisi informasi pembayaran Anda.</p>
        @else
            <div class="flex flex-col gap-8">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-1">
                        <h1 class="font-semibold text-lg">Shipping Information</h1>
                        <div class="divider my-0"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-x-4 gap-y-4">
                        <div class="flex flex-col gap-2">
                            <label class="label-text">Province</label>
                            <select class="select select-sm select-bordered w-full" name="product_category_id"
                                wire:model.live.debounce.300ms="selectedProvince" required>
                                <option selected>Select Province</option>
                                @foreach ($province as $item)
                                    <option value="{{ $item['province_id'] }}">{{ $item['province'] }}</option>
                                @endforeach
                            </select>
                            @error('selectedProvince')
                                <span class="text-error text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="label-text">City</label>
                            <select class="select select-sm select-bordered w-full" name="product_category_id"
                                wire:model.live.debounce.300ms="selectedCity" required>
                                <option selected>Select City</option>
                                @foreach ($city as $item)
                                    <option value="{{ $item['city_id'] }}">{{ $item['city_name'] }}</option>
                                @endforeach
                            </select>
                            @error('selectedCity')
                                <span class="text-error text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="label-text">Shipping Service</label>
                            <select class="select select-sm select-bordered w-full" name="product_category_id"
                                wire:model.live.debounce.300ms="shippingService" required>
                                <option selected>Select Shipping Service</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS</option>
                            </select>
                            @error('shippingService')
                                <span class="text-error text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="label-text">Total Weight (gram)</label>
                            <input type="number" value="{{ $totalWeight }}"
                                class="input input-bordered input-sm w-full" readonly>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="label-text">Address</label>
                        <textarea class="textarea textarea-bordered" placeholder="Address" wire:model.live.debounce.300ms="address" required></textarea>
                        @error('address')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center justify-between">
                            <h1 class="font-semibold text-lg">Payment Information</h1>
                            <button class="btn btn-sm bg-gray-800 text-white" wire:click="getShippingCost">Check
                                Shipping
                                Cost</button>
                        </div>
                        <div class="divider my-0"></div>
                        <div class="flex flex-col gap-4">
                            <div class="grid grid-cols-2">
                                <p class="text-sm font-medium">Address: </p>
                                <p class="text-right text-sm">{{ $address ? $address : '-' }}</p>
                            </div>
                            <div class="grid grid-cols-2">
                                <p class="text-sm font-medium">Shipping Service: </p>
                                <p class="text-right text-sm uppercase">{{ $shippingService ? $shippingService : '-' }}
                                </p>
                            </div>
                            <div class="grid grid-cols-2">
                                <p class="text-sm font-medium">Total Weight (gram): </p>
                                <p class="text-right text-sm">{{ $totalWeight ? $totalWeight : '-' }}</p>
                            </div>
                            <div class="grid grid-cols-2">
                                <p class="text-sm font-medium">Shipping Cost: </p>
                                <p class="text-right text-sm">
                                    <span wire:loading wire:target="getShippingCost" class="text-warning">Loading
                                        Shipping
                                        Cost...</span>
                                    <span wire:loading.remove wire:target="getShippingCost">
                                        IDR {{ number_format($shippingCost, 0, ',', '.') }}
                                    </span>
                                </p>
                            </div>
                            <div class="grid grid-cols-2">
                                <p class="text-sm font-medium">Total Product Price: </p>
                                <p class="text-right text-sm">
                                    {{ $totalProductPrice ? 'IDR ' . number_format($totalProductPrice, 0, ',', '.') : '-' }}
                                </p>
                            </div>
                            <div class="grid grid-cols-2">
                                <p class="text-sm font-medium">Total Payment: </p>
                                <p class="text-right text-sm">
                                    <span wire:loading wire:target="getShippingCost" class="text-warning">Loading Total
                                        Payment...</span>
                                    <span wire:loading.remove wire:target="getShippingCost">
                                        IDR {{ number_format($totalPayment, 0, ',', '.') }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <span wire:loading wire:target="createOrder">
                    <button class="btn btn-sm text-white bg-gray-800 w-full" disabled>
                        <span class="loading loading-spinner"></span>
                        Loading...
                    </button>
                </span>
                <span wire:loading.remove wire:target="createOrder">
                    <button class="btn btn-sm text-white bg-gray-800 w-full" wire:click="createOrder">Create Order</button>
                </span>
            </div>
        @endif
    </div>
</div>
