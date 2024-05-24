<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() :bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() :array
    {   $rulesArray = ['pdf' => 'required|mimes:pdf|max:2048',
        'title' => ['required', 'alpha_dash', Rule::unique('entries', 'title')],
        'comment' => 'max:255',
        'start' => 'nullable|before:end',
        'end' => 'nullable|after:start',];

        if ($this->input('client') === "addNewClient") {
            $rulesArray['newClient'] = ['required', 'alpha_dash', Rule::unique('clients', 'name')];
            $rulesArray['newProduct'] = ['required', 'alpha_dash', Rule::unique('products', 'name')];
        } else {
           $rulesArray['client'] = ['required', Rule::exists('clients', "id")];
        }

        if ($this->input('product') === "addNewProduct") {
            $rulesArray['newProduct'] = ['required', 'alpha_dash', Rule::unique('products', 'name')];
        } else {
            $rulesArray['product'] = ['required',  Rule::exists('products', 'id')];
        }

        return $rulesArray;
    }

    public function messages() :array
    {
        return [
            'pdf.required' => 'Bitte wählen Sie ein PDF aus.',
            'pdf.max' => 'Das PDF darf eine Größe von 2048 KB nicht überschreiten.',
            'pdf.mimes' => 'Die ausgewählte Datei muss ein PDF sein.',
            'title.required' => 'Bitte geben Sie den Namen des Werbemittels an.',
            'title.alpha_dash' => 'Der Name darf nur Buchstaben, Ziffern oder Unterstriche enthalten.',
            'comment.max' => 'Der Kommentar darf nicht länger als 255 Zeichen sein.',
            'start.after_or_equal' => 'Das Datum darf nicht in der Vergangenheit liegen.',
            'start.before' => 'Das Startdatum muss vor dem Enddatum liegen.',
            'end.after' => 'Das Enddatum muss nach dem Startdatum liegen.',
            'newClient.required' => 'Legen Sie einen neuen Kunden an oder wählen Sie einen aus der Liste aus.',
            'newClient.alpha_dash' => 'Der Name des Kunden darf nur Buchstaben, Ziffern oder Unterstriche enthalten.',
            'newClient.unique' => 'Der Kunde existiert bereits. Legen Sie einen neuen Kunden an oder wählen Sie einen aus der Liste aus.',
            'client' => 'Treffen Sie eine Auswahl.',
            'newProduct.required' => 'Legen Sie ein neues Produkt an oder wählen Sie eins aus der Liste aus.',
            'newProduct.alpha_dash' => 'Der Name des Produkts darf nur Buchstaben, Ziffern oder Unterstriche enthalten.',
            'newProduct.unique' => 'Das Produkt existiert bereits. Legen Sie ein neues Produkt an oder wählen Sie eins aus der Liste aus.',
            'product' => 'Treffen Sie eine Auswahl.',
        ];
    }
}


