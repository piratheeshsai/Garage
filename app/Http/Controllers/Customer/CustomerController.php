<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::select(['id', 'name', 'phone', 'email', 'DOB']);
            return DataTables::of($data)
                ->addColumn('action', function($row) {
                    $editUrl = route('customers.edit', $row->id);
                    $deleteUrl = route('customers.destroy', $row->id);
                    $escapedName = addslashes($row->name);
                    $csrfField = csrf_field();
                    $methodField = method_field('DELETE');

                    return '
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light" type="button" id="actionMenu'.$row->id.'" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionMenu'.$row->id.'">
                            <li>
                                <a class="dropdown-item d-flex align-items-center text-primary" href="'.$editUrl.'">
                                    <i class="fas fa-edit me-2"></i>Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center text-danger" href="#" onclick="event.preventDefault(); confirmDelete('.$row->id.', \''.$escapedName.'\')">
                                    <i class="fas fa-trash-alt me-2"></i>Delete
                                </a>
                                <form id="delete-customer-form-'.$row->id.'" action="'.$deleteUrl.'" method="POST" class="d-none">
                                    '.$csrfField.'
                                    '.$methodField.'
                                </form>
                            </li>
                        </ul>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
