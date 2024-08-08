@extends('layouts.app')

@section('title', 'Users')

@section('content')
<a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mb-5">Create User</a>
<a href="{{route('users.trash')}}" class="btn btn-warning btn-sm mb-5">Blocked User</a>
    <div class="container">
        <h1 class="my-4">Users</h1>
        <div class="row">
            
                <table class="table">
                    <thead class="bg-primary text-light">
                      <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    @forelse ($users as $user)
                    <tbody>
                      <tr>
                        @if ($user->image)
                        <th scope="row">
                            <img src="{{ asset('images/' . $user->image) }}" alt="user Image" width="50px">
                        </th>
                        @endif
                        <td class=" align-items-center">{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        @if($user->is_admin==true)
                        <td>Admin</td>
                        @else
                        <td>User</td>
                        @endif
                        <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-primary btn-sm">View</a>
                          @if(!$user->is_admin && auth()->check() && auth()->user()->is_admin)
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to block this user?')">Block</button>
                            </form>
                         @endif
                        </td>
                      </tr>
                    </tbody>
                    @empty
                      <h2>no users</h2>  
                    @endforelse
            </table>
        </div>
    </div>
@endsection