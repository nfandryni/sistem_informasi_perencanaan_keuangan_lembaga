@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('title', 'Daftar Perencanaan Keuangan')
@section('content')
    <div class="row">

        <h2 class="fw-bold" style='position:relative; top:15px;'> Data Perencanaan Keuangan</h2>

        <div class="col-md-12">
            <div class="row justify-content-md-end" style="align-items: center">
                @if (!$perencanaan_keuangan->isEmpty())
                    <a target='_blank' href="{{ url('/perencanaan-keuangan/print') }}"
                        style='position:relative; width:130px; right:30px; top: -30px;' class='btn btn-warning'>
                        <i class="fa-solid fa-print fa-lg"></i> Cetak Data
                    </a>
                @else
                    <button disabled style='position:relative; width:130px; right:30px; top: -30px;'
                        class='btn btn-secondary'>
                        <i class="fa-solid fa-print fa-lg"></i> Cetak Data
                    </button>
                @endif
                
                <br />
                <hr>
            </div>
        </div>
        <p>
        <table class="table table-hover table-borderless table-striped DataTable">
            <thead>
                <tr>
                    <th>Judul Perencanaan</th>
                    <th>Sumber Dana</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perencanaan_keuangan as $s)
                    <tr>
                        <td>{{ $s->judul_perencanaan }}</td>
                        <td>{{ $s->nama_sumber }}</td>
                        <td>{{ $s->waktu }}</td>
                        <td>
                            
                            <a href="perencanaan-keuangan/detail/{{ $s->id_perencanaan_keuangan }}"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-circle-info" style="margin: 0 2px; cursor:pointer"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                {{-- <tr>
                        <td> Perbaikan Fasilitas </td>
                        <td> BOS</td>
                        <td> 2024-01-26</td>
                        <td>
                            
                            <a href="perencanaan-keuangan/detail/1"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-circle-info" style="margin: 0 2px; cursor:pointer"></i>
                            </a>
                        </td>
                    </tr> --}}
            </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
@endsection

@section('footer')
    <script type="module">
        $('.DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idPerencanaanKeuangan = $(this).closest('.btnHapus').attr('idPerencanaanKeuangan');
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
                        url: '/dashboard-bendahara/perencanaan-keuangan/hapus',
                        data: {
                            id_perencanaan_keuangan: idPerencanaanKeuangan,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                swal.fire('Berhasil di hapus!', '', 'success').then(function() {
                                    location.reload();
                                });
                            } else {
                                swal.fire('Tidak dapat dihapus!',
                                    'Perencanaan telah menjadi Realisasi!', 'error').then(
                                    function() {
                                        location.reload();
                                    });
                            }
                        }
                    });
                }
            });
        });
        $(document).ready(function() {
            $('.DataTable').DataTable({});
        });
    </script>

@endsection
