<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Client;
use App\Models\Product;
use App\Models\User;

class EntryController extends Controller
{


    public function index(Request $request): View
    {
        $isSearch = false;
        if (!empty($request->query('search'))) {
            $isSearch = true;
        }

        $searchTerm = $request->search;

        $isSort = false;
        if (!empty($request->query('sort_by'))) {
            $isSort = true;
        }
        $sortBy = $request->query('sort_by');

        // read from session, use 'asc' if not set
        $sortOrder = $request->session()->get('sortOrder', 'desc');


        $result_temp = Entry::query()
            ->where('title', 'LIKE', '%' . $searchTerm . '%')
            ->orWhereHas('product', function (Builder $query) use ($searchTerm) {
                $query->where('products.name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('user', function (Builder $query) use ($searchTerm) {
                $query->where('users.email', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orwhereHas('client', function (Builder $query) use ($searchTerm) {
                $query->where('clients.name', 'LIKE', '%' . $searchTerm . '%');
            });


        if ($isSort && $sortBy != 'status') {
            $result_temp->orderBy($sortBy, $sortOrder);

        } elseif ($isSort && $sortBy == 'status') {
            $status = 'aktiv';
            $entries = $result_temp->orderBy($status, $sortOrder)->get();
        } else {
            $result_temp->latest('created_at');
        }


        //toggle the sort order for next time
        $sortOrder = $sortOrder == 'desc' ? 'asc' : 'desc';
        // store in session for next time
        $request->session()->put('sortOrder', $sortOrder);

        $result = $result_temp->join('products', 'entries.product_id', '=', 'products.id')
            ->join('clients', 'products.client_id', '=', 'clients.id')
            ->select('entries.*')
            ->paginate(20);

        return view('entries', ['entries' => $result,
            'clients' => Client::all(),
            'products' => Product::all(),
            'users' => User::all(),
            'isSearch' => $isSearch,
            'sortOrder' => $sortOrder,]);
    }

}
