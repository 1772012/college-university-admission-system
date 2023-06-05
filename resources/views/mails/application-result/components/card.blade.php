{{-- Card --}}
<div class="card">

    {{-- Header --}}
    <img class="img-logo" src="https://join.maranatha.edu/assets/images/logos/maranatha.png" alt="Logo Maranatha">

    {{-- Recipient --}}
    <p>
    <div>
        <span class="font-weight-bold">Yth.</span>
        <span>{{ $content['user_name'] }}</span>,
    </div>
    <div>
        <span class="font-weight-bold">NIK/NRP</span>
        <span>: {{ $content['user_nrp'] }}</span>
    </div>
    </p>

    {{-- Content --}}
    <p>
        @if ($content['is_accepted'])
            Berdasarkan program studi yang anda daftar, anda <span style="color: green">DIREKOMENDASIKAN</span> untuk
            masuk ke program studi yang telah anda pilih.
        @else
            Berdasarkan program studi yang anda daftar, anda <span style="color: red">TIDAK DIREKOMENDASIKAN</span> untuk
            masuk ke program studi yang telah anda pilih.
        @endif
    </p>

    {{-- Warning --}}
    <small class="font-xs font-italic">
        << Dimohon untuk tidak membalas alamat email ini>>
    </small>

</div>
