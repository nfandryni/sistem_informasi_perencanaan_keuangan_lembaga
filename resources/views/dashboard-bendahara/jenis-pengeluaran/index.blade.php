@extends('layout.layout')
@section('jenis-pengeluaran', 'active')
@section('title', 'Daftar Jenis Pengeluaran')
@section('content')
<br>
<div class="row"><h2 class="fw-bold">Kelola Data Master - Jenis Pengeluaran</h2>
    <hr>
    <div class="col-md-12">
                    <div class="row justify-content-md-end" style="align-items: center">
                      
                        <div class="col-sm-2">
                        <div class="col" >
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" style='position:absolute; margin-top:20px;' data-bs-target="#tambahJenisPengeluaran">
                            Tambah Data
                            </button>
                        </div>
                        </div>
                    </div>
                    </div>
                         </div>

                        <table class="table table-borderless table-striped mt-2 DataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenis_pengeluaran as $s)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $s->kategori }}</td>
                                        <td>
                                        <a class='text-black' href="/dashboard-bendahara/jenis-pengeluaran/edit/{{ $s->id_jenis_pengeluaran }}"> <i class="fa-solid fa-pen" style="cursor: pointer; margin:2px">
                                           </i></a>
                                            <btn class="btnHapus" style="cursor: pointer;" idJenisPengeluaran="{{ $s->id_jenis_pengeluaran }}"><i class="fa-solid fa-trash"></i></btn>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
    
@include('dashboard-bendahara.jenis-pengeluaran.tambah')
@endsection
@section('footer')
    <script type="module">
        $('tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idJenisPengeluaran = $(this).closest('.btnHapus').attr('idJenisPengeluaran');
            swal.fire({
                title: "Apakah Anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/dashboard-bendahara/jenis-pengeluaran/hapus',
                        data: {
                            id_jenis_pengeluaran: idJenisPengeluaran,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                swal.fire('Berhasil di hapus!', '', 'success').then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
        $(document).ready(function() {
        $('.DataTable').DataTable({
        });
    });
    </script>

@endsection