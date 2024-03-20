@extends('layouts.app')

@section('content')
<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Employee</h1>
    </div>
    <div class="col-auto">
        <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">
                    <form class="table-search-form row gx-1 align-items-center">
                        <div class="col-auto">
                            <input type="text" id="search-orders" name="searchorders" class="form-control search-orders"
                                placeholder="Search">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn app-btn-secondary">Search</button>
                        </div>
                    </form>

                </div>
                <!--//col-->
                <div class="col-auto">

                    <select class="form-select w-auto">
                        <option selected value="option-1">All</option>
                        <option value="option-2">This week</option>
                        <option value="option-3">This month</option>
                        <option value="option-4">Last 3 months</option>

                    </select>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                            <path fill-rule="evenodd"
                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                        </svg>
                        Add employee
                    </button>
                </div>
            </div>
            <!--//row-->
        </div>
        <!--//table-utilities-->
    </div>
    <!--//col-auto-->
</div>
<!--//row-->
<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">id</th>
                                <th class="cell">Staff id</th>
                                <th class="cell">First Name</th>
                                <th class="cell">Last Name</th>
                                <th class="cell">Birth Date</th>
                                <th class="cell">Job Title</th>
                                <th class="cell">Company</th>
                                <th class="cell">Department</th>
                                <th class="cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                            <tr>
                                <td class="cell">{{ $employee->id }}</td>
                                <td class="cell"><span class="truncate">{{ $employee->staffId }}</span></td>
                                <td class="cell">{{ $employee->firstName }}</td>
                                <td class="cell">{{ $employee->lastName }}</td>
                                <td class="cell">{{ $employee->birthDate }}</td>
                                <td class="cell">{{ $employee->jobTitle }}</td>
                                <td class="cell">{{ $employee->company }}</td>
                                <td class="cell">{{ $employee->department->name }}
                                </td>

                                <td class="cell">
                                    <a class="btn-sm app-btn-secondary"
                                        href="{{ route('employee.edit', $employee->id) }}">
                                        <i class="fa fa-edit fa-2x text-success"></i>
                                    </a>

                                    <a role="button" href="#"
                                        onclick="deleteConfirmation('{{ route('employee.delete', $employee->id) }}')"
                                        class="btn-sm app-btn-danger">
                                        <i class="fa fa-trash fa-2x text-danger"></i>
                                    </a>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="cell" colspan="7">No Patient added</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!--//table-responsive-->

            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
        <nav class="app-pagination">
            <div class="justify-content-center">
                {{ $employees->links() }}
            </div>
        </nav>
        <!--//app-pagination-->

    </div>
    <!--//tab-pane-->
</div>
<!--//tab-content-->
<!-- Button trigger modal -->


<!-- Modal add employee -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Employee</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" action="{{ route('employee.store') }}" method="POST">
                    @csrf


                    <div class="mb-3">
                        <label for="staffId" class="form-label">Staff ID</label>
                        <input type="text" class="form-control" id="staffId" name="staffId" value="">
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName"
                                        placeholder="Employee First Name" value="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName"
                                        placeholder="employee last Name" value="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="birthDate" class="form-label">Birth Date</label>
                        <input type="date" class="form-control" id="birthDate" name="birthDate" value="">
                    </div>
                    <div class="mb-3">
                        <label for="jobTitle" class="form-label">Job Title</label>
                        <input type="text" class="form-control" id="jobTitle" name="jobTitle"
                            placeholder="employee job Title" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="company" class="form-label">Company</label>
                        <select class="form-control" name="company" id="company">
                            <option value=""></option>
                            @foreach ($companys as $company)
                            <option value="{{ $company }}">{{ $company }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="employeeType" class="form-label">Employee Type</label>
                        <select class="form-control" name="employeeType" id="employeeType">
                            <option selected disabled>select</option>
                            <option value="National">National</option>
                            <option value="Expat">Expat</option>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="department_id" class="form-label">Department</label>
                        <select class="form-control" name="department_id" id="department_id">
                            <option value=""></option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn app-btn-primary" data-bs-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection