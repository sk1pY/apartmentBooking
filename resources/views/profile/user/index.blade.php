@extends('profile.index')
@section('profile')
    <a href="{{route('profile.edit')}}">Update profile</a>

    {{--   ------------------------------------------------------------------------------------------------- --}}
    <div class="mt-4 border rounded-5 p-3 w-auto bg-white d-flex text-muted">
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#passwordChangeModal">
            Сменить пароль
        </button>
        <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#mailChangeModal">
            Сменить почту
        </button>
        <div class=" rounded-pill ">
            <button style="font-size: 1rem" type="button" class="btn " data-bs-toggle="modal"
                    data-bs-target="#deleteuser">
                Удалить аккаунт
            </button>
        </div>
        <div class="">
            <form action="{{route('logout')}}" id="logout-form" method="post">
                @csrf
                <button type="submit" class="btn"
                        onclick="return confirm('Точно выйти из аккаунта?')">
                    Выйти из аккаунта
                </button>
            </form>
        </div>
    </div>
    <!-- Modal DELETE USER HOME PAGE-->
    <div class="modal fade" id="deleteuser" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Вы точно хотите удалить аккаунт?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{route('profile.destroy',$user)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal MAIL CHANGE-->
    <div class="modal fade" id="mailChangeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Сменить почту</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user-profile-information.update') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body ">
                        <input class="form-control" type="text" name="email" placeholder="email">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сменить почту</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal PASSWORD CHANGE-->
    <div class="modal fade" id="passwordChangeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Сменить пароль</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user-password.update') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body ">
                        <input class="form-control my-2" type="password" name="current_password" required
                               placeholder="Текущий пароль">
                        <input class="form-control my-2" type="password" name="password" required
                               placeholder="Новый пароль">
                        <input class="form-control" type="password" name="password_confirmation" required
                               placeholder="Подтверждение пароля">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сменить пароль</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
