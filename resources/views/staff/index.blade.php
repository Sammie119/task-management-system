@extends('layouts.app')

@section('title', "Task Management System - Staff")

@section('content')
    <main id="main" class="main">

        <x-breadcrumb name="Staff" />

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Staff</h5>
                                <x-button
                                    type="button"
                                    icon="bi bi-plus-lg"
                                    class="btn-primary"
                                    title="Add New Record"
                                    name="Add Staff"
                                    data-bs-toggle="modal"
                                    data-bs-target="#createModal"
                                    data-bs-title="Create New Staff"
                                    data-bs-url="staff.create"
                                    data-bs-size="modal-lg"
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
                                        <th scope="col">Phone</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Position</th>
                                        <th scope="col">Enabled?</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($staff as $key => $st)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ get_staff_name($st->id) }}</td>
                                            <td>{{ $st->email }}</td>
                                            <td>{{ $st->phone }}</td>
                                            <td>{{ $st->gender }}</td>
                                            <td>{{ get_dropdown_name($st->position) }}</td>
                                            <td>{!! get_active_flag($st->active_flag) !!}</td>
                                            <td style="width: 10%">
                                                <x-button
                                                    type="button"
                                                    icon="bi bi-pencil-square"
                                                    class="btn-primary btn-sm"
                                                    title="Edit Record"
                                                    name=""
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#createModal"
                                                    data-bs-title="Edit Record"
                                                    data-bs-url="staff.create/{{ $st }}"
                                                    data-bs-size="modal-lg"
                                                />
                                                <x-button
                                                    type="button"
                                                    icon="bi bi-trash-fill"
                                                    class="btn-danger btn-sm"
                                                    title="Delete Record"
                                                    name=""
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#createModal"
                                                    data-bs-title="Delete Record"
                                                    data-bs-url="staff.delete/{{ $st }}"
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

