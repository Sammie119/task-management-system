@props(['name'])

<div class="pagetitle">
    <h1>{{ $name }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ ($name == 'Dashboard')? 'Home' : 'Dashboard'}} </a></li>
            <li class="breadcrumb-item active">{{ $name }}</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
