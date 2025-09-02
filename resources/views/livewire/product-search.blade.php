<div class="p-4">
    <input type="text" wire:model="search"
           placeholder="Search products..."
           class="border rounded p-2 w-full">

    <ul class="mt-4">
        @foreach($products as $product)
            <li class="p-2 border-b">
                {{ $product->name }} - ${{ $product->price }}
            </li>
        @endforeach
    </ul>
</div>
