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
<h5 class="mb-1"><i class="bx bx-info-circle"></i> Konsultasi Via</h5>
<p>Pilih salah satu:</p>
<ul class="list-unstyled mb-3">
    <li class="mr-2 mb-1">
        <fieldset>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="custom-1-1" name="is_meeting" value="1" required>
                <label class="custom-control-label" for="custom-1-1">Pertemuan</label>
            </div>
        </fieldset>
    </li>
    <li class="mr-2 mb-1">
        <fieldset>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="custom-1-2" name="is_meeting" value="0" required>
                <label class="custom-control-label" for="custom-1-2">Percakapan Online (Chat)</label>
            </div>
        </fieldset>
    </li>
</ul>

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
                    <a href="javascript:;" onclick="selectSchedule({{ $item->id }})">{{ $item->day->name }}</a>
                </td>
                <td>
                    {{ $item->start_time }}
                </td>
                <td>
                    {{ $item->end_time }}
                </td>
                <td class="text-center">
                    <a href="javascript:;" onclick="selectSchedule({{ $item->id }})">Pilih</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>