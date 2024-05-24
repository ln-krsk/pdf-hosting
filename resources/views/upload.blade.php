<x-layout>
    <x-modal-auth heading="Werbemittel hochladen:">
        <form id="upload-form" method="POST" action="{{route('upload.store')}}" class="w-full"
              enctype="multipart/form-data">
            @csrf
            <div class="block w-full px-3 mb-4 mx-auto">
                <div>
                    <label class="block uppercase tracking-wide text-xs font-semibold"
                           for="pdf">
                        PDF max. 2048 KB *
                    </label>
                    <input
                        class="block text-lg bg-white w-full"
                        id="pdf" name="pdf" type="file" value="">
                    @error('pdf')
                    <p class="error text-pink text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div id="client-input" class="block px-3 mb-1">
                <label class="block uppercase tracking-wide text-xs font-semibold"
                       for="client">
                    Kunde *
                </label>
                <select name="client" id="client"
                        class="inline-flex w-full bg-white border rounded py-1 px-2">
                    <option value="" hidden class="">Wähle einen Kunden aus</option>
                    <option value="addNewClient"
                            class="text-white bg-thiel" {{old('client') === 'addNewClient' ? 'selected' : ''}}>
                        -- Neuen Kunden
                        anlegen --
                    </option>
                    @foreach ($clients as $client)
                        <option value="{{$client->id}}" class=""
                            {{old('client') == $client->id ? 'selected' : ''}}>
                            {{ $client->name }}</option>
                    @endforeach
                </select>
                @error('client')
                <p class="error text-pink text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div id="new-client-input" class="hidden w-full px-3 mb-1">
                <input
                    class="block w-full border rounded py-1 px-2"
                    id="newClient" name="newClient" type="text" value="{{ old('newClient') }}"
                    placeholder="neuer Kunde">
                @error('newClient')
                <p class="error text-pink text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div id="product-input" class="w-full px-3 mb-1">
                <label class="block uppercase tracking-wide text-xs font-semibold mt-2"
                       for="product">
                    Produkt *
                </label>
                <select name="product" id="product"
                        class="inline-flex w-full bg-white border rounded py-1 px-2">
                    <option value="" hidden class="">Wähle ein Produkt aus</option>
                    <option value="addNewProduct"
                            class="text-white bg-thiel" {{old('product') === 'addNewProduct' ? 'selected' : ''}}>
                        -- Neues Produkt
                        anlegen --
                    </option>
                    <div id="productOptions" class="block bg-white rounded py-1 px-2 mt-2">
                        @foreach ($products as $product)
                            <option value="{{$product->id}}"
                                    class=""
                                {{old('product') == $product->id ? 'selected' : ''}}>
                                {{ $product->name }}</option>
                        @endforeach
                    </div>
                </select>
                @error('product')
                <p class="error text-pink text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div id="new-product-input" class="hidden w-full px-3 mb-1">
                <input
                    class="block w-full border rounded py-1 px-2"
                    id="newProduct" name="newProduct" type="text" value="{{ old('newProduct') }}"
                    placeholder="neues Produkt">
                @error('newProduct')
                <p class="error text-pink text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-1">
                <label class="block uppercase tracking-wide text-xs font-semibold mt-2"
                       for="title">
                    Name des Werbemittels *
                </label>
                <input
                    class="block w-full border border-red-500 rounded py-1 px-2 mb-1"
                    id="title" name="title" type="text" value="{{ old('title') }}"
                    placeholder="">
                @error('title')
                <p class="error text-pink text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-1 inline-flex">
                <div class="w-6/12 pr-2">
                    <label class="block uppercase tracking-wide text-xs font-semibold mt-2"
                           for="start">
                        Start
                    </label>
                    <input
                        class="block w-full border border-red-500 rounded py-1 px-2 "
                        id="start" name="start" type="date" value="{{ old('start') }}"
                        placeholder="">
                    @error('start')
                    <p class="error text-pink text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-6/12 pl-2">
                    <label class="block uppercase tracking-wide text-xs font-semibold mt-2 "
                           for="end">
                        Ende
                    </label>
                    <input
                        class="block w-full border border-red-500 rounded py-1 px-2"
                        id="end" name="end" type="date" value="{{ old('end') }}"
                        placeholder="">
                    @error('end')
                    <p class="error text-pink text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="px-3 mb-1">
                <label class="block uppercase tracking-wide text-xs font-semibold"
                       for="comment">
                    Kommentar
                </label>
                <textarea
                    class="block w-full  border border-red-500 rounded py-1 px-2"
                    id="comment" name="comment" type="text"
                    placeholder="">{{ old('comment') }}</textarea>
                @error('comment')
                <p class="error text-pink text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-3">
                <p class="text-xs">* Pflichtfelder</p>
            </div>
            <div class="w-1/3 mx-auto my-6">
                <x-form-submit-button id="form-submit-btn" value="Upload"></x-form-submit-button>
            </div>
        </form>
    </x-modal-auth>
</x-layout>
