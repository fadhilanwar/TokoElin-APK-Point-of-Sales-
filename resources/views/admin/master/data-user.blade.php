@extends('admin.main-admin')
@section('page-wrapper')
 <!-- Page header -->
 <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Data Master > Data User
          </div>
          <h2 class="page-title">
            Data User
          </h2>
        </div>
        <!-- Page title actions -->
        
      </div>
    </div>
  </div>
<div class="page-body">
          <div class="container-xl">
            <div class="card">
              <div class="card-body">
                <div class="border-bottom py-3 mb-3">
                    <button data-bs-toggle="modal" data-bs-target="#addUser" class="btn btn-success w-25">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                      </svg>
                      Tambah User
                    </button>
                   
                  </div>
                {{-- <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                      <div class="text-muted">
                        Show
                        <div class="mx-2 d-inline-block">
                          <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
                        </div>
                        entries
                      </div>
                      <div class="ms-auto text-muted">
                        Search:
                        <div class="ms-2 d-inline-block">
                          <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                        </div>
                      </div>
                    </div>
                  </div> --}}
                 
                <div id="table-default" class="table-responsive">
                   
                    <table id="table_id" class="display table card-table table-vcenter text-nowrap datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            {{-- <th>Password</th> --}}
                            <th>Role</th>
                            <th data-searchable="false">Action</th>
                        </tr>
                    </thead>
                    @php
                    $no = 1;
                    @endphp
                    <tbody class="table-tbody">
                        @foreach ($datauser as $d)
                        <tr>
                            <th>{{ $no++ }}</th>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->email }}</td>
                            {{-- <td class="pass-td">{{ $d -> password }}</td> --}}
                            <td>{{ $d->role }}</td>
                            <td class="d-flex">
                                <button data-bs-toggle="modal" data-bs-target="#editUser{{ $d->id }}" style="margin-right: 10px"
                                    class="btn btn-primary mr-2"><i class="fa fa-edit"></i>Edit</button>


                                    <button data-bs-toggle="modal" data-bs-target="#delete" class="btn btn-danger">
                                      Hapus
                                   </button>
                                   
                            </td>

                        </tr>
                        <div class="modal modal-blur fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              <div class="modal-status bg-danger"></div>
                              <div class="modal-body text-center py-4">
                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
                                <h3>Are you sure?</h3>
                                <div class="text-muted">Aksi ini akan menghapus Data milik ({{ $d->name }})</div>
                              </div>
                              <div class="modal-footer">
                                <div class="w-100">
                                  <div class="row">
                                    <div class="col"><a href="#" class="btn w-100 mb-2" data-bs-dismiss="modal">
                                        Cancel
                                      </a></div>
                                      <form method="get" action="{{ url('datauser/destroy/' . $d->id) }}">
                                        @csrf
                                        {{-- @method('DELETE') --}}
                                        <button type="submit" class="btn btn-danger w-100">
                                            <i class="fa fa-trash"></i>Hapus
                                        </button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- KUMPULAN MODAL --}}
        {{-- MODAL ADD START --}}
        <div class="modal modal-blur fade" id="addUser" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah {{ $title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- NOTIFIKASI ERROR --}}
                    @error('name')
                    @php
                        alert()->error('Gagal Bro !', 'Baca Kembali Aturan Validasi...');
                    @endphp
                    @enderror
                    @error('email')
                    @php
                        alert()->error('Gagal Bro !', 'Baca Kembali Aturan Validasi...');
                    @endphp
                    @enderror
                    {{-- NOTIFIKASI ERROR --}}
            <form action="/datauser" method="post">
                @csrf
                <div class="form-group">
                    {{-- <label for="recipient-name" class="col-form-label">ID User:</label>
                    --}}
                    <input type="hidden" class="form-control txt" id="recipient-name" name="id">
                </div>
                <div class="form-group">
                    <label for="name" class="col-form-label">Name:</label>
                    <input value="{{ old('name') }}" type="text" class="form-control txt" id="name" name="name" required>
                  </div>
                 
                <div class="form-group">
                    <label for="email" class="col-form-label"><i
                            class="fa fa-envelope mr-1"></i>Email:</label>
                    <input value="{{ old('email') }} " type="text" class="form-control txt" id="email" name="email" required>
                  </div>
                 
                <div class="form-group">
                    <label for="password" class="col-form-label"><i
                            class="fa fa-unlock-alt mr-1"></i>Password:</label>
                    <input type="text" class="form-control txt" id="password" name="password" required>
                </div>
                
                    {{-- <label for="role" class="col-form-label">Select Role:</label><br> --}}
                    <select style="display: none" class="form-select" aria-label="Default" name="role" id="role" required>
                        <option value="admin" selected>-- Select Role --</option>
                        <option value="admin">Admin</option>
                        {{-- <option value="kasir">Kasir</option> --}}
                    </select>
               

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                Cancel
            </button>
            <button type="submit" class="btn btn-primary">Create User</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    {{-- MODAL ADD END END --}}
        {{-- MODAL EDIT START --}}
        @foreach ($datauser as $d)
        <div class="modal fade" id="editUser{{ $d->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit {{ $title }}</h5>
                    </div>
                    <div class="modal-body">
                      @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <form action="/datauser/{{$d->id}}"
                            method="POST">
                            @csrf
                            {{-- @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-100">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">ID
                                    User:</label>
                                <input value="{{ $d->id }}" type="text"
                                    class="form-control txt w-*" id="recipient-name" name="id" readonly>
                            </div>
                        </div>

                        </div>
                        <div class="row">
                            <div class="col-md-100">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control txt" id="name"
                                        name="name" value="{{ $d->name }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-100">
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email:</label>
                                    <input type="text" class="form-control txt" id="email"
                                        name="email" value="{{ $d->email }}" required>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-100">
                                    <div class="form-group">
                                        <label for="password"
                                            class="col-form-label">Masukan Passwordmu:</label>
                                        <input type="text" class="form-control" id="password"
                                            name="password" value="" required>
                                    </div>
                                </div>
                            </div>
                           <div class="row">
                            <div class="col-md-100">
                                    <label for="role" class="col-form-label">Select
                                        Role:</label><br>
                                    <select class="form-select" aria-label="Default" {{--
                                        class="form-select form-select-lg select bg-primary"
                                        --}} name="role" id="role" required>
                                        <option value="{{ $d->role }}" selected>{{ $d->role }}
                                            </option>
                                        <option value="admin">Admin</option>
                                        <option value="kasir">Kasir</option>
                                    </select>
                            </div>
                           </div>
                            

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">Change
                            User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endforeach
        {{-- Edit --}}
        {{-- MODAL EDIT END END --}}
        {{-- KUMPULAN MODAL END END  --}}
        {{-- @foreach ($datauser as $d) --}}

        {{-- MODAL DELETE --}}
        
    {{-- @endforeach --}}
        {{-- MODAL DELETE END END --}}
@endsection