@extends('admin.layout.app-layout')

@section('title', 'Manajemen User')

@push('css')
@endpush

@push('scripts')
    <script>
        const modal = $('#modal-form');
        const form = $('#user-form');
        const methodInput = $('#method');

        /* ===============================
            UTILITIES
        =============================== */

        function resetForm() {
            form[0].reset();
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.invalid-feedback').remove();
        }

        function showValidationErrors(errors) {
            $.each(errors, function(field, messages) {
                const input = form.find('[name="' + field + '"]');

                input.addClass('is-invalid');

                if (input.next('.invalid-feedback').length === 0) {
                    input.after('<div class="invalid-feedback"></div>');
                }

                input.next('.invalid-feedback').text(messages[0]);
            });
        }

        function hideModalForm() {
            modal.modal('hide');
            resetForm();
        }

        /* ===============================
            ADD USER
        =============================== */

        function addForm(url) {
            resetForm();

            modal.modal('show');
            modal.find('.modal-title').text('Tambah User');

            form.attr('action', url);
            methodInput.val('POST');

            form.off('submit').on('submit', submitForm);
        }

        /* ===============================
            EDIT USER
        =============================== */

        function editForm(url) {
            resetForm();

            modal.modal('show');
            modal.find('.modal-title').text('Edit User');

            form.attr('action', url);
            methodInput.val('PUT');

            // Ambil data user
            $.get(url)
                .done(function(res) {
                    form.find('[name=name]').val(res.name);
                    form.find('[name=email]').val(res.email);
                    form.find('[name=phone]').val(res.phone);
                    form.find('[name=address]').val(res.address);
                    form.find('[name=role]').val(res.role);
                })
                .fail(function() {
                    alert('Gagal mengambil data user');
                    modal.modal('hide');
                });

            form.off('submit').on('submit', submitForm);
        }

        /* ===============================
            SUBMIT FORM (ADD & EDIT)
        =============================== */

        function submitForm(e) {
            e.preventDefault();

            let formData = new FormData(form[0]);
            formData.append('_method', methodInput.val());

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    modal.modal('hide');
                    location.reload();
                    alert(res.message);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        showValidationErrors(xhr.responseJSON.errors);
                    } else {
                        alert(xhr.responseJSON?.message ?? 'Terjadi kesalahan');
                    }
                }
            });
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        location.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        console.log(errors);
                        return;
                    });
            }
        }
    </script>
@endpush

@section('content')
    <div class="p-6">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Manajemen User</h1>

            <button onclick="addForm('{{ route('admin.users.store') }}')" class="px-4 py-2 bg-blue-600 text-white rounded">+
                Tambah User</button>
        </div>

        @if (session('error'))
            <div class="mb-4 flex items-center gap-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <i class="fas fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-4 flex items-center gap-2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <i class="fas fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <table class="w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">Email</th>
                    <th class="border px-3 py-2">Nomor Telepon</th>
                    <th class="border px-3 py-2">Alamat</th>
                    <th class="border px-3 py-2">Role</th>
                    <th class="border px-3 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border px-3 py-2">{{ $user->name }}</td>
                        <td class="border px-3 py-2">{{ $user->email }}</td>
                        <td class="border px-3 py-2">{{ $user->phone ?? '-' }}</td>
                        <td class="border px-3 py-2">{{ $user->address ?? '-' }}</td>
                        <td class="border px-3 py-2 capitalize">{{ $user->role }}</td>
                        <td class="border px-3 py-2 space-x-2">
                            <button onclick="editForm('{{ route('admin.users.show', $user->id) }}')"
                                class="text-blue-600">Edit</button>

                            <button onclick="deleteData('{{ route('admin.users.destroy', $user->id) }}')"
                                class="text-red-600">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
        @includeIf('admin.users.form')
    </div>
@endsection
