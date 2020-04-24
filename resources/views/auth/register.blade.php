@extends('layouts.app')

@section('content')
    <div id="app">

        <!-- Form-->
        <div class="form">
            <div class="form-toggle"></div>
            <div class="form-panel one">
                <div class="form-header">
                    <h1>Register An Account</h1>
                </div>

                <div class="form-content">
                    <form action="  /register" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="role">Account type</label>
                            <select id="role"
                                    class="browser-default custom-select"
                                    name="role">
                                @foreach(App\Models\Role::all() as $role )
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group " id="username">
                            <label for="username">username</label>
                            <input type="text"
                                   name="username"
                                   placeholder="username (optional)"
                                   value="{{old('username')}}"/>
                        </div>
                        <div class="form-group " id="email">
                            <label for="email">Email<span style="color: red; font-weight: bold">*</span></label>
                            <input class="form-control @error('email') is-invalid @enderror"
                                   type="text"
                                   name="email"
                                   placeholder="example@mail.com"/>

                            @error('email')
                            <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" id="phone_number">
                            <label for="phone_number">Phone Number<span
                                    style="color: red; font-weight: bold">*</span></label>
                            <input class="form-control @error('phone_number') is-invalid @enderror" type="text"
                                   name="phone_number" placeholder="(0)12 564 7891"/>

                            @error('phone_number')
                            <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password<span style="color: red; font-weight: bold">*</span></label>
                            <input class="form-control @error('password') is-invalid @enderror" id="password"
                                   type="password" name="password" placeholder="********"/>


                            @error('password')
                            <span class="invalid-feedback">
                                @if($message == 'The password format is invalid.')
                                    <strong>The password contains characters from at least three of the following five categories:
                                        <ul>
                                            <li>English uppercase characters (A – Z)</li>
                                            <li>English lowercase characters (a – z)</li>
                                            <li>Base 10 digits (0 – 9)</li>
                                            <li>Non-alphanumeric (For example: !, $, #, or %)</li>
                                            <li>Unicode characters</li>
                                        </ul>
                                    </strong>
                                @else
                                    <strong>{{ $message }}</strong>
                                @endif
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password<span
                                    style="color: red; font-weight: bold">*</span></label>
                            <input id="confirm_password" type="password" name="confirm_password"
                                   placeholder="********"/>
                        </div>
                        <div class="form-group">
                            <label class="form-remember">
                                <input type="checkbox" name="agreement"/>
                                <span style="line-height: 1.2em">
                                    I have read and I agree to the <b> End User License Agreement, Terms of Sale and Policy Statement </b>
                                </span>
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="form-panel two">
            </div>
        </div>

        <div class="pen-footer">
            <a href="/"><i class="material-icons">arrow_backward</i>Home</a>

            <a href="/login">Already have account? Login<i class="material-icons">arrow_forward</i></a></div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{url('/css/auth.css')}}">
@endpush

@push('javascript')
    <script
        src="https://code.jquery.com/jquery-3.5.0.slim.js"
        integrity="sha256-sCexhaKpAfuqulKjtSY7V9H7QT0TCN90H+Y5NlmqOUE="
        crossorigin="anonymous"></script>
    <script>
        var role = $('#role').val();

        if (role != {{App\Models\Role::where('name','citizen')->first()->id}}) {
            $('#phone_number').hide()
            $('#email').show()
        }

        $(document).ready(function () {

            $(document).on('change', '#role', function () {
                role = $('#role').val();

                if (role != {{App\Models\Role::where('name','citizen')->first()->id}}) {
                    $('#phone_number').hide()
                    $('#email').show()
                } else {
                    $('#phone_number').show()
                    $('#email').hide()
                }
            });
        });
    </script>
@endpush
