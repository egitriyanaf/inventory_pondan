@extends('index')

@section('content')
  <section class="content-header">
      <h1>
        Beranda
        <small>Panel Kendali</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Beranda</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ count($barang) }}</h3>

              <p>Barang</p>
            </div>
            <div class="icon">
              <i class="ion ion-cube"></i>
            </div>
            @if(Auth::user()->level == 'User')
            <a href="{{ url('barang') }}" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          @endif
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ count($pelanggan) }}</h3>

              <p>Pelanggan</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            @if(Auth::user()->level == 'User')
            <a href="{{ url('pelanggan') }}" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          @endif
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ count($satuan) }}</h3>

              <p>Satuan</p>
            </div>
            <div class="icon">
              <i class="fa fa-balance-scale"></i>
            </div>
            @if(Auth::user()->level == 'User')
            <a href="{{ url('satuan') }}" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          @endif
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ count($transaksi) }}</h3>

              <p>Barang Keluar</p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            @if(Auth::user()->level == 'User')
            <a href="{{ url('barang_keluar') }}" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          @endif
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ count($barangMasuk) }}</h3>

              <p>Barang Masuk</p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            @if(Auth::user()->level == 'User')
            <a href="{{ url('barang_masuk') }}" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          @endif
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ count($suratJalan) }}</h3>

              <p>Surat Jalan</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text-o"></i>
            </div>
            @if(Auth::user()->level == 'User')
            <a href="{{ url('surat_jalan') }}" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          @endif
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ count($pengguna) }}</h3>

              <p>Pengguna</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-plus"></i>
            </div>
            @if(Auth::user()->level == 'User')
            <a href="{{ url('pengguna') }}" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          @endif
          </div>
        </div>
      </div>
    </section>
@endsection