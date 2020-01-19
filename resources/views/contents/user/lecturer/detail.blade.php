<h5 class="mb-1"><i class="bx bx-info-circle"></i> Informasi Personal</h5>
<table class="table table-borderless mb-0">
    <tbody>
        <tr>
            <td>Nama Lengkap:</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>NIP:</td>
            <td>{{ $user->lecturer->nip }}</td>
        </tr>
        <tr>
            <td>Program Studi:</td>
            <td>{{ $user->lecturer->major->name }}</td>
        </tr>
        <tr>
            <td>Fakultas:</td>
            <td>{{ $user->lecturer->major->faculty->name }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin:</td>
            <td>{{ $user->lecturer->gender->name }}</td>
        </tr>
        <tr>
            <td>Tempat/Tanggal Lahir:</td>
            <td>{{ $user->lecturer->place_of_birth ?? '' }}, {{ $user->lecturer->date_of_birth }}</td>
        </tr>
        <tr>
            <td>Alamat:</td>
            <td>{{ $user->lecturer->address ?? '' }}</td>
        </tr>
        <tr>
            <td>Alamat Email:</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>Terdaftar Pada:</td>
            <td>{{ \Carbon\Carbon::parse($user->created_at)->formatLocalized("%d %B %Y") }}</td>
        </tr>
    </tbody>
</table>