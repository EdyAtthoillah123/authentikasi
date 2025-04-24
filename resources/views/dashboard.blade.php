<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Informasi | </title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href=" {{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body id="page-top">
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    @if (Session::has('success'))
        <script>
            toastr.success('Data Berhasil Ditambahkan', '')
        </script>
    @endif
    @if (Session::has('successedit'))
        <script>
            toastr.success('Data Berhasil Diedit', '')
        </script>
    @endif
    @if (Session::has('successeditgambar'))
        <script>
            toastr.success('Data Berhasil Diedit', '')
        </script>
    @endif
    @if (Session::has('successhapus'))
        <script>
            toastr.success('Data Berhasil Dihapus', '')
        </script>
    @endif
    @if ($errors->any())
        <script>
            toastr.error('Gagal Ditambahkan', '')
        </script>
    @endif

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #121212;">


            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="{{ asset('') }}" alt="Logo" width="25" height="25">
                </div>

                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Katalog</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('images/login/logo_dark.png') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <div class="mt-1">
                                <h6 class="m-0 font-weight-bold text-secondary">Katalog Produk</h6>
                            </div>
                            <div>
                                <button class="btn btn-sm" data-toggle="modal" data-target="#modalTambah"
                                    style="background-color: #121212; color: white"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>Tambah
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Gambar</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name_product }}</td>
                                                <td>
                                                    @foreach ($item->productImages as $image)
                                                        @php
                                                            $imagePaths = explode('|', $image->image);
                                                        @endphp
                                                        @foreach ($imagePaths as $path)
                                                            <img src="{{ asset('public/' . $path) }}" alt="Product Image"
                                                                style="width: 50px; height: auto;">
                                                        @endforeach
                                                    @endforeach
                                                </td>

                                                <td>{{ $item->description }}</td>
                                                <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                                                <td>
                                                    <div class="btn-group ">
                                                        <button type="button" class="btn btn-outline-warning"
                                                            data-toggle="modal"
                                                            data-target="#modalEdit{{ $item->id }}">
                                                            <span class="btn-label"><i
                                                                    class="fas fa-pencil-alt"></i></span>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger"
                                                            data-toggle="modal"
                                                            data-target="#modalHapus{{ $item->id }}">
                                                            <span class="btn-label"><i
                                                                    class="fas fa-trash-alt"></i></span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <div class="mt-1">
                                <h6 class="m-0 font-weight-bold text-secondary">Katalog Produk</h6>
                            </div>
                            <div>
                                <button class="btn btn-sm" data-toggle="modal" data-target="#modalTambahPortofolio"
                                    style="background-color: #121212; color: white"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>Tambah
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kegiatan</th>
                                            <th>Gambar</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($portofolio as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name}}</td>
                                                <td>
                                                    @foreach ($item->imagesPortofolio as $image)
                                                        @php
                                                            $imagePaths = explode('|', $image->image);
                                                        @endphp
                                                        @foreach ($imagePaths as $path)
                                                            <img src="{{ asset('' . $path) }}"
                                                                alt="Product Image"
                                                                style="width: 50px; height: auto;">
                                                        @endforeach
                                                    @endforeach
                                                </td>
                                                <td>{{ $item->description }}</td>
                                                <td>
                                                    <div class="btn-group ">
                                                        <button type="button" class="btn btn-outline-warning"
                                                            data-toggle="modal"
                                                            data-target="#modalEdit{{ $item->id }}">
                                                            <span class="btn-label"><i
                                                                    class="fas fa-pencil-alt"></i></span>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger"
                                                            data-toggle="modal"
                                                            data-target="#modalHapus{{ $item->id }}">
                                                            <span class="btn-label"><i
                                                                    class="fas fa-trash-alt"></i></span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Pendalungan Megah Solusi</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                {{-- <div class="modal-body">Yakin ingin Logout?
                </div> --}}
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{-- <form action="{{ route('katalog-store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="image[]" multiple
                                id="sxampleInputFile">
                        </div>
                        <div class="form-group">
                            <label for="name_product">Nama Produk</label>
                            <input type="text" class="form-control" name="name_product" required>
                            @error('name_product')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="id_category">Kategori</label>
                            <select class="form-control" name="id_category" id="id_category">
                                <option value="" {{ old('id_category') === '' ? 'selected' : '' }}>Pilih</option>
                                @foreach ($category as $value)
                                    <option value="{{ $value->id }}"
                                        {{ old('id_category') === $value->id ? 'selected' : '' }}>
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="3" required></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" required
                                oninput="maxLengthCheck(this)">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form> --}}
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    {{-- @foreach ($data as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('katalog/updateimage/' . $item->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <label for="">Gambar</label>
                            <div class="row form-group">
                                <div class="col-md-9">
                                    <input type="file" class="form-control-file" name="imageupdate[]" multiple
                                        id="sxampleInputFile">
                                </div>
                                <div class="col-md-2 ml-3">
                                    <button type=" submit" class="btn btn-Success"
                                        style="background-color: rgb(0, 189, 0); color: white;">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <form action="{{ url('katalog/update/' . $item->id) }}" method="post"
                        enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name_product">Nama Produk</label>
                                <input type="text" class="form-control" name="name_product"
                                    value="{{ $item->name_product }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea class="form-control" name="description" rows="3">{{ $item->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Harga</label>
                                <input type="number" class="form-control" value="{{ $item->price }}"
                                    id="price" name="price" required oninput="maxLengthCheck(this)">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach --}}

    <!-- Modal Hapus -->
    {{-- @foreach ($data as $item)
        <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin Ingin Menghapus Produk?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <form action="{{ route('katalog-destroy', $item->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach --}}


    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambahPortofolio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{-- <form action="{{ route('portofolio-store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Portofolio Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="image[]" multiple
                                id="sxampleInputFile">
                        </div>
                        <div class="form-group">
                            <label for="name_product">Nama Produk</label>
                            <input type="text" class="form-control" name="name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="3" required></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form> --}}
            </div>
        </div>
    </div>


    <script>
        function maxLengthCheck(input) {
            if (input.value.length > 9) {
                input.value = input.value.slice(0, 9);
            }
        }
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
</body>

</html>
{{-- 



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
