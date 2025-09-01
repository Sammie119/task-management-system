@extends('layouts.app')

@section('title', "Task Management System - Dashboard")

@section('content')
    <main id="main" class="main">

        <x-breadcrumb name="Users" />

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Users</h5>
                                <x-button
                                    type="button"
                                    icon="bi bi-plus-lg"
                                    class="btn-primary"
                                    title="Add New Record"
                                    name="Add New"
                                    data-bs-toggle="modal"
                                    data-bs-target="#createModal"
                                    data-bs-title="Create New User"
                                    data-bs-url="auth.create"
                                    data-bs-size=""
                                />
                            </div>

                            <x-notify-error :messages="$errors->all()" />
                            <x-notify-error :messages="Session::get('success')" :type="1"/>
                            <x-notify-error :messages="Session::get('error')" :type="2"/>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Enabled</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $key => $user)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ get_user_role($user->role) }}</td>
                                            <td>{!! get_active_flag($user->active_flag) !!}</td>
                                            <td style="width: 10%">
                                                <x-button
                                                    type="button"
                                                    icon="bi bi-pencil-square"
                                                    class="btn-primary btn-sm"
                                                    title="Edit Record"
                                                    name=""
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#createModal"
                                                    data-bs-title="Edit User"
                                                    data-bs-url="auth.create/{{ $user }}"
                                                    data-bs-size=""
                                                />
                                                <x-button
                                                    type="button"
                                                    icon="bi bi-trash-fill"
                                                    class="btn-danger btn-sm"
                                                    title="Delete Record"
                                                    name=""
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#createModal"
                                                    data-bs-title="Edit User"
                                                    data-bs-url="auth.delete/{{ $user }}"
                                                    data-bs-size=""
                                                />
                                            </td>
                                        </tr>
                                    @empty

                                    @endforelse

                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <x-modal />

    </main><!-- End #main -->
@endsection

