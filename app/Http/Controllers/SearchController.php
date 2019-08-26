<?php

namespace App\Http\Controllers;

use App\UserUploadedFile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $this->validate($request, [
            'search_criteria'   =>
               ['required', Rule::in(["customer_number", "customer_name", "invoice_date", "invoice_number", "type_of_service", "amount"])],
            'search_string'     => ['required']
        ]);
        $criteria = $request->input('search_criteria');
        $searchString = $request->input('search_string');

        switch ($criteria) {
            case 'customer_number':
            case 'customer_name':
            case 'invoice_date':
            case 'invoice_number':
            case 'type_of_service':
            case 'amount':
                return redirect('dashboard')->with(['files' => $this->searchField($criteria, $searchString)]);
            default:
                return redirect('dashboard')->with(['files' => []]);
        }
    }

    private function searchField(string $fieldName, $searchString)
    {
        $files = UserUploadedFile::where('user_id', auth()->id())
                ->where($fieldName, 'like', '%' . $searchString . '%')->orderBy('created_at', 'desc')->orderBy('name')->get();
        return $files;
    }
}
