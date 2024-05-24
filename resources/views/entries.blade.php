<x-layout>
    @auth
        @if (isset($entries) && count($entries) > 0)
            <div class="container mx-auto">
                <div class="space-y-2 lg:space-y-0 lg:space-x-4 ">
                    <div class="flex justify-between">
                        <!-- Search -->
                        <div class="relative inline-flex bg-greylight rounded-xl ">
                            <form method="GET" action="#">
                                <input type="text" name="search" placeholder="Suche"
                                       class="bg-transparent font-semibold text-sm px-2 py-1"
                                       value="{{ request('search') }}">
                                <button class="inline-flex justify-items-end relative align-middle mr-1" type="submit">
                                    <img src="/dist/img/svg/search-icon.svg" alt="Status: online">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-6 w-full mx-auto">
                <table class="w-full table-fixed 2xl:table-auto">
                    <tr class="text-left text-sm whitespace-nowrap truncate flex-row text-darkgrey">
                        <th class="p-1 font-semibold truncate">Kunde<a id="client-chevron"
                                                                       href="{{ route('entries', ['sort_by' => 'clients.name', 'order' => $sortOrder]) }}"
                                                                       class="chevron bottom"></a></th>
                        <th class="p-1 font-semibold truncate">Produkt<a id="product-chevron"
                                                                         href="{{ route('entries', ['sort_by' => 'products.name', 'order' => $sortOrder]) }}"
                                                                         class="chevron bottom"></a></th>
                        <th class="p-1 font-semibold truncate">Werbemittel<a id="title-chevron"
                                                                             href="{{ route('entries', ['sort_by' => 'title', 'order' => $sortOrder]) }}"
                                                                             class="chevron bottom"></a></th>
                        <th class="p-1 font-semibold truncate text-center">Start<a id="start-chevron"
                                                                                   href="{{ route('entries', ['sort_by' => 'start', 'order' => $sortOrder]) }}"
                                                                                   class="chevron bottom"></a></th>
                        <th class="p-1 font-semibold truncate text-center">Ende<a id="end-chevron"
                                                                                  href="{{ route('entries', ['sort_by' => 'end', 'order' => $sortOrder]) }}"
                                                                                  class="chevron bottom"></a></th>
                        <th class="p-1 font-semibold truncate text-center">Status</th>
                        <th class="p-1 font-semibold truncate">Kommentar</th>
                        <th class="p-1 font-semibold truncate">hinzugefügt von</th>
                        <th class="p-1 font-semibold truncate">Linkvorschau</th>
                        <th class="p-1 font-semibold truncate text-right">Edit / Download</th>
                    </tr>

                    @foreach ($entries as $key => $entry)
                        <tr class="text-xs text-darkgrey border-y-2 border-greylight hover:bg-greylight">
                            <td data-cell="Kunde" class="p-1 px-1 truncate hover:text-thiel--end"><a
                                    href="/clients/{{ $entry->product->client->name}}">{{ $entry->product->client->name}}</a>
                            </td>
                            <td data-cell="Produkt" class="p-1 px-1 truncate hover:text-thiel--end"><a
                                    href="/{{ $entry->product->client->name}}/{{ $entry->product->name}}">{{ $entry->product->name}}</a>
                            </td>
                            <td data-cell="Werbemittel"
                                class="p-1 px-1 truncate font-semibold ">{{ $entry->title }}
                            </td>
                            <td data-cell="Start"
                                class="p-1 px-1 text-xs whitespace-nowrap text-center truncate">@if ($entry->start)
                                    {{ date("d. M y", strtotime ($entry->start)) }}
                                @endif
                            </td>
                            <td data-cell="Ende"
                                class="p-1 px-1 whitespace-nowrap text-center truncate">@if ($entry->end)
                                    {{ date("d. M y", strtotime ($entry->end)) }}
                                @endif</td>
                            <td data-cell="Status" class="text-center p-1 px-1">
                                @if ($entry->getStatus() === 'aktiv')
                                    <span
                                        class="text-xs bg-green-status-200 text-green-status-100 rounded-xl px-2 py-0.5"
                                        title="aktiv">aktiv</span>
                                @elseif ($entry->getStatus() === 'unbekannt')
                                    <span
                                        class="text-xs bg-grey-100 text-grey-300 rounded-xl px-1 py-0.5">unbekannt</span>
                                @elseif ($entry->getStatus() === 'zukünftig')
                                    <span
                                        class="text-xs bg-yellow-status-200 text-yellow-status-100 rounded-xl px-1 py-0.5">zukünftig</span>
                                @elseif ($entry->getStatus() === 'beendet')
                                    <span
                                        class="text-xs bg-red-status-200 text-red-status-100 rounded-xl px-1 py-0.5">beendet</span>
                                @endif
                            </td>
                            <td data-cell="Kommentar"
                                class="p-1 px-1 truncate whitespace-nowrap">{{ $entry->comment }}</td>
                            <td data-cell="hinzugefügt von" class="p-1 px-1 truncate hover:text-thiel--end">
                                <a href="/{{ $entry->user->id}}">{{ $entry->user->getUsername() }}</a>
                            </td>
                            <td data-cell="Link" class="pb-1 px-1 truncate whitespace-nowrap">
                                <button id="copyText-btn" class="btn" onclick="copyText({{ $key }})">
                                    <img
                                        class="hover-icon-thiel--end inline h-[18px] mr-1"
                                        src="/dist/img/svg/copy-icon.svg"
                                        alt=" Kopieren Icon"
                                        title="Link kopieren">
                                    <span id="tooltiptext-{{ $key }}"
                                          class="absolute bg-darkgrey text-white py-0.5 px-1 rounded-xl z-1 opacity-0 -translate-x-0.5 -translate-y-1 transition ease-in-out">kopiert</span>
                                </button>
                                <a class="block truncate inline hover:overflow-visible hover:text-thiel--end"
                                   href="{{asset('storage/' . $entry->pdf) }}">/{{ $entry->pdf }} </a>
                            </td>

                            <td data-cell="Aktionen" class="p-1 whitespace-nowrap text-right">
                                <a class="text-xs ml-0.5 mr-3 hover:text-thiel--end"
                                   href="{{ route('upload.edit', ['entryId' => $entry->id])}}"
                                   id="edit"><img class="inline h-[18px] hover-icon-thiel--end"
                                                  src="/dist/img/svg/edit-icon.svg"
                                                  title="Eintrag bearbeiten" alt=" Notepad Icon: bearbeiten"></a>

                                <a download href={{asset('storage/' . $entry->pdf) }} ><img
                                        class="inline h-[18px] mx-1 hover-icon-thiel--end"
                                        src="/dist/img/svg/download-icon.svg"
                                        alt="Download Icon"
                                        title="PDF herunterladen"></a>
                                <textarea hidden
                                          id="link-{{ $key }}">{{asset ('storage/' . $entry->pdf )  }} </textarea>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{--pagination links are inserted here--}}
                @if(Route::currentRouteName() == 'entries')
                    {{ $entries->links() }}
                @endif


                @if(Route::currentRouteName() != 'entries' || $isSearch )
                    <div class="py-2 text-1xl text-thiel">
                        <a href="{{ route('entries') }}"> Zu allen Einträgen </a>
                    </div>
                @endif

                @elseif (isset($entries) && count($entries) === 0)
                    <p>Es gibt derzeit keine Einträge @if (isset($isSearch))
                            zu diesem Suchbegriff.
                        @endif</p>
                    <div class="py-2 text-1xl text-thiel underline">
                        <a href="{{ route('upload.create') }}"> Lade ein PDF hoch! </a>
                    </div>
                @endif
            </div>
        @endauth

        {{--todo: script ins app.js auslagern--}}
        <script>
            function copyText(key) {
                console.log(key);
                /* Select text area by id*/
                let Text = document.getElementById("link-" + key);

                /* Select the text inside text area. */
                Text.select();

                /* Copy selected text into clipboard */
                navigator.clipboard.writeText(Text.value);

                let tooltiptext = document.getElementById("tooltiptext-" + key);
                tooltiptext.classList.add("opacity-90");
                tooltiptext.classList.remove("opacity-0");
                setTimeout(
                    function () {
                        tooltiptext.classList.remove("opacity-90");
                        tooltiptext.classList.add("opacity-0");
                    }, 1000);
            }
        </script>
</x-layout>
