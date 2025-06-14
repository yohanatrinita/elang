@extends('layouts.app')

@section('content')
<style>
    .btn-action {
        min-width: 100px;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
    }
</style>

<div class="container mt-4">

    <h4 class="mb-4 fw-bold">Verifikasi User</h4>

    {{-- Belum diverifikasi --}}
    <div class="table-responsive mb-5">
        <table class="table table-bordered text-center align-top">
            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th class="text-start">Nama</th>
                    <th class="text-start">Email</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $i => $user)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="text-start">{{ $user->name }}</td>
                        <td class="text-start">{{ $user->email }}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-start gap-2">
                                <form method="POST" action="{{ route('admin.users.verify', $user->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success btn-action">Verifikasi</button>
                                </form>
                                <form class="d-inline" onsubmit="event.preventDefault(); showRejectModal({{ $user->id }}, '{{ $user->name }}')">
                                    <button type="submit" class="btn btn-sm btn-danger btn-action">Tolak</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-muted">Tidak ada user untuk diverifikasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Sudah diverifikasi --}}
    <h4 class="fw-bold mb-3">Daftar Akun Terverifikasi</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->has('admin_password'))
        <div class="alert alert-danger">{{ $errors->first('admin_password') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered text-center align-top">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th class="text-start">Nama</th>
                    <th class="text-start">Email</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @php $n = 1; @endphp
                @foreach (\App\Models\User::where('role', 'staff')->where('is_verified', true)->get() as $verified)
                    <tr>
                        <td>{{ $n++ }}</td>
                        <td class="text-start">{{ $verified->name }}</td>
                        <td class="text-start">{{ $verified->email }}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-start">
                                <button class="btn btn-sm btn-danger btn-action" onclick="showModal({{ $verified->id }}, '{{ $verified->name }}')">Hapus</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @if($n == 1)
                    <tr>
                        <td colspan="4" class="text-muted">Belum ada akun yang terverifikasi.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Modal Tolak -->
    <div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="" id="tolakForm">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Penolakan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menolak dan menghapus user <strong id="tolakUserName"></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-action" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger btn-action">Tolak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="" id="hapusForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p>Masukkan password Anda untuk menghapus <span id="namaUser"></span>:</p>
                        <input type="password" name="admin_password" class="form-control" required placeholder="Password Anda">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-action" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger btn-action">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function showModal(id, name) {
        const form = document.getElementById('hapusForm');
        form.action = '/admin/users/' + id + '/secure-delete';
        document.getElementById('namaUser').innerText = name;
        new bootstrap.Modal(document.getElementById('hapusModal')).show();
    }

    function showRejectModal(id, name) {
        const form = document.getElementById('tolakForm');
        form.action = '/admin/users/' + id;
        document.getElementById('tolakUserName').innerText = name;
        new bootstrap.Modal(document.getElementById('tolakModal')).show();
    }
</script>
@endsection
