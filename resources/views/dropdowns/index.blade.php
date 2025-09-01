@extends('layouts.app')

@section('title', "Task Management System - Dropdowns")

@section('content')
    <main id="main" class="main">

        <x-breadcrumb name="Dropdowns" />

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Dropdowns</h5>
                                <x-button
                                    type="button"
                                    icon="bi bi-plus-lg"
                                    class="btn-primary"
                                    title="Add New Record"
                                    name="Add Category"
                                    data-bs-toggle="modal"
                                    data-bs-target="#createModal"
                                    data-bs-title="Create New Category"
                                    data-bs-url="dropdowns.create"
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
                                        <th scope="col">Enabled</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dropdowns as $key => $dropdown)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $dropdown->name }}</td>
                                            <td>{!! get_active_flag($dropdown->active_flag) !!}</td>
                                            <td style="width: 20%">
                                                <x-button
                                                    type="button"
                                                    icon="bi bi-arrow-down-circle-fill"
                                                    class="btn-primary btn-sm"
                                                    title="Dropdowns"
                                                    name="Dropdowns"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#createModal"
                                                    data-bs-title="Dropdowns"
                                                    data-bs-url="dropdowns.dropdowns/{{ $dropdown }}"
                                                    data-bs-size=""
                                                    style="padding-left: 10px; padding-right: 10px"
                                                />
                                                <x-button
                                                    type="button"
                                                    icon="bi bi-pencil-square"
                                                    class="btn-primary btn-sm"
                                                    title="Edit Record"
                                                    name=""
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#createModal"
                                                    data-bs-title="Edit Record"
                                                    data-bs-url="dropdowns.create/{{ $dropdown }}"
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
                                                    data-bs-title="Delete Record"
                                                    data-bs-url="dropdowns.delete/{{ $dropdown }}"
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

