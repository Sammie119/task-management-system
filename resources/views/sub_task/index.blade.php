@extends('layouts.app')

@section('title', "Task Management System - sub_task")

@section('content')
    <main id="main" class="main">

        <x-breadcrumb name="Sub Tasks" />

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Sub Tasks</h5>
                                <x-button
                                    type="button"
                                    icon="bi bi-plus-lg"
                                    class="btn-primary"
                                    title="Add New SubTask"
                                    name="Add SubTasks"
                                    data-bs-toggle="modal"
                                    data-bs-target="#createModal"
                                    data-bs-title="Create New SubTasks"
                                    data-bs-url="sub_task.create"
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
                                        <th scope="col">Task ID</th>
                                        <th scope="col">User ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Priority</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">Due Date</th>
                                        <th scope="col">Enabled?</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sub_tasks as $key => $st)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $st->user_id }}</td>
                                            <td>{{ $st->task_id }}</td>
                                            <td>{{ get_sub_task_name($st->id) }}</td>
                                            <td>{{ $st->description }}</td>
                                            <td>{{ $st->status }}</td>
                                            <td>{{ $st->priority }}</td>
                                            <td>{{ $st->start_date }}</td>
                                            <td>{{ $st->due_date }}</td>
                                            <td>{!! get_active_flag($st->active_flag) !!}</td>
                                            <td style="width: 10%">
                                                <x-button
                                                    type="button"
                                                    icon="bi bi-pencil-square"
                                                    class="btn-primary btn-sm"
                                                    title="Edit SubTask"
                                                    name=""
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#createModal"
                                                    data-bs-title="Edit SubTask"
                                                    data-bs-url="sub_task.create/{{ $st }}"
                                                    data-bs-size="modal-lg"
                                                />
                                                <x-button
                                                    type="button"
                                                    icon="bi bi-trash-fill"
                                                    class="btn-danger btn-sm"
                                                    title="Delete SubTask"
                                                    name=""
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#createModal"
                                                    data-bs-title="Delete SubTask"
                                                    data-bs-url="sub_task.delete/{{ $st }}"
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

