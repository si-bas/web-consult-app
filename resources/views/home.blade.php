@extends('layouts.template-default')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Dashboard</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="sk-layout-2-columns.html"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Starter Kit</a>
                        </li>
                        <li class="breadcrumb-item active">Fixed Layout
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section id="description" class="card">
        <div class="card-header">
            <h4 class="card-title">Description</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="card-text">
                    <p>The fixed layout has a fixed navbar, navigation menu and footer, only content section is scrollable to user. In this page you can experience it. Fixed layout provide seamless UI on different screens.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection