@extends('layout.layout')
@section('pengeluaran', 'active ')
@section('title', 'Tambah Pengeluaran')
@section('content')
    <div class="row px-5">
        <div class="col-md-12">
                    <span class="h1">
                        Tambah Pengeluaran
                    </span>
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Sumber Dana</label>
                                    <select required class="form-select" name='id_sumber_dana'>
                                        @foreach ($sumber_dana as $s)
                                        <option selected hidden>Pilih Sumber Dana</option>
                                        <option value="{{$s->id_sumber_dana}}">{{$s->nama_sumber}}</option>
                                        @endforeach
                                    </select>
                                    <label>Jenis Pengeluaran</label>
                                    @if($jenis_pengeluaran->isEmpty())
                                    <br/>
                                    <a href='/dashboard-bendahara/jenis-pengeluaran' class="btn btn-primary btn-sm">
                                    Tambah Data
                                    </a>
                                    <br/>
                                    @else
                                    <select required class="form-select" name='id_jenis_pengeluaran'>
                                        @foreach ($jenis_pengeluaran as $s)
                                        <option selected hidden>Pilih Jenis Pengeluaran</option>
                                        <option value="{{$s->id_jenis_pengeluaran}}">{{$s->kategori}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    <label>Nama Pengeluaran</label>
                                    <input type="text" class="form-control" placeholder='Nama Pengeluaran' name="nama" required/>
                                    <label>Nominal</label>
                                    <input type="text" class="form-control" placeholder='Nominal' name="nominal" required/>
                                    <label>Waktu</label>
                                    <input type="date" class="form-control" name="waktu" required />
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto" required/>
                                </div>      
                                <div class='row'>
                                    <div class="col-md-4 mt-3" style="gap: 10px">
                                        <a href="/dashboard-bendahara/pengeluaran" <btn class="btn btn-dark">KEMBALI</btn></a>
                                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                                    </div>
                                    @csrf
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

        </div>
@endsection