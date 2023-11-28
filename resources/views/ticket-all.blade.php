<div class="row row-cols-6">
    @foreach ($ticket as $data)
        <div class="col-12 col-sm-4 d-flex justify-content-center pb-4">
            <div class="card border-info">
                <a href="http://localhost:3000/ticket/{{ $data->slug }}">
                    <img class="card-img-top" src="{{ $data->ticket->image }}" style="object-fit: contain" />
                </a>
                <div class="card-body">
                    <a href="http://localhost:3000/ticket/{{ $data->slug }}"
                        style="text-decoration: none; color: black;">
                        <h5 class="card-title fw-bold">{{ $data->ticket->name }}</h5>
                    </a>
                    <p class="card-text"
                        style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        {{ $data->ticket->description }}</p>
                    <p class="card-text text-danger fw-bold">Price: {{ number_format($data->price, '0', '.', ',') }}đ</p>
                    @if ($data->seller_id)
                        <button seller_link="{{  $data->seller->link  }}" class="card-text text-primary  fw-bold border-0 filter_name" style="background-color: transparent;">Owner: {{ $data->seller->name }}</button>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
