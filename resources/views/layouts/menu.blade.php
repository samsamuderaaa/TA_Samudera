<ul class="nav">
    <li class="{{ Request::is('dashboard')? 'active':'' }}">
        <a href="{{ url('dashboard') }}">
            <i class="nc-icon nc-bank"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="{{ Request::is('kriteria')? 'active':'' }}">
        <a href="{{ url('kriteria') }}">
            <i class="nc-icon nc-diamond"></i>
            <p>Kriteria</p>
        </a>
    </li>
    <li class="{{ Request::is('maskapai')? 'active':'' }}">
        <a href="{{ url('maskapai') }}">
            <i class="nc-icon nc-bus-front-12"></i>
            <p>Kapal</p>
        </a>
    </li>

    {{-- @if ($user->role == 'super') --}}
    <li class="{{ Request::is('admin')? 'active':'' }}">
        <a href="{{ url('admin') }}">
            <i class="nc-icon nc-single-02"></i>
            <p>Data Admin</p>
        </a>
    </li>

    {{-- @endif --}}

    <li class="{{ Request::is('data-kuesioner')? 'active':'' }}">
        <a href="{{ url('data-kuesioner') }}">
            <i class="nc-icon nc-single-copy-04"></i>
            <p>Data Kuesioner</p>
        </a>
    </li>
    <li class="{{ Request::is('perhitungan')? 'active':'' }}">
        <a href="{{ url('perhitungan') }}">
            <i class="nc-icon nc-ruler-pencil"></i>
            <p>Hasil Perhitungan</p>
        </a>
    </li>
    <li class="{{ Request::is('laporan')? 'active':'' }}">
        <a href="{{ url('laporan') }}">
            <i class="nc-icon nc-tile-56"></i>
            <p>Laporan</p>
        </a>
    </li>
    <li>
        <form action="{{ url('logout') }}" method="POST">
            @csrf
            <div class="mx-4">
                <button type="submit" class="btn btn-danger btn-block" >logout</button>
            </div>
        </form>
    </li>
</ul>
