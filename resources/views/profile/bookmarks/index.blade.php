@extends('profile.index')
@section('profile')
    <h3>Bookings</h3>
    <hr>
    <table id="table" class="table table-sm table-bordered table-striped small align-middle text-center">
        <thead>
        <tr class="text-center align-middle">
            <th scope="col" class="col-4">apartment</th>
            <th scope="col" class="col-2">option</th>
        </tr>
        </thead>
        <tbody class="tablecontents">
        @foreach($bookmarks as $bookmark)
            <tr class="align-middle">

                <td class="text-center">
                    <a href="{{route('apartments.show',$bookmark->apartment)}}">
                        {{$bookmark->apartment->name}}
                    </a>
                </td>
                <td class=" text-center ">
                    <form action="{{route('profile.bookmarks.destroy',$bookmark)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger"
                                onclick="return confirm('Точно удалить?')"
                                type="submit">
                            delete
                        </button>
                    </form>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>

@endsection
