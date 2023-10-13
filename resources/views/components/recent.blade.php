<div class="container">
    <h2>Nos derniers biens</h2>
    <div class="row">
        @foreach($properties as $property)
            <div class="col">
                @include('properties.card')
            </div>
        @endforeach
    </div>
</div>
