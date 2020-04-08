<h5 class="mb-1"><i class="bx bx-info-circle"></i> Informasi Personal</h5>
<table class="table table-borderless mb-0">
    <tbody>
        <tr>
            <td>Nama Lengkap:</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>NIM:</td>
            <td>{{ $user->student->student_id_number }}</td>
        </tr>
        <tr>
            <td>Umur:</td>
            <td>{{ $user->student->profile->age }} tahun</td>
        </tr>
        <tr>
            <td>Semester:</td>
            <td>{{ $user->student->profile->semester }}</td>
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
<input type="hidden" name="id" value="{{ $user->id }}">
<input type="hidden" name="verified_at" value="{{ $user->verified_at }}">