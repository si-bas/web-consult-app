<h5 class="mb-1"><i class="bx bx-info-circle"></i> Informasi Personal</h5>
<table class="table table-borderless mb-2" style="width: 100%">
    <tbody class="table-desktop">
        <tr>
            <td>Nama:</td>
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
    </tbody>
    <tbody class="table-mobile">
        <tr>
            <td><b>Nama:</b> {{ $user->name }}</td>
        </tr>
        <tr>
            <td><b>NIP:</b> {{ $user->lecturer->nip }}</td>
        </tr>
        <tr>
            <td><b>Program Studi:</b> {{ $user->lecturer->major->name }}</td>
        </tr>
        <tr>
            <td><b>Fakultas:</b> {{ $user->lecturer->major->faculty->name }}</td>
        </tr>
        <tr>
            <td><b>Jenis Kelamin:</b> {{ $user->lecturer->gender->name }}</td>
        </tr>
    </tbody>
</table>
<h5 class="mb-1"><i class="bx bx-info-circle"></i> Jadwal Kontrak</h5>
<table class="table mb-0 table-hover" style="width: 100%">
    <thead>
        <tr>
            <th>HARI</th>
            <th>DARI</th>
            <th>HINGGA</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($schedules as $i => $item)
            <tr>
                <td>
                    <a href="{{ route('consult.student.select.schedule', ['id' => $item->id]) }}">{{ $item->day->name }}</a>
                </td>
                <td>
                    {{ $item->start_time }}
                </td>
                <td>
                    {{ $item->end_time }}
                </td>
                <td class="text-center">
                    <a href="{{ route('consult.student.select.schedule', ['id' => $item->id]) }}" class="btn mr-1 mb-1 btn-outline-primary btn-sm">Pilih</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>