
@extends('layouts.app')
@section('title', 'welcome page')
@section('metaDescription', 'meta description welcome page')
@section('content')
<section>
    <div class="container">
        <div class="row row-content">
            <div class="col-xs-12">
             <div class="">
                    <a href="/employees">Employees</a>
                    <a href="/companies">Companies</a>
                    <a href="/companyprojects">Projects</a>
                </div>   
            </div>
        </div>
    </div>
</section>
@endsection
