<x-profile :sharedData="$sharedData" doctitle="{{ $sharedData['username'] }}'s Profile">
    <div class="list-group">
        @foreach ($posts as $post)
            @foreach ($posts as $post)
                <x-post :post="$post" hideAuthor/>
            @endforeach
        @endforeach
    </div>
</x-profile>
