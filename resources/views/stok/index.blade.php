@extends('tabelstok')

<!-- START DATA -->
@section('konten')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- FORM PENCARIAN -->
    <div class="pb-3">
      <form class="d-flex" action="{{ url('Stok') }}" method="get">
          <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
          <button class="btn btn-secondary" type="submit">Cari</button>
      </form>
    </div>

    <!-- TOMBOL TAMBAH DATA -->
    <div class="pb-3">
        <div class="d-flex justify-content-end">
        <a href='{{ url('stok.create') }}' class="btn btn-primary" type="submit">+ Tambah Data</a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="page-header-title">
            {{-- <h5 class="m-b-10">Data Stok Barang</h5> --}}
            {{-- <p class="m-b-0">Welcome to SIMEKO!</p> --}}
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">Kode Barang</th>
                <th class="col-md-2">Nama Barang</th>
                <th class="col-md-3">Jumlah Barang</th>
                <th class="col-md-4">Stok Awal</th>
                <th class="col-md-5">Stok Akhir</th>
                <th class="col-md-5">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->jumlah_barang }}</td>
                <td>{{ $item->stok_awal }}</td>
                <td>{{ $item->stok_akhir }}</td>
                <td>
                    <a href='{{ url('Stok/'.$item->id.'/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline' action="{{ url('Stok/'.$item->id) }}"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
</div>
<!-- AKHIR DATA -->
@endsection
