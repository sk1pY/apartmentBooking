@extends('profile.index')
@section('profile')
    <h3>My apartments</h3>
    <hr>
    <table id="table" class="table table-sm table-bordered table-striped small align-middle text-center">
        <thead>
        <tr class="text-center align-middle">
            <th scope="col" class="col-4">apartment</th>
            <th scope="col" class="col-4">data</th>
            <th scope="col" class="col-2">option</th>
        </tr>
        </thead>
        <tbody class="tablecontents">
        @foreach($apartments as $apartment)
            <tr class="align-middle">

                <td class="text-center">
                    <a href="{{route('apartments.show',$apartment)}}">
                        {{$apartment->name}}
                    </a>
                </td>
                <td class=" text-center ">
                    <form action="{{route('profile.apartments.edit',$apartment)}}" method="get">
                        <button class="btn btn-info" type="submit">
                            update
                        </button>
                    </form>
                </td>
                <td class=" text-center ">
                    <form action="{{route('profile.apartments.destroy',$apartment)}}" method="post">
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
