@extends('app')

@section('content')
<h2>Daftar User Belum Terverifikasi</h2>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <form method="POST" action="{{ url('/verifikasi-user/' . $user->id) }}">
                    @csrf
                    <button type="submit">Verifikasi</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
