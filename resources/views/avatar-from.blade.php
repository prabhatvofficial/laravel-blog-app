<x-layout>
    <div class="container container--narrow py-md-5">
        <h2 class="text-center mb-3">Upload a new avatar</h2>
        <form action="/manage-avatar" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="file" name="avatar" required>
                @error('avatar')
                    <p class="alert small text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn btn-secondary">Save</button>
        </form>
    </div>
</x-layout>
