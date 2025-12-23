<div class="modal fade" id="modal-form" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="user-form" method="POST">
            @csrf
            <input type="hidden" name="_method" id="method">

            <div class="modal-content">
                <div class="modal-header justify-between">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" onclick="hideModalForm()">&times;</button>
                </div>

                <div class="modal-body space-y-3">
                    <input type="text" name="name" class="form-control" placeholder="Nama" required>
                    <div class="invalid-feedback"></div>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <div class="invalid-feedback"></div>
                    <input type="number" name="phone" class="form-control" placeholder="Nomor Telepon">
                    <div class="invalid-feedback"></div>
                    <input type="text" name="address" class="form-control" placeholder="Alamat">
                    <div class="invalid-feedback"></div>

                    <select name="role" class="form-select">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>

                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="invalid-feedback"></div>
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Konfirmasi Password">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-warning" onclick="hideModalForm()">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
