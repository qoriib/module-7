@extends('layouts.app')

@section('content')
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart" aria-labelledby="My Cart">
    <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Jumlah Barang</span>
            <span id="cart-count" class="badge bg-primary rounded-pill">{{$jml_brg ?? 0}}</span>
        </h4>

        <li class="list-group-item d-flex justify-content-between">
                <span>Total (IDR)</span>
                <strong id="cart-total">{{rupiah($total_tagihan) ?? 0}}</strong>
        </li>

        <button class="w-100 btn btn-primary btn-lg" type="submit" onclick="window.location.href='/lihatkeranjang'">Lihat Keranjang</button> <br><br>
        <a href="/depan" class="w-100 btn btn-dark btn-lg" type="submit">Lihat Galeri</a> <br><br>
        <a href="/lihatriwayat" class="w-100 btn btn-info btn-lg" type="submit">Riwayat Pemesanan</a> <br><br>
        <a href="/logout" class="w-100 btn btn-danger btn-lg" type="submit">Keluar</a>
        </div>
    </div>
    </div>

    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasSearch" aria-labelledby="Search">
    <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Search</span>
        </h4>
        <form role="search" action="/" method="get" class="d-flex mt-3 gap-0">
            <input class="form-control rounded-start rounded-0 bg-light" type="email" placeholder="What are you looking for?" aria-label="What are you looking for?">
            <button class="btn btn-dark rounded-end rounded-0" type="submit">Search</button>
        </form>
        </div>
    </div>
    </div>

    <header>
    <div class="container-fluid">
        <div class="row py-3 border-bottom">
        
        <div class="col-sm-4 col-lg-3 text-center text-sm-start">
            <div class="main-logo">
            <a href="/">
                <img src="images/logo.png" alt="logo" class="img-fluid">
            </a>
            </div>
        </div>
        
        <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
            <div class="search-bar row bg-white p-2 my-2 rounded-4">
            <div class="col-1">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z"/></svg> -->
            </div>
            </div>
        </div>
        
        <div class="col-sm-8 col-lg-4 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">

            <ul class="d-flex justify-content-end list-unstyled m-0">
            <li class="d-lg-none">
                <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#cart"></use></svg>
                </a>
            </li>
            <li class="d-lg-none">
                <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch">
                <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#search"></use></svg>
                </a>
            </li>
            </ul>

            <div class="cart text-end d-none d-lg-block dropdown">
            <button class="border-0 bg-transparent d-flex flex-column gap-2 lh-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                <span class="fs-6 text-muted dropdown-toggle">Keranjang Anda</span>
                <span class="cart-total fs-5 fw-bold" id="total_belanja">{{rupiah($total_tagihan) ?? 0}}</span>
            </button>
            </div>
        </div>

        </div>
    </div>
    
    </header>

    <section class="py-5">
    <div class="container-fluid">
        
        <div class="row">
        <div class="col-md-12">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Riwayat Pemesanan Anda</span>
            </h4>

            <!-- Tambahan List -->
            <ul class="list-group mb-3">
            @php
                $totalTagihan = 0;
            @endphp
            @foreach($transaksi as $p)
                @php
                $totalTagihan += $p->tagihan;
                @endphp
                <li class="list-group-item d-flex justify-content-between">
                <div>
                
                    <h6 class="my-0">{{ $p->no_faktur }}</h6>
                    <strong>status: ter{{$p->status}} pada {{$p->tgl}} </strong>
                    <strong>tagihan: {{rupiah($p->tagihan)}} </strong>
                
                <ul class="mt-2 mb-0 ps-3">
                    @foreach($detail_barang[$p->id] ?? [] as $barang)
                    <li>
                        {{ $barang->nama_barang }} x {{ $barang->jml }} = {{ rupiah($barang->harga_jual*$barang->jml) }}
                    </li>
                    @endforeach
                </ul>
                </div>
                </li>
            @endforeach
                <li class="list-group-item d-flex justify-content-between bg-light">
                <div class="text-success">
                    <h6 class="my-0">Total Transaksi</h6>
                </div>
                <span><strong>{{ rupiah($totalTagihan) }}</strong></span>
                </li>
            </ul>
            <!-- <button class="w-100 btn btn-primary btn-lg" type="submit">Bayar</button> -->
            <!-- Akhir tambahan list -->

        </div>
        </div>
    </div>
    </section>
@endsection