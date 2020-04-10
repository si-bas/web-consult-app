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
    </tbody>
</table>

<h5 class="mb-1"><i class="bx bx-info-circle"></i> Formulir</h5>
@csrf
<input type="hidden" name="id" value="{{ $user->id }}">
<div class="col-12">
    <fieldset class="form-group">
        <label for="basicInput">E-Mail</label>
        <input type="email" class="form-control" placeholder="Tuliskan email" name="email" value="{{ $user->email }}" required>
    </fieldset>
    <fieldset class="form-group">
        <label for="basicInput">Kata Sandi (diisi apabila ingin diubah)</label>
        <input type="password" class="form-control" placeholder="Tuliskan kata sandi baru" name="password">
    </fieldset>
</div>
<div class="alert bg-rgba-primary alert-dismissible mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="d-flex align-items-center">
        <i class="bx bxs-info-circle"></i>
        <span>
            Informasi akun akan dikirimkan ke email tercantum saat menyimpan perubahan data.
        </span>
    </div>
</div>

<button type="submit" style="display: none"></button>