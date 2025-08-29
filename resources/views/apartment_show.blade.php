@extends('layouts.base')
@section('content')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            flatpickr("#datepicker", {
                dateFormat: "Y-m-d",
                minDate: "today",
                closeOnSelect: false,
                disable: @json($bookings->map(fn($b) => [
                    'from' => $b->date_start,
                    'to'   => $b->date_end,
                ]), JSON_THROW_ON_ERROR)
            });
        });
    </script>

    <h3>Apartment</h3>
    <hr>
    {{$apartment->name}}
    {{$apartment->avgRating}}

    <form action="{{route('booking.store',$apartment)}}" method="post">
        @csrf
        <input id="datepicker" class="form-control w-25" type="date" placeholder="Дата начала" name="date_start"
               value="{{ request('date_start')}}">
        <input id="datepicker" class="form-control w-25" type="date" placeholder="Дата окончания" name="date_end"
               value="{{ request('date_end')}}">
        <input class="btn btn-primary" type="submit">
    </form>

    {{--    Cooment Form--}}


    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                <div class="card-body p-4">
                    <div data-mdb-input-init class="form-outline mb-4">
                        <form action="{{ route('apartments.comments.store', $apartment) }}" method="POST"
                              class="d-flex gap-2">
                            @csrf
                            <input class="form-control" type="text" name="text" placeholder="Ваш комментарий">
                            <select name="rating" id="">
                                <option value="5" selected>5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </form>


                    </div>
                    @forelse($comments  as $comment)

                        <div class="card mb-4">
                            <div class="card-body">
                                <p>{{$comment -> text}}</p>
                                <p>Оценка:{{$comment -> rating}}</p>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(4).webp"
                                             alt="avatar"
                                             width="25"
                                             height="25"/>
                                        <p class="small mb-0 ms-2">{{$comment->user->name}}</p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        @can('delete',$comment)
                                            <form
                                                action="{{route('apartments.comments.destroy',[$apartment,$comment])}}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <input class="btn btn-danger" type="submit" value="delete">
                                            </form>
                                        @endcan
                                        @can('update',$comment)
                                        <form action="{{route('apartments.comments.update',[$apartment,$comment])}}"
                                              method="post">
                                            @csrf
                                            @method('put')
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#comment-{{$comment->id}}">
                                                update
                                            </button>
                                        </form>
                                            @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="comment-{{$comment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{route('apartments.comments.update',[$apartment,$comment])}}" method="post">

                                        <div class="modal-body">
                                            @csrf
                                            @method('put')
                                            <input class="form-control" type="text" name="text" value="{{old('text',$comment->text)}}">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button id="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
    </div>




@endsection
