@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/home">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">companies</li>
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
                       Create New Company
                    </button>
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
                              <h5 class="modal-title" id="staticBackdropLabel">Create a new company</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                            <form method="post" action="{{route('companies.store')}}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Email address</label>
                                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div>
                                        <label for="exampleInputWebsite">Website</label>
                                        <input type="text" class="form-control" aria-describedby="websiteHelp" name="website">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Address</label>
                                      <textarea class="form-control" aria-label="With textarea" name="address"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Upload Logo</label>
                                        <input type="file" class="form-control" aria-describedby="websiteHelp" name="logo">
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
                        <li class="list-group-item">Company List</li>
                        <li class="list-group-item">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Company Logo</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Website</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Number of Employees</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tag type="hidden" value="{{ $i=1 }}" >
                                    
                                        @foreach($companies as $company)
                                        <tr>
                                        <td>{{ $i++."."}}</td>
                                        <td>{{$company->name}}</td>
                                        <td><img src="{{Storage::url($company->logo)}}" width="50px" style=" border-radius:50px"></td>
                                        <td>{{$company->address}}</td>
                                        <td>{{$company->website}}</td>
                                        <td>{{$company->email}}</td>
                                        <td><code>{{$company->employees->count()}}</code> </td>
                                        <td><a class="edit" href="#" data-toggle="modal" data-target="#editBackdrop{{$i}}"><i class="fa fa-pencil text-primary"></i></a>
                                            <!-- Modal -->
                                        <div class="modal fade" id="editBackdrop{{$i}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                <h5 class="modal-title" id="editBackdropLabel">Edit Company</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="post" action="{{route('company.update', $company->id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Name</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="{{$company->name}}">
                                                        </div>
                                                        <div class="form-group">
                                                        <label for="exampleInputEmail1">Email address</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{$company->email}}"">
                                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                                        </div>
                                                        <div>
                                                            <label for="exampleInputWebsite">Website</label>
                                                            <input type="text" class="form-control" aria-describedby="websiteHelp" name="website" value="{{$company->website}}"">
                                                        </div>
                                                        <div class="form-group">
                                                        <label for="exampleInputPassword1">Address</label>
                                                        <textarea class="form-control" aria-label="With textarea" name="address">{{$company->address}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Upload Logo</label>
                                                            <input type="file" class="form-control" aria-describedby="websiteHelp" name="logo">
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
                                                    <h5>Company will be deleted permanently</h5>
                                                    <h6>Are you sure?</h6>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{route('company.destroy', $company->id)}}" method="POST">
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
                            {{$companies->links()}}
                        </li>
                    </ul>

                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
