<x-layout>
    <x-modal-auth heading="Eintrag bearbeiten:">
        <div id="form">
            <form id="upload-form" method="POST" action="{{ route('upload.post.edit', ['entryId' => $entry->id]) }}"
                  class=""
                  enctype="multipart/form-data">
                @csrf
                <div class="block w-full px-3 mb-4 mx-auto">
                    <div>
                        <label class="block uppercase tracking-wide text-xs font-semibold"
                               for="pdf">
                            PDF ersetzen (optional - max. 2048 KB)
                        </label>
                        <input
                            class="block text-lg bg-white w-full"
                            id="pdf" name="pdf" type="file" value="">
                        @error('pdf')
                        <p class="text-pink text-xs italic">{{ $message }}</p>
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
                        <option value="addNewClient" class="text-white bg-thiel">-- Neuen Kunden
                            anlegen --
                        </option>
                        @foreach ($clients as $client)
                            <option value="{{$client->id}}" class=""
                                {{ $entry->product->client->id == $client->id ? 'selected' : ''}}>
                                {{ $client->name }}</option>
                        @endforeach
                    </select>
                    @error('client')
                    <p class="text-pink text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div id="new-client-input" class="hidden w-full px-3 mb-1">
                    <input
                        class="block w-full border rounded py-1 px-2"
                        id="newClient" name="newClient" type="text" value="{{ old('newClient') }}"
                        placeholder="neuer Kunde">
                    @error('newClient')
                    <p class="text-pink text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div id="product-input" class="w-full px-3 mb-1">
                    <label class="block uppercase tracking-wide text-xs font-semibold mt-3"
                           for="product">
                        Produkt *
                    </label>
                    <select name="product" id="product"
                            class="inline-flex w-full bg-white border rounded py-1 px-2">
                        <option value="" hidden class="">Wähle ein Produkt aus</option>
                        <option value="addNewProduct" class="text-white bg-thiel">-- Neues Produkt
                            anlegen --
                        </option>
                        <div id="productOptions" class="block bg-white rounded py-1 px-2 mt-2">
                            @foreach ($products as $product)
                                <option value="{{$product->id}}"
                                        class=""
                                    {{ $entry->product_id == $product->id ? 'selected' : ''}}>
                                    {{ $product->name }}</option>
                            @endforeach
                        </div>
                    </select>
                    @error('product')
                    <p class="text-pink text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div id="new-product-input" class="hidden w-full px-3 mb-1">
                    <input
                        class="block w-full border rounded py-1 px-2"
                        id="newProduct" name="newProduct" type="text" value="{{ old('newProduct') }}"
                        placeholder="neues Produkt">
                    @error('newProduct')
                    <p class="text-pink text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full px-3 mb-1">
                    <label class="block uppercase tracking-wide text-xs font-semibold mt-3"
                           for="title">
                        Name des Werbemittels *
                    </label>
                    <input
                        class="block w-full border border-red-500 rounded py-1 px-2"
                        id="title" name="title" type="text" value="{{ $entry->title }}"
                        placeholder="">
                    @error('title')
                    <p class="text-pink text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full px-3 mb-1 inline-flex">
                    <div class="w-6/12 pr-2">
                        <label class="block uppercase tracking-wide text-xs font-semibold mt-2"
                               for="start">
                            Start
                        </label>
                        <input
                            class="block w-full border border-red-500 rounded py-1 px-2 mb-1"
                            id="start" name="start" type="date" value="{{ $entry->start }}"
                            placeholder="">
                        @error('start')
                        <p class="text-pink text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-6/12 pl-2">
                        <label class="block uppercase tracking-wide text-xs font-semibold mt-2 "
                               for="end">
                            Ende
                        </label>
                        <input
                            class="block w-full border border-red-500 rounded py-1 px-2 mb-1"
                            id="end" name="end" type="date" value="{{ $entry->end }}"
                            placeholder="">
                        @error('end')
                        <p class="text-pink text-xs italic">{{ $message }}</p>
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
                        placeholder="">{{ $entry->comment }}</textarea>
                    @error('comment')
                    <p class="text-pink text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="px-3">
                    <p class="text-xs">* Pflichtfelder</p>
                </div>
                <div class="w-3/4 mx-auto my-4">
                    <x-form-submit-button id="form-submit-btn" value="Änderungen speichern"></x-form-submit-button>
                </div>
            </form>
            <div class=" px-3 py-2 flex justify-center">
                <form method="POST" action="{{ route('upload.delete', ['entryId' => $entry->id])}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this item?')"
                            class="text-md text-pink">
                        <img class="inline h-[18px] align-text-top" src="/dist/img/svg/trash-icon-melon--end.svg"
                             alt=" Mülleimer Icon: löschen"> Eintrag löschen
                    </button>
                </form>
            </div>
        </div>
    </x-modal-auth>
</x-layout>

