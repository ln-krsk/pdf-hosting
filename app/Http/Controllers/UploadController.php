<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntryRequest;
use App\Http\Requests\EditEntryRequest;
use App\Models\Client;
use App\Models\Entry;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UploadController extends Controller
{
    public function create() :view
    {
        $clients = Client::all();
        $products = Product::all();
        return view('upload', ['clients' => $clients, 'products' => $products]);
    }

    public function store(StoreEntryRequest $request) :RedirectResponse
    {
        if ($request->input('client') === "addNewClient") {
            $client = Client::query()->create([
                'name' => $request->input('newClient'),
            ]);
        } else {
            $client = Client::query()->find($request->input('client'));
        }

        if ($request->input('product') === "addNewProduct") {
            $product = Product::query()->create([
                'name' => $request->input('newProduct'),
                'client_id' => $client->id,
            ]);
        } else {
            $product = Product::query()->find($request->input('product'));
        }

        $pdf = $request->file('pdf');
        $fileName = $pdf->getClientOriginalName();
        $pdf = $request->file('pdf')->storeAs($client->name . '/' . $product->name, $fileName);

        Entry::query()->create([
            'product_id' => $product->id,
            'title' => $request->input('title'),
            'user_id' => $request->user()->id,
            'comment' => $request->input('comment'),
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'pdf' => $pdf,
        ]);
        return redirect('/entries')->with('success', 'Dein Eintrag war erfolgreich.');
    }


    public function edit(string $entryId) :View
    {
        $clients = Client::all();
        $products = Product::all();
        $entry = Entry::find($entryId);

        return view('edit', ['clients' => $clients, 'products' => $products, 'entry' => $entry]);
    }

    public function postEdit(string $entryId, EditEntryRequest $request) :RedirectResponse
    {
        $entry = Entry::find($entryId);

        if ($request->input('client') === "addNewClient") {
            $client = Client::query()->create([
                'name' => $request->input('newClient'),
            ]);
        } else {
            $client = Client::query()->find($request->input('client'));
        }

        if ($request->input('product') === "addNewProduct") {
            $product = Product::query()->create([
                'name' => $request->input('newProduct'),
                'client_id' => $client->id,
            ]);
        } else {
            $product = Product::query()->find($request->input('product'));
        }

        if ($request->hasfile('pdf')) {
            $pdf = $request->file('pdf');
            $fileName = $pdf->getClientOriginalName();
            $pdf = $request->file('pdf')->storeAs($client->name . '/' . $product->name, $fileName);
            $entry->pdf = $pdf;

        } else {
            $pdf = $entry->pdf;
            $fileName = substr($pdf, strrpos($pdf, '/') + 1);
            $newPath = "$client->name/$product->name/$fileName";
            Storage::move($pdf, $newPath);
            $entry->pdf = $newPath;
        }

        $entry->product_id = $request->input('product');
        $entry->title = $request->input('title');
        $entry->comment = $request->input('comment');
        $entry->start = $request->input('start');
        $entry->end = $request->input('end');
        $entry->save();

        return redirect('entries')->with('success', 'Deine Änderung war erfolgreich.');
    }

    public function destroy(string $entryId) :RedirectResponse
    {   $entry = Entry::query()->find($entryId);
        $entry->delete();
        Storage::disk('public')->delete($entry->pdf);
        return redirect('entries')->with('success', 'Dein Eintrag wurde gelöscht.');
    }
}

