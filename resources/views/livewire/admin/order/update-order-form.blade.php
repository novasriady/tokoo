<div class="flex flex-col gap-4">
    <div class="flex flex-col gap-2">
        <label class="label-text">Order Status</label>
        <select class="select select-sm select-bordered w-full" wire:model.live.debounce.300ms="orderStatus">
            <option value="" selected>Pilih Status Pesanan</option>
            <option value="Approved">Disetujui</option>
            <option value="Rejected">Ditolak</option>
            <option value="Retrieved">Diterima</option>
            <option value="Sent">Dikirim</option>
        </select>
        @error('orderStatus')
            <span class="text-error text-sm">{{ $message }}</span>
        @enderror
    </div>
    @if ($orderStatus === 'Rejected')
        <div class="flex flex-col gap-2">
            <label class="label-text">Alasan Ditolak</label>
            <textarea class="textarea textarea-bordered" placeholder="Rejected Notes" wire:model.live.debounce.300ms="orderRejectedNotes"></textarea>
            @error('orderRejectedNotes')
                <span class="text-error text-sm">{{ $message }}</span>
            @enderror
        </div>
    @endif
    <button class="btn btn-sm bg-gray-800 text-white" wire:click="updateOrderStatus">Update Status Pesanan</button>
</div>
