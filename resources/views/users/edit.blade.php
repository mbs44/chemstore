<!-- resources/views/experiments/edit.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <h1 class="h1-screen">Change Roles for : {{$user->username}}</h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Use PUT method for updating -->

            <div class="div-input">
                <input type="hidden" name="is_admin" value="0"> <!-- Hidden input for unchecked state -->
                <input type="checkbox" name="is_admin"
                       value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                <label for="is_admin">Is Admin</label>
            </div>
            <div class="div-input">
                <input type="hidden" name="is_teacher" value="0"> <!-- Hidden input for unchecked state -->
                <input type="checkbox" name="is_teacher"
                       value="1" {{ old('is_teacher', $user->is_teacher) ? 'checked' : '' }}>
                <label for="is_teacher">Is Teacher</label>
            </div>
            <div class="div-input">
                <input type="hidden" name="is_student" value="0"> <!-- Hidden input for unchecked state -->
                <input type="checkbox" name="is_student"
                       value="1" {{ old('is_student', $user->is_student) ? 'checked' : '' }}>
                <label for="is_student">Is Student</label>
            </div>

            <button type="submit" class="button-submit">Update User</button>
        </form>
    </div>
@endsection
