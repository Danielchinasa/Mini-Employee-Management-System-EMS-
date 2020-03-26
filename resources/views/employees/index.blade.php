@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/home">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">employees</li>
                    </ol>
                </nav>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#staticBackdrop">
                       Create A New Employee
                       <i class="fa fa-user-plus"></i>
                    </button>

                    <!-- A script to display the request error message -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Create a new employee</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                            <form method="post" action="{{route('employees.store')}}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="firstname">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="lastname">
                                    </div>

                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Email address</label>
                                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>

                                    <div>
                                        <label for="exampleInputWebsite">Phone</label>
                                        <input type="number" class="form-control" aria-describedby="websiteHelp" name="phone">
                                    </div>

                                    <div class="form-group">
                                      <label for="exampleInputCompany">Company Name</label>
                                      <select id="inputState" class="form-control" name="company_id">
                                        <option selected>Choose...</option>
                                          @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                    
                                </form>
                            </div>
                            
                          </div>
                        </div>
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item">Employee List</li>
                        <li class="list-group-item">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Company Email</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tag type="hidden" value="{{ $i=1 }}" >
                                    
                                        @foreach($employees as $employee)
                                        <tr>
                                        <td>{{ $i++."."}}</td>
                                        <td>{{$employee->lastname}} {{$employee->firstname}}</td>
                                        <td>{{$employee->email}}</td>
                                        <td>(+234) {{$employee->phone}}</td>
                                            {{-- {{dd($employee->company)}} --}}
                                        <td>{{$employee->company->name}}</td>
                                        <td>{{$employee->company->email}}</td>
                                        <td><a class="edit" href="#" data-toggle="modal" data-target="#editBackdrop{{$i}}"><i class="fa fa-pencil text-primary"></i></a>

                                            <!-- Modal -->
                                        <div class="modal fade" id="editBackdrop{{$i}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                <h5 class="modal-title" id="editBackdropLabel">Edit Employee Info</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="post" action="{{route('employee.update', $employee->id)}}">
                                                    @csrf
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">First Name</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="firstname" value="{{$employee->firstname}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Last Name</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="lastname" value="{{$employee->lastname}}">
                                                        </div>
                                                        <div class="form-group">
                                                        <label for="exampleInputEmail1">Email address</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{$employee->email}}"">
                                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputCompany">Company Name</label>
                                                            <small id="emailHelp" class="form-text text-danger">Please select the company your currently work for</small>
                                                            <select id="inputState" class="form-control" name="company_id">
                                                              <option selected>Choose...</option>
                                                                @foreach($companies as $company)
                                                              <option value="{{$company->id}}">{{$company->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Phone</label>
                                                            <input type="number" class="form-control" aria-describedby="websiteHelp" name="phone" value="{{$employee->phone}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Save</button>
                                                        </div>
                                                        
                                                    </form>
                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>

                                        <a class="edit" href="#" data-toggle="modal" data-target="#exampleModalCenter{{$i}}"><i class="fa fa-trash text-danger"></i></a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                <h5 class="modal-title" id="exampleModalCenterTitle" style="color:#fff">Alert</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body" align="center">
                                                    <h5>Employee record will be deleted permanently</h5>
                                                    <h6>Are you sure?</h6>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{route('employee.destroy', $employee->id)}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                    
                                    </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>

                            <!-- Paginator -->
                            {{$employees->links()}}
                        </li>
                    </ul>

                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
