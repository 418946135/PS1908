<?php

namespace App\Http\Controllers;

use App\User;
use App\UserUploadedFile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $files = $user->uploadedFiles()->orderBy('created_at', 'desc')->orderBy('name')->get();
        $fileTypes = $user->getUploadedFileTypes();
        $tags = $user->getFileTags();

        $fileredFileType = $request->input('file_type');
        if ($request->input('filter_type') == 'file_type') { //filter by file type
            $files = $this->filterByFileType($files, $fileredFileType);
        }

        $fileredTag = $request->input('tag');
        if ($request->input('filter_type') == 'tag') { //filter by file type
            $files = $this->filterByFileTag($files, $fileredTag);
        }

        return view('dashboard')
                ->with([
                    'showFileFilter' => true,
                    'files' => $files, 'fileTypes' => $fileTypes,
                    'filteredFileType' => $fileredFileType ? $fileredFileType : 'all',
                    'filteredFileTag' => $fileredTag ? $fileredTag : 'clear',
                    'fileTags' => $tags,
                ]);
    }

    private function filterByFileType(Collection $files, string $fileType = null)
    {
        if (!$fileType) {
            return $files;
        }

        return $files->filter(function ($file, $key) use ($fileType) {
            return $file->type == $fileType;
        });
    }

    private function filterByFileTag(Collection $files, string $fileTag = null)
    {
        if (!$fileTag) {
            return $files;
        }

        $files = DB::table('user_uploaded_files AS uuf')
            ->join('file_tags AS ft', 'uuf.id', '=', 'ft.user_uploaded_file_id')
            ->where('uuf.user_id', auth()->id())
            ->where('ft.name', $fileTag)->orderBy('uuf.created_at', 'desc')
            ->select('uuf.*')->get();
        return $files;
    }

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
                return view('dashboard')->with(['files' => $this->searchField($criteria, $searchString)]);
            default:
                return view('dashboard')->with(['files' => []]);
        }
    }

    private function searchField(string $fieldName, $searchString)
    {
        $files = UserUploadedFile::where('user_id', auth()->id())
            ->where($fieldName, 'like', '%' . $searchString . '%')->orderBy('created_at', 'desc')->orderBy('name')->get();
        return $files;
    }
}
