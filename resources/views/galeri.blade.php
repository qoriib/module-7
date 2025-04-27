@extends('layouts.app')

@section('content')

<!-- Tambahan Sweet Alert -->
@if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                timer: 3000,
                showConfirmButton: false
            });
        });
    </script>
@endif
<!-- Akhir Tambahan Sweet Alert -->

<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart" aria-labelledby="My Cart">
  <div class="offcanvas-header justify-content-center">
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="order-md-last">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Jumlah Barang</span>
        <span id="cart-count" class="badge bg-primary rounded-pill">{{$jmlbarangdibeli ?? 0}}</span>
      </h4>
      
        <li class="list-group-item d-flex justify-content-between">
              <span>Total (IDR)</span>
              <strong id="cart-total">{{rupiah($total_belanja) ?? 0}}</strong>
        </li>
      

      <!-- <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button> <br><br> -->
      <button class="w-100 btn btn-primary btn-lg" type="submit" onclick="window.location.href='/lihatkeranjang'">Lihat Keranjang</button> <br><br>
      <a href="/" class="w-100 btn btn-dark btn-lg" type="submit">Lihat Galeri</a> <br><br>
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
            <span class="cart-total fs-5 fw-bold" id="total_belanja">{{rupiah($total_belanja) ?? 0}}</span>
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

        <div class="bootstrap-tabs product-tabs">
          <div class="tabs-header d-flex justify-content-between border-bottom my-5">
            <h3>Produk Terbaru</h3>
          </div>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
             <!-- Tambahan untuk CSRF -->
             <meta name="csrf-token" content="{{ csrf_token() }}">
             <!-- Akhir Tambahan untuk CSRF -->
             <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                @foreach($barang as $p)
                <div class="col">
                  <div class="product-item">
                    <a href="#" class="btn-wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></a>
                    <figure>
                      <a href="{{ $p->foto }}" title="Product Title">
                        <img src="{{ $p->foto }}" class="tab-image">
                        <!-- <img src="images/thumb-bananas.png"  class="tab-image"> -->
                      </a>
                    </figure>
                    <h3>{{$p->nama_barang}}</h3>
                    <span class="qty">{{ $p->stok }} Unit</span><span class="rating"><svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> {{ $p->rating }}</span>
                    <span class="price">{{rupiah($p->harga_barang*1.2)}}</span>
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="input-group product-qty">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-id="{{ $p->id }}" data-type="minus">
                              <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                            </button>
                        </span>
                        <input type="text" id="quantity-{{ $p->id }}" name="quantity" class="form-control input-number" value="1">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-id="{{ $p->id }}" data-type="plus">
                                <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                            </button>
                        </span>
                      </div>
                      <a href="#" class="nav-link" onclick="addToCart({{$p->id}})">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <!-- / product-grid -->
              
            
          </div>
        </div>

      </div>
    </div>
  </div>
</section>


@endsection

@push('scripts')
<script>
  // event handler untuk proses tombol di tekan 
  document.addEventListener("click", function(event) {
          let target = event.target.closest(".btn-number"); // Pastikan tombol yang diklik adalah tombol plus/minus
  
          if (target) {
              let productId = target.getAttribute("data-id"); // Ambil ID produk dari tombol
              let quantityInput = document.getElementById("quantity-" + productId);
              // console.log(productId);
              // console.log(quantityInput.value);
              if (quantityInput) {
                  let value = parseInt(quantityInput.value) || 0;
                  let type = target.getAttribute("data-type"); // Cek apakah tombol plus atau minus
  
                  if (type === "plus") {
                      quantityInput.value = value + 1;
                  } else if (type === "minus" && value > 1) { 
                      // Mencegah nilai negatif atau nol
                      quantityInput.value = value - 1;
                  }
                  // console.log(quantityInput.value);
                  // Ambil nilainya setelah diubah
                  let currentQty = quantityInput.value;
              }
          }
      });
  
      // fungsi untuk menangani request
  function addToCart(productId) {
      // let quantity = document.getElementById('quantity-' + productId).value;
      let quantityInput = document.getElementById("quantity-" + productId);
      let quantity = parseInt(quantityInput.value) || 1;
      // let quantity = quantityInput.value;
      // console.log(quantity);
      // console.log(productId);
          // Data yang dikirim ke controller
      let formData = new FormData();
      formData.append('product_id', productId);
      formData.append('quantity', quantity);
      
      // Kirim data ke Laravel melalui fetch ke method tambah
      fetch('/tambah', {
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Ambil CSRF Token
          },
          body: formData
      })
      .then(response => response.json()) // Ubah respons menjadi JSON
      // .then(response => {
      //         console.log(response.text());
      //         return response.text(); // Cek apakah ini JSON yang valid
      //       }
      // ) // Ubah respons menjadi JSON
      // .then(response => response.text()) // Ubah respons menjadi JSON
      // .then(text => {
      // console.log("RESPONSE:", text); // Lihat isi HTML error
      //     try {
      //         const data = JSON.parse(text);
      //         console.log(data);
      //     } catch (err) {
      //         console.error("Gagal parsing JSON:", err);
      //     }
      // })
      .then(data => {
          if (data.success) {
              // alert("Produk berhasil ditambahkan ke keranjang!");
              // Sweet Alert
              Swal.fire({
                  icon: 'success',
                  title: 'Berhasil!',
                  text: 'Produk berhasil ditambahkan ke keranjang!',
                  showConfirmButton: false,
                  timer: 2000 // Popup otomatis hilang setelah 2 detik
              });
              // let vtotal = new Intl.NumberFormat("en-IN").format(data.total);
              let formatter = new Intl.NumberFormat('id-ID', {
                              style: 'currency',
                              currency: 'IDR',
                              minimumFractionDigits: 0
                          });
              let vtotal = formatter.format(data.total);
              document.getElementById('cart-total').textContent = "Total: " +vtotal;
              document.getElementById('total_belanja').textContent = vtotal;
              // jmlbarangdibeli
              document.getElementById('cart-count').textContent = data.jmlbarangdibeli;
          //     // console.log(response.json());
          } else {
              alert("Gagal menambahkan produk ke keranjang.");
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Gagal menambahkan produk ke keranjang!'
              });
              // alert(response.text());
          }
      })
      // .catch(error => console.error('Error:', error));
  }
  
  </script>
  
@endpush